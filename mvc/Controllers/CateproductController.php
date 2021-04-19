<?php

class CateproductController extends BaseController
{

    private $CateProductModel;
    private $ProductModel;
    private $ConfigModel;

    public function __construct()
    {
        $this->CateProductModel = $this->model("CateProductModel");
        $this->ProductModel     = $this->model("ProductModel");
        $this->FlashsaleModel   = $this->model("FlashsaleModel");
        $this->ConfigModel      = $this->model("ConfigModel");
    }

    public function index()
    {

        $protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
        $url = $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

        $brand_url = explode("brand=", $url);
        $price_url = explode("price=", $url);
        $sort_url  = explode("sort=", $url);


        $cateProd_id = !empty($_GET['id'])    ? (int) $_GET['id'] : 0;

        $brand_id    = null;
        $brand_name  = null;

        if(!empty($brand_url[1])) {
            $brandExplode   = explode("-", $brand_url[1]);
            $brandLastIndex = count($brandExplode) - 1;
            if($brandLastIndex >= 2) {
                $brand_name = "";
                for ( $i = 0; $i < $brandLastIndex ; $i++ ) {
                    if( $i >= 1 ) {
                        $brand_name .= "-";
                    }
                    $brand_name .= $brandExplode[$i];
                }
            } else {
                $brand_name = !empty($brandExplode[0]) ? $brandExplode[0] : null;
            }
            $brand_id   = !empty($brandExplode[$brandLastIndex]) ? (int) $brandExplode[$brandLastIndex] : null;
        }

        $price_vl    = !empty($price_url[1])  ? $this->handlePriceFilter($price_url[1]) : null;

        $sort_vl     = !empty($sort_url[1])   ? $this->handleSortFilter($sort_url[1]) : null;

        $cateProdItem = $this->CateProductModel->getCateProdItemById($cateProd_id);

        if(!empty($cateProdItem)) {

            $listCateProdChild  = $this->CateProductModel->getByParentId($cateProdItem['cateProd_id']);
            $cateProdParentItem = $this->CateProductModel->getCateProdItemById($cateProdItem['cateProd_parentId']);
            $listAllCateProd    = $this->CateProductModel->getAll();
            $menuMulticateProd  = $this->loadMenuMultiCateProd($listAllCateProd, $cateProdItem['cateProd_id']);
            $listProduct        = $this->ProductModel->getListAllProdAndBrandTiesAnd();
            $listFlashSale      = $this->FlashsaleModel->getListFlashSaleInToday(time());

            if($cateProdItem['cateProd_parentId'] == 0 && !($this->checkFilterExists($brand_id, $price_vl, $sort_vl))) {

                $cateProdPage = "main";

                if(!empty($listProduct)) {

                    // push flash sale into product
                    foreach($listProduct as &$prodItem) {
                        if(!empty($listFlashSale)) {
                            foreach($listFlashSale as $flashSaleItem) {
                                if($prodItem['prod_id'] == $flashSaleItem['prod_flashsale_prodId']) {
                                    $prodItem['flashSale'][] = $flashSaleItem;
                                }
                            }
                        }
                    }

                    // create list product by id cate prod
                    $listProductByIdCate = [];
                    foreach($listProduct as $prodItem__1) {
                        $arrayProdCateTies = json_decode($prodItem__1['prod_listId_cateProd_ties']);
                        if( in_array($cateProd_id, $arrayProdCateTies) ) {
                            $listProductByIdCate[] = $prodItem__1;
                        }
                    }

                    $listIdBrand = [];
                    $listBrand   = [];

                    foreach($listProductByIdCate as $prodItem__2) {
                        if( !(in_array( (int) $prodItem__2['brand_id'], $listIdBrand)) ) {
                            $listIdBrand[] = $prodItem__2['brand_id'];
                            $arrBrandItem = [
                                "id"   => $prodItem__2['brand_id'],
                                "name" => $prodItem__2['brand_name']
                            ];
                            $listBrand[] = $arrBrandItem;
                        }
                    }
                    unset($listIdBrand);

                    // push product into cate product
                    foreach($listCateProdChild as &$cateProdChildItem) {
                        $result = [];
                        foreach($listProduct as $prodItem__2) {
                            $arrayProdCateTies__ = json_decode($prodItem__2['prod_listId_cateProd_ties']);
                            if(in_array($cateProdChildItem['cateProd_id'], $arrayProdCateTies__)) {
                                $result[] = $prodItem__2;
                            }
                        }
                        $cateProdChildItem['listProd'] = $result;
                        unset($result);
                    }
                }
            } else {

                /*
                * Handle url filter in cate product
                */

                $page         = explode("page=", $url);

                $page         = !empty($page[1])   ? (int) $page[1] : 1;

                $brandUrl     = !empty($brand_id)     ? "/brand=" . Format::create_slug($brand_name) . "-{$brand_id}" : "";
                $priceExplode = !empty($price_url[1]) ? explode("/", $price_url[1])[0] : "";
                $priceArr     = !empty($priceExplode) ? explode("_", $priceExplode) : null;
                $priceUrl     = !empty($priceArr)     ? "/price={$priceArr[0]}_{$priceArr[1]}" : "";
                $sortUrl      = !empty($sort_vl)      ? "/sort={$sort_vl}" : "";
                $pageUrl      = !empty($page)         ? "/page={$page}" : "";

                /*
                * Format data filter cate product
                */
                if($price_vl === null) {
                    $price_vl = [ "min" => 0, "max" => 1000000000000 ];
                }

                $cateProdPage       = "child";

                $listProductResult  = $this->ProductModel->getListProductByMixFilterAndPagination( $cateProd_id ,$price_vl, $brand_id, $sort_vl ,null, null);



                // create list product by id cate prod
                $listProductByIdCate = [];
                foreach($listProduct as $prodItem) {
                    $arrayProdCateTies = json_decode($prodItem['prod_listId_cateProd_ties']);
                    if( in_array($cateProd_id, $arrayProdCateTies) ) {
                        $listProductByIdCate[] = $prodItem;
                    }
                }

                $listIdBrand = [];
                $listBrand   = [];

                foreach($listProductByIdCate as $prodItem__2) {
                    if( !(in_array( (int) $prodItem__2['brand_id'], $listIdBrand)) ) {
                        $listIdBrand[] = $prodItem__2['brand_id'];
                        $arrBrandItem = [
                            "id"   => $prodItem__2['brand_id'],
                            "name" => $prodItem__2['brand_name']
                        ];
                        $listBrand[] = $arrBrandItem;
                    }
                }
                unset($listIdBrand);

                /*
                 * Pagination
                */

                $numPerPage        = 16;
                $totalPage         = ceil(count($listProductResult) / $numPerPage);

                $pageStart         = (int) ($page - 1) * $numPerPage;

                $listProduct       = $this->ProductModel->getListProductByMixFilterAndPagination( $cateProd_id, $price_vl, $brand_id, $sort_vl ,$pageStart, $numPerPage);

                if(!empty($listProduct)) {
                    // push flash sale into product
                    foreach($listProduct as &$prodItem__1) {
                        if(!empty($listFlashSale)) {
                            foreach($listFlashSale as $flashSaleItem) {
                                if($prodItem__1['prod_id'] == $flashSaleItem['prod_flashsale_prodId']) {
                                    $prodItem__1['flashSale'][] = $flashSaleItem;
                                }
                            }
                        }
                    }

                }

                $listProductByIdCate = $listProduct;

            }

        }

        $this->view("Frontend.CateProducts.index", [
            "pageCateProd"        => !empty($cateProdPage)        ? $cateProdPage        : null,
            "cateProdItem"        => !empty($cateProdItem)        ? $cateProdItem        : null,
            "listCateProdChild"   => !empty($listCateProdChild)   ? $listCateProdChild   : null,
            "cateProdParentItem"  => !empty($cateProdParentItem)  ? $cateProdParentItem  : null,
            "menuMulticateProd"   => !empty($menuMulticateProd)   ? $menuMulticateProd   : null,
            "listProductByIdCate" => !empty($listProductByIdCate) ? $listProductByIdCate : [],
            "listBrand"           => !empty($listBrand)           ? $listBrand           : [],
            "brand_id"            => !empty($brand_id)            ? $brand_id            : null,
            "brand_name"          => !empty($brand_name)          ? $brand_name          : null,
            "brandUrl"            => !empty($brandUrl)            ? $brandUrl            : null,
            "priceUrl"            => !empty($priceUrl)            ? $priceUrl            : null,
            "sortUrl"             => !empty($sortUrl)             ? $sortUrl             : null,
            "pageUrl"             => !empty($pageUrl)             ? $pageUrl             : null,
            "priceArr"            => !empty($priceArr)            ? $priceArr            : ["0k","100000000000k"],
            "cateProdUrl"         => !empty($cateProdItem)        ? "{$cateProdItem['cateProd_seoUrl']}-c{$cateProdItem['cateProd_id']}" : "",
            "sort_vl"             => !empty($sort_vl)             ? $sort_vl   : null,
            "totalPage"           => !empty($totalPage)           ? $totalPage : null,
            "page"                => !empty($page)                ? $page      : null,
            "configInfo"          => !empty($this->ConfigModel->getInfoConfig()) ? $this->ConfigModel->getInfoConfig() : null
        ]);
    }

    public function handlePriceFilter($price_vl)
    {
        $price_vl = explode("_", $price_vl);
        return [
            "min" => !empty($price_vl[0]) ? (int) str_replace("k", '000', $price_vl[0]) : 0,
            "max" => !empty($price_vl[1]) ? (int) str_replace("k", '000', $price_vl[1]) : 100000000000
        ];
    }

    public function handleSortFilter($sort_vl)
    {
        $sort_vl = explode("/", $sort_vl);
        return $sort_vl[0];
    }


    public function checkFilterExists($brand_id, $price_vl, $sort_vl)
    {
        if( $brand_id != null || $price_vl != null || $sort_vl != null ) {
            return true;
        } return false;
    }

    public function loadMenuMultiCateProd($listCateProd, $parentId = 0)
    {
        $result = "<ul class='list_catalog_sub'>";

        foreach($listCateProd as $cateProdItem) {
            if($cateProdItem['cateProd_parentId'] == $parentId) {
                $result .= "<li class='position_relative'>";
                $result .= "<a href='". Config::getBaseUrlClient("{$cateProdItem['cateProd_seoUrl']}-c{$cateProdItem['cateProd_id']}.html") ."' class='catalog_item_view_link d_flex align_items_center'>";
                $result .= "<span class='catalog_item_icon thumbNail' style='margin-right: 5px;'>";
                $result .= "<img src='". Config::getBaseUrlAdmin($cateProdItem['cateProd_image']) ."' width='20' alt='". $cateProdItem['cateProd_name'] ."'>";
                $result .= "</span>";
                $result .= "<span class='catalog_item_title'>". $cateProdItem['cateProd_name'] ."</span>";
                if($this->CateProductModel->checkListCateProdChildExistsByCateProdId($cateProdItem['cateProd_id'])) {
                    $result .= "<i class='fa fa-angle-right position_absolute' style='top: 50%; right: 2%;transform: translateY(-50%);'></i>";
                }
                $result .= "</a>";
                if($this->CateProductModel->checkListCateProdChildExistsByCateProdId($cateProdItem['cateProd_id'])) {
                    $result .= "<ul class='list_catalog_sub_children'>";
                    foreach($listCateProd as $cateProdItem_2) {
                        if($cateProdItem_2['cateProd_parentId'] == $cateProdItem['cateProd_id']) {
                            $result .= "<li>";
                            $result .= "<a href='". Config::getBaseUrlClient("{$cateProdItem_2['cateProd_seoUrl']}-c{$cateProdItem_2['cateProd_id']}.html") ."' class='catalog_item_view_link'>";
                            $result .= "<span class='catalog_item_title'>". $cateProdItem_2['cateProd_name'] ."</span>";
                            $result .= "</a>";
                            $result .= "</li>";
                        }
                    }
                    $result .= "</ul>";
                }
                $result .= "</li>";
            }
        }
        $result .= "</ul>";

        return $result;
    }
}
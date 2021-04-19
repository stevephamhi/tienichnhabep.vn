<?php

class LiquidationController extends BaseController
{
    private $ProductModel;
    private $FlashsaleModel;
    private $CateProductModel;
    private $ConfigModel;

    public function __construct()
    {
        $this->ProductModel     = $this->model("ProductModel");
        $this->FlashsaleModel   = $this->model("FlashsaleModel");
        $this->CateProductModel = $this->model("CateProductModel");
        $this->ConfigModel      = $this->model("ConfigModel");
    }

    public function index()
    {

        $protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
        $url = $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

        $brand_url = explode("brand=", $url);
        $price_url = explode("price=", $url);
        $sort_url  = explode("sort=", $url);

        $price_vl      = !empty($price_url[1])      ? $this->handlePriceFilter($price_url[1]) : null;
        $sort_vl       = !empty($sort_url[1])       ? $this->handleSortFilter($sort_url[1])   : null;

        $brand_id    = null;
        $brand_name  = null;

        if(!empty($brand_url[1])) {
            $brandExplode = explode("-", $brand_url[1]);
            $brand_name = !empty($brandExplode[0]) ? $brandExplode[0] : null;
            $brand_id   = !empty($brandExplode[1]) ? (int) $brandExplode[1] : null;
        }

        if($price_vl === null) {
            $price_vl = [ "min" => 0, "max" => 1000000000000 ];
        }

        $listProdResult        = $this->ProductModel->getListProdByLiquidationAndMixFilter( $brand_id, $price_vl, $sort_vl, null, null );
        $listProdByLiquidation = $this->ProductModel->getlistProdByLiquidation();
        $numProdByLiquidation  = count($listProdResult);
        $listFlashSale         = $this->FlashsaleModel->getListFlashSaleInToday(time());
        $listCateProd          = $this->getListCateProdByListProd($listProdByLiquidation);
        $listCateProdLevel2    = $this->getListCateProdLevel2($listCateProd);
        $menuMultiCateProd     = $this->loadMenuMultiCateProd($listCateProd, 0);

        $page            = explode("page=", $url);
        $page            = !empty($page[1]) ? (int) $page[1] : 1;


        $liquidationUrl = "san-pham-thanh-ly-gia-re";
        $brandUrl       = !empty($brand_id)     ? "/brand=" . Format::create_slug($brand_name) . "-{$brand_id}" : "";
        $priceExplode   = !empty($price_url[1]) ? explode("/", $price_url[1])[0] : "";
        $priceArr       = !empty($priceExplode) ? explode("_", $priceExplode) : null;
        $priceUrl       = !empty($priceArr)     ? "/price={$priceArr[0]}_{$priceArr[1]}" : "";
        $sortUrl        = !empty($sort_vl)      ? "/sort={$sort_vl}" : "";
        $pageUrl        = !empty($page)         ? "/page={$page}" : "";

        /*
        * Pagination
        */

        $numPerPage = 16;
        $totalPage  = ceil(count($listProdResult) / $numPerPage);
        $pageStart  = (int) ($page - 1) * $numPerPage;
        $listProd   = $this->ProductModel->getListProdByLiquidationAndMixFilter(  $brand_id, $price_vl, $sort_vl ,$pageStart, $numPerPage);



        if(!empty($listProd)) {
            // push flash sale into product
            foreach($listProd as &$prodItem) {
                if(!empty($listFlashSale)) {
                    foreach($listFlashSale as $flashSaleItem) {
                        if($prodItem['prod_id'] == $flashSaleItem['prod_flashsale_prodId']) {
                            $prodItem['flashSale'][] = $flashSaleItem;
                        }
                    }
                }
            }

            $listIdBrand = [];
            $listBrand   = [];
            foreach($listProd as $__prodItem) {
                if( !(in_array( (int) $__prodItem['brand_id'], $listIdBrand)) ) {
                    $listIdBrand[] = $__prodItem['brand_id'];
                    $arrBrandItem = [
                        "id"   => $__prodItem['brand_id'],
                        "name" => $__prodItem['brand_name']
                    ];
                    $listBrand[] = $arrBrandItem;
                }
            }
            unset($listIdBrand);
        }

        $listProdByLiquidation = $listProd;

        $this->view("Frontend.Liquidations.index", [
            "menuMultiCateProd"     => !empty($menuMultiCateProd)     ? $menuMultiCateProd     : null,
            "numProdByLiquidation"  => !empty($numProdByLiquidation)  ? $numProdByLiquidation  : 0,
            "listCateProd"          => !empty($listCateProd)          ? $listCateProd          : null,
            "listCateProdLevel2"    => !empty($listCateProdLevel2)    ? $listCateProdLevel2    : null,
            "listProdByLiquidation" => !empty($listProdByLiquidation) ? $listProdByLiquidation : null,
            "totalPage"             => !empty($totalPage)             ? $totalPage             : null,
            "page"                  => !empty($page)                  ? $page                  : null,
            "liquidationUrl"        => !empty($liquidationUrl)        ? $liquidationUrl        : null,
            "sortUrl"               => !empty($sortUrl)               ? $sortUrl               : null,
            "priceArr"              => !empty($priceArr)              ? $priceArr              : ["0k","100000000000k"],
            "priceUrl"              => !empty($priceUrl)              ? $priceUrl              : null,
            "pageUrl"               => !empty($pageUrl)               ? $pageUrl               : null,
            "sort_vl"               => !empty($sort_vl)               ? $sort_vl               : null,
            "brandUrl"              => !empty($brandUrl)              ? $brandUrl              : null,
            "listBrand"             => !empty($listBrand)             ? $listBrand             : null,
            "brand_id"              => !empty($brand_id)              ? $brand_id              : null,
            "configInfo"            => !empty($this->ConfigModel->getInfoConfig()) ? $this->ConfigModel->getInfoConfig() : null
        ]);
    }

    public function handleSortFilter($sort_vl)
    {
        $sort_vl = explode("/", $sort_vl);
        return $sort_vl[0];
    }

    public function handlePriceFilter($price_vl)
    {
        $price_vl = explode("_", $price_vl);
        return [
            "min" => !empty($price_vl[0]) ? (int) str_replace("k", '000', $price_vl[0]) : 0,
            "max" => !empty($price_vl[1]) ? (int) str_replace("k", '000', $price_vl[1]) : 100000000000
        ];
    }

    public function getListCateProdLevel2($listCateProd)
    {
        $listCateProdLevel1 = [];
        foreach( $listCateProd as $cateProdItem ) {
            if( $cateProdItem['cateProd_parentId'] == 0 ) {
                $listCateProdLevel1[] = $cateProdItem;
            }
        }

        $listCateProdLevel2 = [];
        foreach($listCateProdLevel1 as $cateProdLevel1Item) {
            foreach($listCateProd as $cateProdItem__) {
                if( $cateProdLevel1Item['cateProd_id'] == $cateProdItem__['cateProd_parentId'] ) {
                    $listCateProdLevel2[] = $cateProdItem__;
                }
            }
        }

        return $listCateProdLevel2;
    }

    public function getListCateProdByListProd($listProd)
    {
        $listCateProd   = [];
        $listIdCateProd = [];
        foreach($listProd as $prodItem) {
            $arrayIdCateProdTies = json_decode($prodItem['prod_listId_cateProd_ties']);
            foreach($arrayIdCateProdTies as $idCateProdItem) {
                if( !(in_array($idCateProdItem, $listIdCateProd)) ) {
                    $listIdCateProd[] = $idCateProdItem;
                    $cateProdItem = $this->CateProductModel->getCateProdItemById($idCateProdItem);
                    $listCateProd[] = $cateProdItem;
                }
            }
        }
        return $listCateProd;
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
                            $result .= "<a>";
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
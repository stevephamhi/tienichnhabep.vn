<?php

class SearchController extends BaseController
{

    private $BrandModel;
    private $ProductModel;
    private $CateProductModel;
    private $FlashsaleModel;
    private $ConfigModel;

    public function __construct()
    {
        $this->BrandModel       = $this->model("BrandModel");
        $this->ProductModel     = $this->model("ProductModel");
        $this->CateProductModel = $this->model("CateProductModel");
        $this->FlashsaleModel   = $this->model("FlashsaleModel");
        $this->ConfigModel      = $this->model("ConfigModel");
    }

    public function handleStringSearch($strSearch)
    {
        return !empty(explode( "_" ,$strSearch )[0]) ? explode( "_" ,$strSearch )[0] : '';
    }

    public function index()
    {
        $strSearch = Format::validationSearch($_GET['q']);
        $strSearch = explode("/", $strSearch)[0];
        /*--------------------------- URL --------------------------*/
        $protocol   = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
        $url        = $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        $brand_url  = explode("brand=", $url);
        $price_url  = explode("price=", $url);
        $sort_url   = explode("sort=", $url);
        $price_vl   = !empty($price_url[1]) ? $this->handlePriceFilter($price_url[1]) : null;
        $sort_vl    = !empty($sort_url[1])  ? $this->handleSortFilter($sort_url[1])   : null;
        $brand_id   = null;
        $brand_name = null;
        if(!empty($brand_url[1])) {
            $brandExplode = explode("-", $brand_url[1]);
            $brand_name = !empty($brandExplode[0]) ? $brandExplode[0] : null;
            $brand_id   = !empty($brandExplode[1]) ? (int) $brandExplode[1] : null;
        }
        /*-------------------------- URL --------------------------*/

        if(strlen($strSearch) > 0) {
            $strSearch = $this->handleStringSearch($strSearch);
            $infoData = $this->productAnalysisAndSuggestions($strSearch);
            $strSearch = $strSearch."_";
        } else {
            $infoData = [];
        }

        if($price_vl === null) {
            $price_vl = [ "min" => 0, "max" => 1000000000000 ];
        }

        if(!empty($infoData['listProd'])) {
            $listIdBrand   = [];
            $listBrand     = [];
            foreach($infoData['listProd'] as $prodItem_filBrand) {
                if( !(in_array( (int) $prodItem_filBrand['brand_id'], $listIdBrand)) ) {
                    $listIdBrand[] = $prodItem_filBrand['brand_id'];
                    $arrBrandItem = [
                        "id"   => $prodItem_filBrand['brand_id'],
                        "name" => $prodItem_filBrand['brand_name']
                    ];
                    $listBrand[] = $arrBrandItem;
                }
            }
            unset($listIdBrand);
        }

        $listProd_pagi = $this->HandleMixFilterProdAndPagination( $infoData['listProd'], $brand_id, $price_vl, $sort_vl, null, null );


        if(!empty($listProd_pagi)) {
            $listCateProd       = $this->getListCateProdByListProd($listProd_pagi);
            $listCateProdLevel2 = $this->getListCateProdLevel2($listCateProd);
            $menuMultiCateProd  = $this->loadMenuMultiCateProd($listCateProd, 0);
            /*---------------------- Start Get brand ----------------------*/

            /*---------------------- End Get brand ----------------------*/
        }

        /*--------------------- Pagination ---------------------*/
        $page          = explode("page=", $url);
        $page          = !empty($page[1]) ? (int) $page[1] : 1;
        $numTotalProd  = count($listProd_pagi);
        $numPerPage    = 16;
        $totalPage     = ceil( $numTotalProd / $numPerPage );
        $pageStart     = ($page - 1) * $numPerPage;
        /*--------------------- Pagination ---------------------*/
        $listProd      = $this->HandleMixFilterProdAndPagination( $infoData['listProd'], $brand_id, $price_vl, $sort_vl, $pageStart, $numPerPage );

        if(!empty($listProd)) {
            /*---------------------- Start Get flash sale ----------------------*/
            $listFlashSale = $this->FlashsaleModel->getListFlashSaleInToday(time());
            foreach($listProd as &$prodItem__flashSale) {
                if(!empty($listFlashSale)) {
                    foreach($listFlashSale as $flashSaleItem) {
                        if($prodItem__flashSale['prod_id'] == $flashSaleItem['prod_flashsale_prodId']) {
                            $prodItem__flashSale['flashSale'][] = $flashSaleItem;
                        }
                    }
                }
            }
            /*---------------------- End Get flash sale ----------------------*/
        }

        /*------------------------------------------------------------------------------------*/
        $searchUrl      = "search/?q={$strSearch}";
        $brandUrl       = !empty($brand_id)     ? "/brand=" . Format::create_slug($brand_name) . "-{$brand_id}" : "";
        $priceExplode   = !empty($price_url[1]) ? explode("/", $price_url[1])[0] : "";
        $priceArr       = !empty($priceExplode) ? explode("_", $priceExplode) : null;
        $priceUrl       = !empty($priceArr)     ? "/price={$priceArr[0]}_{$priceArr[1]}" : "";
        $sortUrl        = !empty($sort_vl)      ? "/sort={$sort_vl}" : "";
        $pageUrl        = !empty($page)         ? "/page={$page}" : "";
        /*------------------------------------------------------------------------------------*/

        $listProdBySearch = $listProd;

        $this->view("Frontend.Searchs.index", [
            "menuMultiCateProd"  => !empty($menuMultiCateProd)  ? $menuMultiCateProd  : null,
            "numTotalProd"       => !empty($numTotalProd)       ? $numTotalProd       : null,
            "listCateProd"       => !empty($listCateProd)       ? $listCateProd       : null,
            "listCateProdLevel2" => !empty($listCateProdLevel2) ? $listCateProdLevel2 : null,
            "listProdBySearch"   => !empty($listProdBySearch)   ? $listProdBySearch   : null,
            "totalPage"          => !empty($totalPage)          ? $totalPage          : null,
            "page"               => !empty($page)               ? $page               : null,
            "searchUrl"          => !empty($searchUrl)          ? $searchUrl          : null,
            "sortUrl"            => !empty($sortUrl)            ? $sortUrl            : null,
            "priceArr"           => !empty($priceArr)           ? $priceArr           : ["0k","100000000000k"],
            "priceUrl"           => !empty($priceUrl)           ? $priceUrl           : null,
            "pageUrl"            => !empty($pageUrl)            ? $pageUrl            : null,
            "sort_vl"            => !empty($sort_vl)            ? $sort_vl            : null,
            "brandUrl"           => !empty($brandUrl)           ? $brandUrl           : null,
            "listBrand"          => !empty($listBrand)          ? $listBrand          : null,
            "brand_id"           => !empty($brand_id)           ? $brand_id           : null,
            "strSearch"          => !empty($strSearch)          ? $strSearch          : null,
            "configInfo"         => !empty($this->ConfigModel->getInfoConfig()) ? $this->ConfigModel->getInfoConfig() : null
        ]);
    }

    public function HandleMixFilterProdAndPagination( $listProd, $brand_id, $price_vl, $sort_vl, $pageStart, $numPerPage )
    {

        $listProdBrand = [];
        if(!empty($brand_id)) {
            foreach( $listProd as $prodItem__1 ) {
                if( $prodItem__1['prod_ties_brand_id'] == $brand_id ) {
                    $listProdBrand[] = $prodItem__1;
                }
            }
        } else {
            $listProdBrand = $listProd;
        }

        $listProdPrice = [];

        foreach( $listProdBrand as $prodItem__2 ) {
            if( $prodItem__2['prod_currentPrice'] >= $price_vl['min'] && $prodItem__2['prod_currentPrice'] <= $price_vl['max'] ) {
                $listProdPrice[] = $prodItem__2;
            }
        }

        $listProdSort = [];

        if(!empty($sort_vl)) {

            $sortValue = [];

            if($sort_vl == "priceasc") {
                $sortValue = [
                    "field" => "prod_currentPrice",
                    "value" => "asc"
                ];
            } else if($sort_vl == "pricedesc") {
                $sortValue = [
                    "field" => "prod_currentPrice",
                    "value" => "desc"
                ];
            } else if($sort_vl == "bestsellers") {
                $sortValue = [
                    "field" => "prod_quantitySold",
                    "value" => "desc"
                ];
            } else if($sort_vl == "lastest") {
                $sortValue = [
                    "field" => "prod_createDate",
                    "value" => "desc"
                ];
            } else {
                $sortValue = [
                    "field" => "prod_name",
                    "value" => "desc"
                ];
            }

            $tamp = [];
            for( $i = 0 ; $i < count($listProdPrice) - 1 ; $i++ ) {
                for( $j = $i+1 ; $j < count($listProdPrice) ; $j++ ) {
                    if( $sortValue['value'] == "asc" ) {
                        // giam dan
                        if( $listProdPrice[$i][$sortValue['field']] > $listProdPrice[$j][$sortValue['field']] ) {
                            $tamp              = $listProdPrice[$i];
                            $listProdPrice[$i] = $listProdPrice[$j];
                            $listProdPrice[$j] = $tamp;
                        }
                    } else {
                        // tang dan
                        if( $listProdPrice[$i][$sortValue['field']] < $listProdPrice[$j][$sortValue['field']] ) {
                            $tamp              = $listProdPrice[$i];
                            $listProdPrice[$i] = $listProdPrice[$j];
                            $listProdPrice[$j] = $tamp;
                        }
                    }
                }
            }
            return $listProdPrice;

        } else {
            $listProdSort = $listProdPrice;
        }

        if( !empty($pageStart) || !empty($numPerPage) ) {
            $listProdPagination = [];

            if($pageStart == 0) {
                for($i = $pageStart ; $i < $numPerPage ; $i++) {
                    if( !empty($listProdSort[$i]) ) {
                        $listProdPagination[] = $listProdSort[$i];
                    }
                }
            } else {
                for($i = $pageStart ; $i < $pageStart + $numPerPage ; $i++) {
                    if( !empty($listProdSort[$i]) ) {
                        $listProdPagination[] = $listProdSort[$i];
                    }
                }
            }

            return $listProdPagination;

        } else {
            return $listProdSort;
        }
    }

    public function recommentSearch()
    {
        $strSearch = $_POST['strSearch'];

        $strSearch = Format::validationSearch($strSearch);

        if(strlen($strSearch) > 0) {
            $infoData = $this->productAnalysisAndSuggestionsAjax($strSearch);
        } else {
            $infoData = [];
        }

        echo json_encode($infoData);
    }

    public function productAnalysisAndSuggestionsAjax($strSearch)
    {
        if( $this->BrandModel->checkFieldBrandExists("brand_name", $strSearch) ) {
            $listBrand   = $this->BrandModel->getListBrandFieldBySearch("brand_name", $strSearch,["brand_id","brand_name"]);
            $listProdArr = [];
            $listProd    = [];
            foreach($listBrand as $brandItem) {
                $listProd_r    = $this->ProductModel->getListProdFieldByBrandId($brandItem['brand_id'],["prod_id","prod_seoUrl","prod_name","prod_avatar","prod_currentPrice"]);
                if(!empty($listProd_r)) {
                    $listProdArr[] = $listProd_r;
                }
            }
            foreach($listProdArr as $prodArrItem) {
                foreach($prodArrItem as $prodItem) {
                    $listProd[] = $prodItem;
                }
            }
            $data = [
                "type"     => "brand",
                "list"     => $listBrand,
                "listProd" => $listProd
            ];
            return $data;
        } else {
            if( $this->ProductModel->checkProdFieldExists("prod_name", $strSearch) ) {
                $list = [];
                $listBrand     = $this->BrandModel->getListBrandFieldBySearch("brand_name", $strSearch,["brand_id","brand_name"]);
                if(!empty($listBrand)) {
                    $list = $listBrand;
                } else {
                    $list = $this->CateProductModel->searchListCateProdFieldByFieldSearch("cateProd_name", $strSearch, ["cateProd_id","cateProd_seoUrl","cateProd_name"]);
                }
                $data = [
                    "type"     => "product",
                    "list"     => $list,
                    "listProd" => $this->ProductModel->searchProdFieldByFieldSearch("prod_name", $strSearch, ["prod_id","prod_seoUrl","prod_name","prod_avatar","prod_currentPrice"])
                ];
                return $data;
            } else {
                if( $this->CateProductModel->checkCateFieldProductExists("cateProd_name", $strSearch) ) {
                    $listCateProd  = $this->CateProductModel->searchListCateProdFieldByFieldSearch("cateProd_name", $strSearch, ["cateProd_id","cateProd_seoUrl","cateProd_name"]);
                    $listTotalProd = $this->ProductModel->getListALlProductByField(["prod_id","prod_seoUrl","prod_name","prod_avatar","prod_currentPrice","prod_listId_cateProd_ties"]);
                    $listProd      = [];
                    $listProdArr = [];
                    foreach($listCateProd as $cateProdItem) {
                        $idCateProdItem = $cateProdItem['cateProd_id'];
                        $listProdArrItem = [];
                        foreach($listTotalProd as $prodItem) {
                            $arrListCateProdIdTies = json_decode($prodItem['prod_listId_cateProd_ties']);
                            if(in_array( $idCateProdItem , $arrListCateProdIdTies )) {
                                $listProdArrItem[] = $prodItem;
                            }
                        }
                        $listProdArr[] = $listProdArrItem;
                    }

                    foreach($listProdArr as $prodArrItem) {
                        foreach($prodArrItem as $prodItem) {
                            $listProd[] = $prodItem;
                        }
                    }

                    $data = [
                        "type"     => "cateProduct",
                        "list"     => $listCateProd,
                        "listProd" => $listProd
                    ];
                    return $data;
                }
            }
        }

        /**
         * ----- check key word seach recomment
         */


        if( $this->BrandModel->checkFieldBrandExists("brand_keywords", $strSearch) ) {
            $listBrand   = $this->BrandModel->getListBrandFieldBySearch("brand_keywords", $strSearch,["brand_id","brand_name"]);
            $listProdArr = [];
            $listProd    = [];
            foreach($listBrand as $brandItem) {
                $listProd_r    = $this->ProductModel->getListProdFieldByBrandId($brandItem['brand_id'],["prod_id","prod_seoUrl","prod_name","prod_avatar","prod_currentPrice"]);
                if(!empty($listProd_r)) {
                    $listProdArr[] = $listProd_r;
                }
            }
            foreach($listProdArr as $prodArrItem) {
                foreach($prodArrItem as $prodItem) {
                    $listProd[] = $prodItem;
                }
            }
            $data = [
                "type"     => "brand",
                "list"     => $listBrand,
                "listProd" => $listProd
            ];
            return $data;
        } else {
            if( $this->ProductModel->checkProdFieldExists("prod_keywords", $strSearch) ) {
                $list = [];
                $listBrand = $this->BrandModel->getListBrandFieldBySearch("brand_keywords", $strSearch,["brand_id","brand_name"]);
                if(!empty($listBrand)) {
                    $list = $listBrand;
                } else {
                    $list = $this->CateProductModel->searchListCateProdFieldByFieldSearch("cateProd_keyword", $strSearch, ["cateProd_id","cateProd_seoUrl","cateProd_name"]);
                }
                $data = [
                    "type"     => "product",
                    "list"     => $list,
                    "listProd" => $this->ProductModel->searchProdFieldByFieldSearch("prod_keywords", $strSearch, ["prod_id","prod_seoUrl","prod_name","prod_avatar","prod_currentPrice"])
                ];
                return $data;
            } else {
                if( $this->CateProductModel->checkCateFieldProductExists("cateProd_keyword", $strSearch) ) {
                    $listCateProd  = $this->CateProductModel->searchListCateProdFieldByFieldSearch("cateProd_keyword", $strSearch, ["cateProd_id","cateProd_seoUrl","cateProd_name"]);
                    $listTotalProd = $this->ProductModel->getListALlProductByField(["prod_id","prod_seoUrl","prod_name","prod_avatar","prod_currentPrice","prod_listId_cateProd_ties"]);
                    $listProd      = [];
                    $listProdArr = [];
                    foreach($listCateProd as $cateProdItem) {
                        $idCateProdItem = $cateProdItem['cateProd_id'];
                        $listProdArrItem = [];
                        foreach($listTotalProd as $prodItem) {
                            $arrListCateProdIdTies = json_decode($prodItem['prod_listId_cateProd_ties']);
                            if(in_array( $idCateProdItem , $arrListCateProdIdTies )) {
                                $listProdArrItem[] = $prodItem;
                            }
                        }
                        $listProdArr[] = $listProdArrItem;
                    }

                    foreach($listProdArr as $prodArrItem) {
                        foreach($prodArrItem as $prodItem) {
                            $listProd[] = $prodItem;
                        }
                    }

                    $data = [
                        "type"     => "cateProduct",
                        "list"     => $listCateProd,
                        "listProd" => $listProd
                    ];
                    return $data;
                }
            }
        }

        return [
            "type"     => "empty",
            "list"     => [],
            "listProd" => []
        ];

    }

    public function productAnalysisAndSuggestions($strSearch)
    {
        if( $this->BrandModel->checkFieldBrandExists("brand_name", $strSearch) ) {
            $listBrand   = $this->BrandModel->getListBrandBySearch("brand_name", $strSearch);
            $listProdArr = [];
            $listProd    = [];
            foreach($listBrand as $brandItem) {
                $listProd_r    = $this->ProductModel->getListProdByBrandId($brandItem['brand_id']);
                if(!empty($listProd_r)) {
                    $listProdArr[] = $listProd_r;
                }
            }
            foreach($listProdArr as $prodArrItem) {
                foreach($prodArrItem as $prodItem) {
                    $listProd[] = $prodItem;
                }
            }
            $data = [
                "listProd" => $listProd
            ];
            return $data;
        } else {
            if( $this->ProductModel->checkProdFieldExists("prod_name", $strSearch) ) {
                $data = [
                    "listProd" => $this->ProductModel->searchProductByField("prod_name", $strSearch)
                ];
                return $data;
            } else {
                if( $this->CateProductModel->checkCateFieldProductExists("cateProd_name",$strSearch) ) {
                    $listCateProd  = $this->CateProductModel->searchListCateProdByFieldSearch("cateProd_name", $strSearch);
                    $listTotalProd = $this->ProductModel->getListAllProduct();
                    $listProd      = [];

                    $listProdArr = [];
                    foreach($listCateProd as $cateProdItem) {
                        $idCateProdItem = $cateProdItem['cateProd_id'];
                        $listProdArrItem = [];
                        foreach($listTotalProd as $prodItem) {
                            $arrListCateProdIdTies = json_decode($prodItem['prod_listId_cateProd_ties']);
                            if(in_array( $idCateProdItem , $arrListCateProdIdTies )) {
                                $listProdArrItem[] = $prodItem;
                            }
                        }
                        $listProdArr[] = $listProdArrItem;
                    }

                    foreach($listProdArr as $prodArrItem) {
                        foreach($prodArrItem as $prodItem) {
                            $listProd[] = $prodItem;
                        }
                    }

                    $data = [
                        "listProd" => $listProd
                    ];
                    return $data;
                }
            }

        }

        /**
         * ----- check key word seach main
         */

        if( $this->BrandModel->checkFieldBrandExists("brand_keywords", $strSearch) ) {
            $listBrand   = $this->BrandModel->getListBrandBySearch("brand_keywords", $strSearch);
            $listProdArr = [];
            $listProd    = [];
            foreach($listBrand as $brandItem) {
                $listProd_r    = $this->ProductModel->getListProdByBrandId($brandItem['brand_id']);
                if(!empty($listProd_r)) {
                    $listProdArr[] = $listProd_r;
                }
            }
            foreach($listProdArr as $prodArrItem) {
                foreach($prodArrItem as $prodItem) {
                    $listProd[] = $prodItem;
                }
            }
            $data = [
                "listProd" => $listProd
            ];
            return $data;
            } else {
                if( $this->ProductModel->checkProdFieldExists("prod_keywords", $strSearch) ) {
                    $data = [
                        "listProd" => $this->ProductModel->searchProductByField("prod_keywords", $strSearch)
                    ];
                    return $data;
                } else {
                    if( $this->CateProductModel->checkCateFieldProductExists("cateProd_keyword", $strSearch) ) {
                        $listCateProd  = $this->CateProductModel->searchListCateProdByFieldSearch("cateProd_keyword", $strSearch);
                        $listTotalProd = $this->ProductModel->getListAllProduct();
                        $listProd      = [];

                        $listProdArr = [];
                        foreach($listCateProd as $cateProdItem) {
                            $idCateProdItem = $cateProdItem['cateProd_id'];
                            $listProdArrItem = [];
                            foreach($listTotalProd as $prodItem) {
                                $arrListCateProdIdTies = json_decode($prodItem['prod_listId_cateProd_ties']);
                                if(in_array( $idCateProdItem , $arrListCateProdIdTies )) {
                                    $listProdArrItem[] = $prodItem;
                                }
                            }
                            $listProdArr[] = $listProdArrItem;
                        }

                        foreach($listProdArr as $prodArrItem) {
                            foreach($prodArrItem as $prodItem) {
                                $listProd[] = $prodItem;
                            }
                        }

                        $data = [
                            "listProd" => $listProd
                        ];
                        return $data;
                    }
                }
            }

        return [
            "listProd" => []
        ];
    }

    public function cusomizeUrlSearch()
    {
        $strSearch = Format::validationSearch($_POST['strSearch']);
        $dataAjax = [
            "url" => "search/?q=".$strSearch
        ];
        echo json_encode($dataAjax);
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
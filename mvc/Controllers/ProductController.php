<?php

class ProductController extends BaseController
{
    private $ProductModel;
    private $FlashsaleModel;
    private $CateProductModel;
    private $NewsModel;
    private $ProductspModel;
    private $ConfigModel;

    public function __construct()
    {
        $this->ProductModel     = $this->model("ProductModel");
        $this->FlashsaleModel   = $this->model("FlashsaleModel");
        $this->CateProductModel = $this->model("CateProductModel");
        $this->NewsModel        = $this->model("NewsModel");
        $this->ProductspModel   = $this->model("ProductspModel");
        $this->ConfigModel      = $this->model("ConfigModel");
    }

    public function index()
    {

        $prod_id  = !empty($_GET['id']) ? (int) $_GET['id'] : 0;
        $prodItem = $this->ProductModel->getProdAndBrandTiesItemByIdProd($prod_id);

        if(!empty($prodItem)) {

            $listImagesTies   = $this->ProductModel->getListImagesTiesByIdProd($prodItem['prod_id']);
            $listProductTies  = $this->ProductModel->getListProdTiesByListIdProd(json_decode($prodItem['prod_listId_recomment']));
            $flashSaleToday   = $this->FlashsaleModel->getListFlashSaleTodayByIdProd($prodItem['prod_id']);
            $listCateProdTies = $this->CateProductModel->getListCateProdByListIdCateProd(json_decode($prodItem['prod_listId_cateProd_ties']));
            $listNewsIntro    = $this->NewsModel->selectListNewsByListIdNews(json_decode($prodItem['prod_listId_newsIntro_ties']));
            $listNewsTutorial = $this->NewsModel->selectListNewsByListIdNews(json_decode($prodItem['prod_listId_newsTutorial_ties']));
            $listProdsp       = $this->ProductspModel->getListProdsp();

            $this->recentlyViewedProducts($prodItem, $flashSaleToday);
        }

        $this->view("Frontend.Products.index", [
            "prodItem"         => !empty($prodItem)         ? $prodItem         : null,
            "listImagesTies"   => !empty($listImagesTies)   ? $listImagesTies   : null,
            "flashSaleToday"   => !empty($flashSaleToday)   ? $flashSaleToday   : null,
            "listCateProdTies" => !empty($listCateProdTies) ? $listCateProdTies : null,
            "listNewsIntro"    => !empty($listNewsIntro)    ? $listNewsIntro    : null,
            "listNewsTutorial" => !empty($listNewsTutorial) ? $listNewsTutorial : null,
            "listProductTies"  => !empty($listProductTies)  ? $listProductTies  : null,
            "listProdsp"       => !empty($listProdsp)       ? $listProdsp       : null,
            "configInfo"       => !empty($this->ConfigModel->getInfoConfig()) ? $this->ConfigModel->getInfoConfig() : null
        ]);
    }

    public function infosupport()
    {
        $prodsp_id = !empty($_GET['id']) ? (int) $_GET['id'] : 0;

        $protocol   = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
        $url        = $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        $prod_url   = explode("prod=", $url);

        $prod_id    = !empty($prod_url[1]) ? (int) $prod_url[1] : 0;

        $infoSpItem       = $this->ProductspModel->getProdspItemById($prodsp_id);
        $prodItem         = $this->ProductModel->getProdAndBrandTiesItemByIdProd($prod_id);
        $flashSaleToday   = $this->FlashsaleModel->getListFlashSaleTodayByIdProd($prodItem['prod_id']);


        $this->view("Frontend.Products.infosupport", [
            "infoSpItem"     => $infoSpItem,
            "prodItem"       => $prodItem,
            "flashSaleToday" => $flashSaleToday,
            "configInfo"     => !empty($this->ConfigModel->getInfoConfig()) ? $this->ConfigModel->getInfoConfig() : null
        ]);
    }

    public function recentlyViewedProducts($prodItem, $flashSaleToday)
    {
        $prod_price = !empty($flashSaleToday) ? $flashSaleToday['prod_flashsale_price'] : $prodItem['prod_currentPrice'];
        $dataProdViewed[$prodItem['prod_id']] = [
            "prod_id"               => $prodItem['prod_id'],
            "timeViewed"            => time(),
            "prod_name"             => $prodItem['prod_name'],
            "prod_avatar"           => $prodItem['prod_avatar'],
            "prod_price"            => $prod_price,
            "prod_seoUrl"           => $prodItem['prod_seoUrl'],
            "brand_name"            => $prodItem['brand_name'],
            "brand_id"              => $prodItem['brand_id'],
            "prod_oldPrice"         => $prodItem['prod_oldPrice'],
            "prod_stock_status"     => $prodItem['prod_stock_status'],
            "prod_deliveryPromo"    => $prodItem['prod_deliveryPromo'],
            "prod_installment"      => $prodItem['prod_installment'],
            "prod_installment_rate" => $prodItem['prod_installment_rate'],
            "prod_avt_tax"          => $prodItem['prod_avt_tax'],
            "prod_liquidation"      => $prodItem['prod_liquidation'],
            "prod_discout_content"  => $prodItem['prod_discout_content']
        ];
        $prodSavedCookie = !empty($_COOKIE['prod_recently_viewed']) ? json_decode($_COOKIE['prod_recently_viewed'], true) : [];
        if( isset($_COOKIE['prod_recently_viewed']) && array_key_exists( $prodItem['prod_id'], $prodSavedCookie ) ) {
            $prodSavedCookie[$prodItem['prod_id']]['timeViewed'] = time();
        } else {
            $prodSavedCookie[$prodItem['prod_id']] = $dataProdViewed[$prodItem['prod_id']];
        }
        setcookie( "prod_recently_viewed", json_encode($prodSavedCookie), time() + 3600, "/" );
    }
}
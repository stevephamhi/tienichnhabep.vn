<?php

class HomeController extends BaseController
{
    private $HomeModel;
    private $ProductModel;
    private $CateProductModel;
    private $ConfigModel;

    function __construct()
    {
        $this->HomeModel        = $this->model("HomeModel");
        $this->ProductModel     = $this->model("ProductModel");
        $this->CateProductModel = $this->model("CateProductModel");
        $this->FlashsaleModel   = $this->model("FlashsaleModel");
        $this->ConfigModel      = $this->model("ConfigModel");
    }

    public function index()
    {
        $listDisplayHome = $this->HomeModel->getListAllDisplayInnerJoinMainCateProd();
        $listFlashSale   = $this->FlashsaleModel->getListFlashSaleInToday(time());
        $listProduct     = $this->ProductModel->getListAllProdAndBrandTiesAnd();
        $listCateProduct = $this->CateProductModel->getAllCateProduct();

        // home background by event

        $listBackgroundEventHome = $this->HomeModel->getBackgroundEventHomeToday();

        foreach($listDisplayHome as &$displayHomeItem) {
            $listIdCateProduct   = json_decode($displayHomeItem['display_cateProdId_list_ties']);
            $listIdProdHighlight = json_decode($displayHomeItem['display_prodId_highlight_list_ties']);
            $listIdProdNormal    = json_decode($displayHomeItem['display_prodId_normal_list_ties']);
            $listIdProdMobile    = json_decode($displayHomeItem['display_prodId_mobile_list_ties']);

            foreach($listCateProduct as $cateProdItem) {
                if(in_array($cateProdItem['cateProd_id'], $listIdCateProduct)) {
                    $displayHomeItem["listCateProdRela"][] = $cateProdItem;
                }
                if($cateProdItem['cateProd_id'] == $displayHomeItem['display_cateProdId_main_ties']) {
                    $displayHomeItem['cateProdMain'] = $cateProdItem;
                }
            }
            foreach($listProduct as $prodItem) {
                if(!empty($listFlashSale)) {
                    foreach($listFlashSale as $flashSaleItem) {
                        if($prodItem['prod_id'] == $flashSaleItem['prod_flashsale_prodId']) {
                            $prodItem['flashSale'][] = $flashSaleItem;
                        }
                    }
                }
                if(!empty($listIdProdHighlight)) {
                    if(in_array($prodItem['prod_id'], $listIdProdHighlight)) {
                        $displayHomeItem["listProdHighlight"][] = $prodItem;
                    }
                }
                if(!empty($listIdProdNormal)) {
                    if(in_array($prodItem['prod_id'], $listIdProdNormal)) {
                        $displayHomeItem["listProdNormal"][] = $prodItem;
                    }
                }
                if(!empty($listIdProdMobile)) {
                    if(in_array($prodItem['prod_id'], $listIdProdMobile)) {
                        $displayHomeItem["listProdMobile"][] = $prodItem;
                    }
                }
            }
        }

        $this->view("Frontend.Homes.index", [
            "listDisplayHome"         => !empty($listDisplayHome) ? $listDisplayHome : null,
            "listBackgroundEventHome" => !empty($listBackgroundEventHome) ? $listBackgroundEventHome : null,
            "configInfo"              => !empty($this->ConfigModel->getInfoConfig()) ? $this->ConfigModel->getInfoConfig() : null
        ]);
    }
}
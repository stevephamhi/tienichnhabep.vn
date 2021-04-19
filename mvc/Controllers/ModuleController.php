<?php

class ModuleController extends BaseController
{

    private $ModuleModel;
    private $ProductModel;
    private $FlashsaleModel;
    private $CateProductModel;
    private $ConfigModel;

    public function __construct()
    {
        $this->ModuleModel      = $this->model("ModuleModel");
        $this->ProductModel     = $this->model("ProductModel");
        $this->FlashsaleModel   = $this->model("FlashsaleModel");
        $this->CateProductModel = $this->model("CateProductModel");
        $this->ConfigModel      = $this->model("ConfigModel");
    }

    public function index()
    {
        $module_id = !empty($_GET['id']) ? (int) $_GET['id'] : 0;
        $module = $this->ModuleModel->getModuleById($module_id);

        if(!empty($module)) {
            $listModuleitem = $this->ModuleModel->getListModuleitemByModule_id($module_id);
        }

        if(!empty($listModuleitem)) {
            foreach( $listModuleitem as &$moduleitem_item ) {
                $listModuleBannerPromotion          = $this->ModuleModel->getListModuleBannerPromotionByIdModuleitem($moduleitem_item['moduleitem_id'], "DESC");
                $listProduct                        = $this->handleGetProdByListArrIdjson($moduleitem_item['moduleitem_list_idProd_ties']);
                if(!empty($moduleitem_item['moduleitem_cateProd_id_ties'])) {
                    $cateProdItem                       = $this->CateProductModel->getCateProdItemById($moduleitem_item['moduleitem_cateProd_id_ties']);
                    $moduleitem_item['cateProd_seoUrl'] = $cateProdItem['cateProd_seoUrl'];
                }
                $moduleitem_item['list_prod']       = $listProduct;
                $moduleitem_item['module_banner']   = $listModuleBannerPromotion;
            }
        }

        $this->view("Frontend.Modules.index", [
            "module"         => !empty($module) ? $module         : null,
            "listModuleitem" => !empty($module) ? $listModuleitem : null,
            "configInfo"     => !empty($this->ConfigModel->getInfoConfig()) ? $this->ConfigModel->getInfoConfig() : null
        ]);
    }

    public function handleGetProdByListArrIdjson($listData)
    {
        $result = [];
        $listArrayId   = json_decode($listData, true);
        $listFlashSale = $this->FlashsaleModel->getListFlashSaleInToday(time());
        foreach($listArrayId as $prod_id) {
            $prodItem = $this->ProductModel->getProdItemById($prod_id);
            $result[] = $prodItem;
        }
        if(!empty($result)) {
            foreach($result as &$resultItem) {
                if(!empty($listFlashSale)) {
                    foreach($listFlashSale as $flashSaleItem) {
                        if($resultItem['prod_id'] == $flashSaleItem['prod_flashsale_prodId']) {
                            $resultItem['flashSale'][] = $flashSaleItem;
                        }
                    }
                }
            }
        }

        return $result;
    }
}
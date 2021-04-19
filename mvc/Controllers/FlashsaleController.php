<?php
class FlashsaleController extends BaseController
{
    private $FlashsaleModel;
    private $ModuleModel;

    public function __construct()
    {
        $this->FlashSaleModel = $this->model("FlashsaleModel");
        $this->ModuleModel    = $this->model("ModuleModel");
    }

    public function getListFlashSaleProduct()
    {
        $dateToday = time();
        $listFalShsale = $this->FlashSaleModel->getListFlashSaleByTime($dateToday);
        return [
            "listFalShsale" => $listFalShsale
        ];
    }

    public function getModuleFlashsaleUrl()
    {
        return [
            "moduleFlashsale" => $this->ModuleModel->getModuleIsFlashSale()
        ];
    }
}
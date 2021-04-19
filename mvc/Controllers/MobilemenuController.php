<?php


class MobilemenuController extends BaseController
{

    private $CateProductModel;

    public function __construct()
    {
        $this->CateProductModel = $this->model("CateProductModel");
    }

    public function index()
    {
        $listCateProd    = $this->CateProductModel->getByParentId(0);
        $listCateProdHot = $this->CateProductModel->getCateProdHot();

        $this->view("Frontend.Menus.menuCateProdMobile", [
            "listCateProd"    => $listCateProd,
            "listCateProdHot" => $listCateProdHot
        ]);
    }
}
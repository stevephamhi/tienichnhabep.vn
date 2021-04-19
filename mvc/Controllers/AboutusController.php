<?php

class AboutusController extends BaseController
{
    private $AboutusModel;
    private $ConfigModel;

    public function __construct()
    {
        $this->AboutusModel = $this->model("AboutusModel");
        $this->ConfigModel  = $this->model("ConfigModel");
    }


    public function index($aboutus_id = 0)
    {
        $aboutus_id  = (!empty($_GET['id'])) ? (int) $_GET['id'] : 0;
        $aboutusItem = $this->AboutusModel->getAboutUsItemById($aboutus_id);

        $this->view("Frontend.Aboutuss.index", [
            "aboutusItem" => !empty($aboutusItem) ? $aboutusItem : null,
            "configInfo"  => !empty($this->ConfigModel->getInfoConfig()) ? $this->ConfigModel->getInfoConfig() : null
        ]);
    }
}
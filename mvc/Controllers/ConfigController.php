<?php

class ConfigController extends BaseController
{
    private $ConfigModel;
    
    public function __construct()
    {
        $this->ConfigModel = $this->model("ConfigModel");
    }
    
    public function getConfig()
    {
        return [
            $this->ConfigModel->getInfoConfig()
        ];
    }
}
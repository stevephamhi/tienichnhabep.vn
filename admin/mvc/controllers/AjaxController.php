<?php

class AjaxController extends Controller
{
    function __construct()
    {

    }

    public function cusomizeUrlSearch()
    {
        $searchStr = Format::validationSearch($_POST['searchStr']);
        $dataAjax = [
            "urlSearch" => $searchStr
        ];
        echo json_encode($dataAjax);
    }
}
<?php

class FilterPriceController extends Controller
{
    public function index()
    {
        $dataView = [
            "title"  => "Danh sách lọc giá",
            "layOut" => "ListFilterPrice",
            "css"    => ["home"],
            "data"   => []
        ];
        $this->view("MasterIndex", $dataView);
    }

    public function add()
    {
        $dataView = [
            "title"  => "Thêm danh sách lọc giá",
            "layOut" => "AddFilterPrice",
            "css"    => ["home"],
            "data"   => []
        ];
        $this->view("MasterIndex", $dataView);
    }
}
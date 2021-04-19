<?php

class CustomerGroupController extends Controller
{
    public function index()
    {
        $dataView = [
            "title"  => "DS nhóm khách hàng",
            "layOut" => "ListCustomerGroup",
            "css"    => ["home"],
            "data"   => []
        ];
        $this->view("MasterIndex", $dataView);
    }

    public function add()
    {
        $dataView = [
            "title"  => "Thêm nhóm khách hàng",
            "layOut" => "AddCustomerGroup",
            "css"    => ["home"],
            "data"   => []
        ];
        $this->view("MasterIndex", $dataView);
    }
}
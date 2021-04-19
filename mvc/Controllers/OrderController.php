<?php

class OrderController extends BaseController
{
    private $OrderModel;

    public function __construct()
    {
        $this->OrderModel = $this->model("OrderModel");
    }
    public function handleDeleteItem()
    {
        $order_id = (int) $_POST['order_id'];
        $dataOrder = [
            "order_is_delete" => '1'
        ];
        $process = $this->OrderModel->updateOrder($dataOrder, $order_id);
        if ($process) {
            $dataAjax = [
                "status" => "success"
            ];
        } else {
            $dataAjax = [
                "status" => "error"
            ];
        }
        echo json_encode($dataAjax);
    }
}
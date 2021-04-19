<?php

class HomeController extends Controller
{
    private $SupportCustomerModel;
    private $AgencyModel;
    private $OrderModel;
    private $CustomerModel;

    public function __construct()
    {
        $this->SupportCustomerModel = $this->model("SupportCustomer");
        $this->AgencyModel = $this->model("Agency");
        $this->OrderModel = $this->model("Order");
        $this->CustomerModel = $this->model("Customer");
    }



    public function index()
    {
        $listSupportNo_process = $this->SupportCustomerModel->getListSupportcustomerByStatus("no_process");
        $listAgencyNo_process  = $this->AgencyModel->getListAgencyByStatus("no_process");

        $listOrder             = $this->OrderModel->getListOrderByStatus("processing");

        // ----- //
        $dataNotifiHome = [
            "totalOrder"    => count($this->OrderModel->getListOrderByStatus("all")),
            "totalSales"    => $this->OrderModel->getTotalSalesByOrder(),
            "totalCustomer" => count($this->CustomerModel->getListCustomerByStatus('all')),
        ];
        // ----- //
        $temp_agency = [];
        for ( $i = 0 ; $i < count($listAgencyNo_process) - 1 ; $i++ ) {
            for ( $j = $i + 1 ; $j < count($listAgencyNo_process) ; $j++ ) {
                if ( $listAgencyNo_process[$i]['agency_createDate'] < $listAgencyNo_process[$j]['agency_createDate'] ) {
                    $temp_agency              = $listAgencyNo_process[$i];
                    $listAgencyNo_process[$i] = $listAgencyNo_process[$j];
                    $listAgencyNo_process[$j] = $temp_agency;
                }
            }
        }

        $temp = [];
        for ( $i = 0 ; $i < count($listSupportNo_process) - 1 ; $i++ ) {
            for ( $j = $i + 1 ; $j < count($listSupportNo_process) ; $j++ ) {
                if ( $listSupportNo_process[$i]['sp_customer_time'] < $listSupportNo_process[$j]['sp_customer_time'] ) {
                    $temp                      = $listSupportNo_process[$i];
                    $listSupportNo_process[$i] = $listSupportNo_process[$j];
                    $listSupportNo_process[$j] = $temp;
                }
            }
        }

        $dataView = [
            "title"  => "Bảng điều khiển",
            "layOut" => "Home",
            "css"    => ["home"],
            "data"   => [
                "listSupportNo_process" => !empty($listSupportNo_process) ? $listSupportNo_process : null,
                "listAgencyNo_process"  => !empty($listAgencyNo_process)  ? $listAgencyNo_process  : null,
                "listOrder"             => !empty($listOrder)             ? $listOrder             : null,
                "dataNotifiHome"        => !empty($dataNotifiHome)        ? $dataNotifiHome        : null
            ]
        ];
        $this->view("MasterIndex", $dataView);
    }
}
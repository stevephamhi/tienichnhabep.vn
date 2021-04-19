<?php

class AgencyController extends Controller
{

    private $AgencyModel;
    private $UserModel;

    public function __construct()
    {
        $this->AgencyModel = $this->model("Agency");
        $this->UserModel   = $this->model("User");
    }

    public function index($orderBy = 'desc', $status = 'all', $page = 1, $fieldName = '', $strSearch = '')
    {
        if(!empty($strSearch)) {
            $strSearch = Format::validationSearch($strSearch);
            $listAgency = $this->AgencyModel->searchRecommentByFile($fieldName, $strSearch);
        } else {
            $orderByAllow = ["asc","desc"];
            $statusAllow  = ["all","processed","no_process"];
            $orderBy      = in_array($orderBy,$orderByAllow) ? $orderBy : "asc";
            $status       = in_array($status,$statusAllow)   ? $status  : "all";
            $page         = $page >= 1 ? $page : 1;
            $numPerPage   = 10;
            $totalAgency  = count( $this->AgencyModel->getListAgencyByStatus($status) );
            $totalPage    = ceil($totalAgency / $numPerPage);
            $pageStart    = ($page - 1) * $numPerPage;
            $listAgency   = $this->AgencyModel->getListAgencyByPagination($orderBy, "agency_createDate", $status, $pageStart, $numPerPage);
        }

        $dataView = [
            "title"  => "Đăng ký đại lý",
            "layOut" => "ListRegisAgency",
            "css"    => ["home"],
            "data"   => [
                "orderBy"     => !empty($orderBy)     ? $orderBy      : null,
                "status"      => !empty($status)      ? $status      : null,
                "page"        => !empty($page)        ? $page        : null,
                "numPerPage"  => !empty($numPerPage)  ? $numPerPage  : null,
                "totalPage"   => !empty($totalPage)   ? $totalPage   : null,
                "strSearch"   => !empty($strSearch)   ? $strSearch   : null,
                "listAgency"  => !empty($listAgency)  ? $listAgency  : null,
                "totalAgency" => !empty($totalAgency) ? $totalAgency : count($listAgency),
            ]
        ];
        $this->view("MasterIndex", $dataView);
    }

    public function deleteItem()
    {
        $agency_id = $_POST['agency_id'];
        $process = $this->AgencyModel->deleteAgency($agency_id);
        if($process) {
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

    public function multiDelete()
    {
        $list_agency_id = $_POST['list_agency_id'];
        $agency_id_deleteError = [];
        foreach($list_agency_id as $agency_id_item) {
            $id_agency = (int) $agency_id_item;
            $process = $this->AgencyModel->deleteAgency($id_agency);
            if(!$process) {
                $agency_id_deleteError[] = $agency_id_item;
            }
        }
        if(!empty($agency_id_deleteError)) {
            $dataAjax = [
                "status"            => "error",
                "listIdCantDeleted" => $agency_id_deleteError
            ];
        } else {
            $dataAjax = [
                "status" => "success"
            ];
        }
        echo json_encode($dataAjax);
    }

    public function LoadListAgencyByField()
    {
        $fieldName = $_POST['fieldName'];
        $dataAjax = [
            "listData" => $this->AgencyModel->loadAgencyByField__model($fieldName)
        ];
        echo json_encode($dataAjax);
    }

    public function searchRecommentByFile()
    {
        $searchValue = $_POST['searchValue'];
        $fieldName   = $_POST['fieldName'];
        $dataAjax = [
            "searchData" => $this->AgencyModel->searchRecommentByFile($fieldName, $searchValue)
        ];
        echo json_encode($dataAjax);
    }

    public function detail( $agency_id = 0 )
    {
        $agency_id  = (!empty($agency_id)) ? (int)$agency_id : 0;
        $agencyItem = $this->AgencyModel->getAgencyItembyAgencyId($agency_id);
        $userItem   = !empty($this->UserModel->getUserItemById($agencyItem['agency_user_hander'])) ? $this->UserModel->getUserItemById($agencyItem['agency_user_hander']) : null;
        $dataView = [
            "title"  => "Chi tiết đơn vị đăng ký",
            "layOut" => "DetailAgency",
            "css"    => ["home","fancybox.min"],
            "data"   => [
                "agencyItem" => !empty($agencyItem) ? $agencyItem : null,
                "userItem"  => !empty($userItem) ? $userItem : null
            ]
        ];
        $this->view("MasterIndex", $dataView);
    }

    public function updateStatus()
    {
        $statusChange = $_POST['statusChange'];
        $agency_id    = (int) $_POST['agency_id'];

        if($statusChange == "no_process") {
            $timeProcessed = null;
        } else {
            $timeProcessed = time();
        }

        $helper = new Helper;

        $dataAgency = [
            "agency_status"         => $statusChange,
            "agency_time_processed" => $timeProcessed,
            "agency_user_hander"    => $helper->infoUser("user_id")
        ];

        $process      = $this->AgencyModel->updateAgency($dataAgency, $agency_id);

        if($process) {
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
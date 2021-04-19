<?php

class GroupBannerMainController extends Controller
{
    public $GroupBannerModel;

    function __construct()
    {
        $this->GroupBannerModel = $this->model('GroupBanner');
    }

    public function index($orderBy = 'desc', $status = 'all', $page = 1, $strSearch = '')
    {
        if(!empty($strSearch)) {
            $strSearch = Format::validationSearch($strSearch);
            $listGroupBanner = !empty($this->GroupBannerModel->searchGroupBannerByName($strSearch, "main")) ? $this->GroupBannerModel->searchGroupBannerByName($strSearch, "main") : null;
        } else {
            $orderByAllow  = ["asc","desc"];
            $statusAllow   = ["all","on","off"];
            $orderBy       = in_array($orderBy,$orderByAllow) ? $orderBy : "asc";
            $status        = in_array($status,$statusAllow)   ? $status  : "all";
            $page          = $page >= 1 ? $page : 1;
            $numPerPage    = 10;
            $totalBannerGroup = count($this->GroupBannerModel->getListBannerGroupByStatusAndType("main", $status));
            $totalPage        = ceil($totalBannerGroup / $numPerPage);
            $pageStart        = ($page - 1) * $numPerPage;
            $listGroupBanner  = $this->GroupBannerModel->getListGroupBannerByPagination($orderBy, $status, $pageStart, $numPerPage, "main");
        }
        $dataView = [
            "title"  => "Danh sách banner chính",
            "layOut" => "ListGroupBannerMain",
            "css"    => ["home"],
            "data"   => [
                "orderBy"          => !empty($orderBy) ? $orderBy : null,
                "status"           => !empty($status) ? $status : null,
                "page"             => !empty($page) ? $page : null,
                "listGroupBanner"  => !empty($listGroupBanner) ? $listGroupBanner : null,
                "numPerPage"       => !empty($numPerPage) ? $numPerPage : null,
                "totalPage"        => !empty($totalPage) ? $totalPage : null,
                "strSearch"        => !empty($strSearch) ? $strSearch : null,
                "totalBannerGroup" => !empty($totalBannerGroup) ? $totalBannerGroup : count($listGroupBanner),
            ]
        ];
        $this->view('MasterIndex', $dataView);
    }

    public function add()
    {
        $helper = new Helper;

        if(isset($_POST['addGroupBanner_action'])) {
            $error = [];
            global $error;

            /*
            * --- check group banner status
            */

            $bannerGroup_status = !empty($_POST['bannerGroup_status']) ? "on" : "off";

            /*
            * --- check group banner name
            */

            if(empty($_POST['bannerGroup_name'])) {
                $error['bannerGroup_name'] = "<span class='error'>(*) Vui lòng nhập tên group banner</span>";
            } else {
                $bannerGroup_name = $_POST['bannerGroup_name'];
            }

            /*
            * --- check group banner group customer id ties
            */

            $bannerGroup_customerGroup_ties = !empty($_POST['bannerGroup_customerGroup_ties']) ? $_POST['bannerGroup_customerGroup_ties'] : 1;

            /*
            * --- check group banner start date
            */

            if(empty($_POST['bannerGroup_startDate'])) {
                $error['bannerGroup_startDate'] = "<span class='error'>(*) Vui lòng nhập tên ngày bắt đầu</span>";
            } else {
                $bannerGroup_startDate = strtotime($_POST['bannerGroup_startDate']);
            }

            /*
            * --- check group banner end date
            */

            if(empty($_POST['bannerGroup_endDate'])) {
                $error['bannerGroup_endDate'] = "<span class='error'>(*) Vui lòng nhập ngày kết thúc</span>";
            } else {
                $bannerGroup_endDate = strtotime($_POST['bannerGroup_endDate']);
            }

            /*
            * --- check group banner order
            */

            $bannerGroup_order = !empty($_POST['bannerGroup_order']) ? (int)$_POST['bannerGroup_order'] : ($this->GroupBannerModel->getOrderMaxPlus());

            /*
            * --- check group banner image
            */

            $listBannerMain = [];
            if(!empty($_POST['bannerMain'])) {
                foreach($_POST['bannerMain'] as $bannerMainItem) {
                    if((!empty($bannerMainItem['title'])) && (!empty($bannerMainItem['link']))) {
                        $listBannerMain[] = $bannerMainItem;
                    }
                }
            }

            if(empty($listBannerMain)) {
                $error['listBannerMain'] = "<span class='error'>(*) Vui lòng chọn ít nhất 1 ảnh cho banner</span>";
            } else {
                $_POST['listBannerMain'] = $listBannerMain;
            }

            /*
            *--- check error group banner
            */

            if(empty($error)) {
                if(!($this->GroupBannerModel->checkGroupBannerExists($bannerGroup_name, $bannerGroup_startDate, $bannerGroup_endDate))) {
                    $bannerGroup_createDate = time();
                    $bannerGroup_creatorId  = $helper->infoUser("user_id");
                    $dataGroupBanner = [
                        "bannerGroup_name"               => $bannerGroup_name,
                        "bannerGroup_type"               => "main",
                        "bannerGroup_status"             => $bannerGroup_status,
                        "bannerGroup_customerGroup_ties" => $bannerGroup_customerGroup_ties,
                        "bannerGroup_startDate"          => $bannerGroup_startDate,
                        "bannerGroup_endDate"            => $bannerGroup_endDate,
                        "bannerGroup_order"              => $bannerGroup_order,
                        "bannerGroup_createDate"         => $bannerGroup_createDate,
                        "bannerGroup_creatorId"          => $bannerGroup_creatorId,
                    ];
                    $idGroupBanner = $this->GroupBannerModel->addGroupBannerNew($dataGroupBanner);
                    if(is_int($idGroupBanner)) {
                        if(!empty($listBannerMain)) {
                            foreach($listBannerMain as $bannerMainItem) {
                                $dataBanner = [
                                    "banner_name"               => $bannerMainItem['title'],
                                    "banner_desc"               => $bannerMainItem['desc'],
                                    "banner_link"               => $bannerMainItem['link'],
                                    "banner_target"             => $bannerMainItem['target'],
                                    "banner_imagePc"            => $bannerMainItem['bannerPC'],
                                    "banner_imageMb"            => $bannerMainItem['bannerMB'],
                                    "banner_order"              => $bannerMainItem['order'],
                                    "banner_groupBannerId_ties" => $idGroupBanner,
                                ];
                                $this->GroupBannerModel->addBannerNew($dataBanner);
                            }
                        }
                        $statusActionGroupBanner = [
                            "status"    => "success",
                            "notifiTxt" => "Thêm nhóm sản phẩm thành công"
                        ];
                    } else {
                        $statusActionGroupBanner = [
                            "status"    => "error",
                            "notifiTxt" => "Thêm nhóm sản phẩm không thành công"
                        ];
                    }
                } else {
                    $statusActionGroupBanner = [
                        "status"    => "error",
                        "notifiTxt" => "Nhóm banner đã tồn tại [ERROR: Trùng tên , ngày bắt đầu, ngày kết thúc]"
                    ];
                }
            } else {
                $statusActionGroupBanner = [
                    "status"    => "error",
                    "notifiTxt" => "Một số thông tin bạn chưa hoàn thành hoặc không đúng kiểu dữ liệu"
                ];
            }
        }

        $dataView = [
            "title"  => "Thêm nhóm banner chính",
            "layOut" => "AddGroupBannerMain",
            "css"    => ["home","fancybox.min"],
            "data"   => [
                "statusActionGroupBanner" => !empty($statusActionGroupBanner) ? $statusActionGroupBanner : []
            ]
        ];
        $this->view("MasterIndex", $dataView);
    }

    public function update($groupBanner_id = 0)
    {
        $groupBanner_id  = (!empty($groupBanner_id)) ? (int) $groupBanner_id : 0;
        $groupBannerItem = $this->GroupBannerModel->getGroupBannerItemById($groupBanner_id);

        /*
        * --------------------------------------
        * ----- Handle update group banner -----
        * --------------------------------------
        */

        if(isset($_POST['updateGroupBanner_action'])) {
            $error = [];
            global $error;

            /*
            * --- check group banner status
            */

            $bannerGroup_status = !empty($_POST['bannerGroup_status']) ? "on" : "off";

            /*
            * --- check group banner name
            */

            if(empty($_POST['bannerGroup_name'])) {
                $error['bannerGroup_name'] = "<span class='error'>(*) Vui lòng nhập tên group banner</span>";
            } else {
                $bannerGroup_name = $_POST['bannerGroup_name'];
            }

            /*
            * --- check group banner group customer id ties
            */

            $bannerGroup_customerGroup_ties = !empty($_POST['bannerGroup_customerGroup_ties']) ? $_POST['bannerGroup_customerGroup_ties'] : 1;
            echo $_POST['bannerGroup_customerGroup_ties'];

            /*
            * --- check group banner start date
            */

            if(empty($_POST['bannerGroup_startDate'])) {
                $error['bannerGroup_startDate'] = "<span class='error'>(*) Vui lòng nhập tên ngày bắt đầu</span>";
            } else {
                $bannerGroup_startDate = strtotime($_POST['bannerGroup_startDate']);
            }

            /*
            * --- check group banner end date
            */

            if(empty($_POST['bannerGroup_endDate'])) {
                $error['bannerGroup_endDate'] = "<span class='error'>(*) Vui lòng nhập ngày kết thúc</span>";
            } else {
                $bannerGroup_endDate = strtotime($_POST['bannerGroup_endDate']);
            }

            /*
            * --- check group banner order
            */

            $bannerGroup_order = !empty($_POST['bannerGroup_order']) ? (int)$_POST['bannerGroup_order'] : ($this->GroupBannerModel->getOrderMaxPlus());

            /*
            * --- check group banner image
            */

            $listBannerMain = [];
            if(!empty($_POST['bannerMain'])) {
                foreach($_POST['bannerMain'] as $bannerMainItem) {
                    if((!empty($bannerMainItem['title'])) && (!empty($bannerMainItem['link']))) {
                        $listBannerMain[] = $bannerMainItem;
                    }
                }
            }

            if(empty($listBannerMain)) {
                $error['listBannerMain'] = "<span class='error'>(*) Vui lòng chọn ít nhất 1 ảnh cho banner</span>";
            } else {
                $_POST['listBannerMain'] = $listBannerMain;
            }

            /*
            *--- check error group banner
            */

            if(empty($error)) {
                $bannerGroup_updateDate = time();
                $dataGroupBanner = [
                    "bannerGroup_name"               => $bannerGroup_name,
                    "bannerGroup_status"             => $bannerGroup_status,
                    "bannerGroup_customerGroup_ties" => $bannerGroup_customerGroup_ties,
                    "bannerGroup_startDate"          => $bannerGroup_startDate,
                    "bannerGroup_endDate"            => $bannerGroup_endDate,
                    "bannerGroup_order"              => $bannerGroup_order,
                    "bannerGroup_updateDate"         => $bannerGroup_updateDate,
                ];
                $process = $this->GroupBannerModel->updateGroupBanner($dataGroupBanner, $groupBanner_id);
                if($process) {
                    // handle delete total banner
                    $this->GroupBannerModel->deleteTotalBannerByGroupBannerId($groupBanner_id);
                    // --------------------------
                    if(!empty($listBannerMain)) {
                        foreach($listBannerMain as $bannerMainItem) {
                            $dataBanner = [
                                "banner_name"               => $bannerMainItem['title'],
                                "banner_desc"               => $bannerMainItem['desc'],
                                "banner_link"               => $bannerMainItem['link'],
                                "banner_target"             => $bannerMainItem['target'],
                                "banner_imagePc"            => $bannerMainItem['bannerPC'],
                                "banner_imageMb"            => $bannerMainItem['bannerMB'],
                                "banner_order"              => $bannerMainItem['order'],
                                "banner_groupBannerId_ties" => $groupBanner_id,
                            ];
                            $this->GroupBannerModel->addBannerNew($dataBanner);
                        }
                    }

                    $statusActionGroupBanner = [
                        "status" => "success",
                        "notifiTxt" => "Cập nhật group banner thành công"
                    ];
                }

            } else {
                $statusActionGroupBanner = [
                    "status"    => "error",
                    "notifiTxt" => "Một số thông tin bạn chưa hoàn thành hoặc không đúng kiểu dữ liệu"
                ];
            }
        }

        $dataView = [
            "title"  => "Cập nhật banner chính",
            "layOut" => "UpdateGroupBannerMain",
            "css"    => ["home","fancybox.min"],
            "data"   => [
                "groupBannerItem" => $groupBannerItem,
                "listBanner"      => $this->GroupBannerModel->getListBannerByGroupBannerId($groupBanner_id),
                "statusActionGroupBanner" => !empty($statusActionGroupBanner) ? $statusActionGroupBanner : null
            ]
        ];
        $this->view("MasterIndex", $dataView);

    }

    public function changeStatus()
    {
        $statusChange    = $_POST['statusChange'];
        $groupBanner_id  = $_POST['groupBanner_id'];
        $dataGroupBanner = [
            "bannerGroup_status" => $statusChange
        ];
        $process = $this->GroupBannerModel->updateGroupBanner($dataGroupBanner, $groupBanner_id);
        if($process) {
            $dataAjax = [
                "status" => "success",
            ];
        } else {
            $dataAjax = [
                "status" => "error"
            ];
        }
        echo json_encode($dataAjax);
    }

    public function deleteItem() {
        $GroupBanner_id = $_POST['GroupBanner_id'];
        $process = $this->GroupBannerModel->deleteGroupBanner($GroupBanner_id);
        if($process) {
            $this->GroupBannerModel->deleteTotalBannerByGroupBannerId($GroupBanner_id);
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
        $listGroupBannerId = $_POST['listGroupBannerId'];
        $GroupBannerIdDeleteError   = [];
        foreach($listGroupBannerId as $GroupBannerIdItem) {
            $idGroupBanner = (int) $GroupBannerIdItem;
            $process    = $this->GroupBannerModel->deleteGroupBanner($idGroupBanner);
            if(!$process) {
                $GroupBannerIdDeleteError[] = $GroupBannerIdItem;
            } else {
                $this->GroupBannerModel->deleteTotalBannerByGroupBannerId($idGroupBanner);
            }
        }
        if(!empty($GroupBannerIdDeleteError)) {
            $dataAjax = [
                "status"            => "error",
                "listIdCantDeleted" => $GroupBannerIdDeleteError
            ];
        } else {
            $dataAjax = [
                "status" => "success",
            ];
        }
        echo json_encode($dataAjax);
    }

    public function multiChangeStatus()
    {
        $listGroupBannerId = $_POST['listGroupBannerId'];
        $statusChange = $_POST['statusChange'];
        $GroupBannerIdUpdateError = [];
        foreach($listGroupBannerId as $GroupBannerIdItem) {
            $idGroupBanner   = (int) $GroupBannerIdItem;
            $dataGroupBanner = [
                "bannerGroup_status" => $statusChange
            ];
            $process = $this->GroupBannerModel->updateGroupBanner($dataGroupBanner, $idGroupBanner);
            if(!$process) {
                $GroupBannerIdUpdateError[] = $GroupBannerIdItem;
            }
        }
        if(!empty($GroupBannerIdUpdateError)) {
            $dataAjax = [
                "status"            => "error",
                "GroupBannerIdUpdateError" => $GroupBannerIdUpdateError
            ];
        } else {
            $dataAjax = [
                "status" => "success"
            ];
        }
        echo json_encode($dataAjax);
    }

    public function recommentSearch()
    {
        $vlSearch  = Format::validation($_POST['vlSearch']);
        $groupType = $_POST['groupType'];
        $result    = $this->GroupBannerModel->searchGroupBannerByName($vlSearch, $groupType);
        $dataAjax  = [
            "searchData" => $result
        ];
        echo json_encode($dataAjax);
    }

    public function loadTotalGroupBanner()
    {
        $groupType = $_POST['groupType'];
        $dataAjax = [
            "recommentData" => $this->GroupBannerModel->getListTotalGroupBannerByGroupBannerType($groupType)
        ];
        echo json_encode($dataAjax);
    }

}
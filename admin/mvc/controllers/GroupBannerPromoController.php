<?php

class GroupBannerPromoController extends Controller
{
    public $GroupBannerModel;

    function __construct()
    {
        $this->GroupBannerModel = $this->model("GroupBanner");
    }

    public function index($orderBy = 'desc', $status = 'all', $page = 1, $strSearch = '')
    {
        if(!empty($strSearch)) {
            $strSearch = Format::validationSearch($strSearch);
            $listGroupBanner = !empty($this->GroupBannerModel->searchGroupBannerByName($strSearch, "promo")) ? $this->GroupBannerModel->searchGroupBannerByName($strSearch, "promo") : null;
        } else {
            $orderByAllow  = ["asc","desc"];
            $statusAllow   = ["all","on","off"];
            $orderBy       = in_array($orderBy,$orderByAllow) ? $orderBy : "asc";
            $status        = in_array($status,$statusAllow)   ? $status  : "all";
            $page          = $page >= 1 ? $page : 1;
            $numPerPage    = 10;
            $totalBannerGroup = count($this->GroupBannerModel->getListBannerGroupByStatusAndType("promo", $status));
            $totalPage        = ceil($totalBannerGroup / $numPerPage);
            $pageStart        = ($page - 1) * $numPerPage;
            $listGroupBanner  = $this->GroupBannerModel->getListGroupBannerByPagination($orderBy, $status, $pageStart, $numPerPage, "promo");
        }

        $dataView = [
            "title"  => "Danh sách banner khuyến mãi",
            "layOut" => "ListGroupBannerPromo",
            "css"    => ["home"],
            "data"   => [
                "orderBy"          => !empty($orderBy) ? $orderBy : null,
                "status"           => !empty($status) ? $status : null,
                "page"             => !empty($page) ? $page : null,
                "numPerPage"       => !empty($numPerPage) ? $numPerPage : null,
                "totalPage"        => !empty($totalPage) ? $totalPage : null,
                "strSearch"        => !empty($strSearch) ? $strSearch : null,
                "listGroupBanner"  => !empty($listGroupBanner) ? $listGroupBanner : null,
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

            $bannerGroup_status = !empty($_POST['bannerGroup_status_promo']) ? "on" : "off";

            /*
            * --- check group banner name
            */

            if(empty($_POST['bannerGroup_name_promo'])) {
                $error['bannerGroup_name_promo'] = "<span class='error'>(*) Vui lòng nhập tên group banner</span>";
            } else {
                $bannerGroup_name = $_POST['bannerGroup_name_promo'];
            }

            /*
            * --- check group banner group customer id ties
            */

            $bannerGroup_customerGroup_ties = !empty($_POST['bannerGroup_customerGroup_ties_promo']) ? $_POST['bannerGroup_customerGroup_ties_promo'] : 1;

            /*
            * --- check group banner start date
            */

            if(empty($_POST['bannerGroup_startDate_promo'])) {
                $error['bannerGroup_startDate_promo'] = "<span class='error'>(*) Vui lòng nhập tên ngày bắt đầu</span>";
            } else {
                $bannerGroup_startDate = strtotime($_POST['bannerGroup_startDate_promo']);
            }

            /*
            * --- check group banner end date
            */

            if(empty($_POST['bannerGroup_endDate_promo'])) {
                $error['bannerGroup_endDate_promo'] = "<span class='error'>(*) Vui lòng nhập ngày kết thúc</span>";
            } else {
                $bannerGroup_endDate = strtotime($_POST['bannerGroup_endDate_promo']);
            }

            /*
            * --- check group banner order
            */

            $bannerGroup_order = !empty($_POST['bannerGroup_order_promo']) ? (int)$_POST['bannerGroup_order_promo'] : ($this->GroupBannerModel->getOrderMaxPlus());

            /*
            * --- check group banner image
            */

            $listBannerPromo = [];
            if(!empty($_POST['bannerPromo'])) {
                foreach($_POST['bannerPromo'] as $bannerPromoItem) {
                    if((!empty($bannerPromoItem['title'])) && (!empty($bannerPromoItem['link']))) {
                        $listBannerPromo[] = $bannerPromoItem;
                    }
                }
            }

            if(empty($listBannerPromo)) {
                $error['listBannerPromo'] = "<span class='error'>(*) Vui lòng chọn ít nhất 1 ảnh cho banner</span>";
            } else {
                $_POST['listBannerPromo'] = $listBannerPromo;
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
                        "bannerGroup_type"               => "promo",
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
                        if(!empty($listBannerPromo)) {
                            foreach($listBannerPromo as $bannerPromoItem) {
                                $dataBanner = [
                                    "banner_name"               => $bannerPromoItem['title'],
                                    "banner_desc"               => $bannerPromoItem['desc'],
                                    "banner_link"               => $bannerPromoItem['link'],
                                    "banner_target"             => !empty($bannerPromoItem['target']) ? $bannerPromoItem['target'] : "blank",
                                    "banner_imagePc"            => $bannerPromoItem['bannerPC'],
                                    "banner_order"              => $bannerPromoItem['order'],
                                    "banner_groupBannerId_ties" => $idGroupBanner,
                                ];
                                $this->GroupBannerModel->addBannerNew($dataBanner);
                            }
                        }
                        $statusActionGroupBanner = [
                            "status"    => "success",
                            "notifiTxt" => "Thêm nhóm banner khuyến mãi thành công"
                        ];
                    } else {
                        $statusActionGroupBanner = [
                            "status"    => "error",
                            "notifiTxt" => "Thêm nhóm banner khuyến mãi không thành công"
                        ];
                    }
                } else {
                    $statusActionGroupBanner = [
                        "status"    => "error",
                        "notifiTxt" => "Nhóm banner khuyễn mãi đã tồn tại [ERROR: Trùng tên , ngày bắt đầu, ngày kết thúc]"
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
            "title"  => "Thêm banner khuyến mãi",
            "layOut" => "AddGroupBannerPromo",
            "css"    => ["home","fancybox.min"],
            "data"   => [
                "statusActionGroupBanner" => !empty($statusActionGroupBanner) ? $statusActionGroupBanner : null
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

            $bannerGroup_status = !empty($_POST['bannerGroup_status_promo']) ? "on" : "off";

            /*
            * --- check group banner name
            */

            if(empty($_POST['bannerGroup_name_promo'])) {
                $error['bannerGroup_name_promo'] = "<span class='error'>(*) Vui lòng nhập tên group banner</span>";
            } else {
                $bannerGroup_name = $_POST['bannerGroup_name_promo'];
            }

            /*
            * --- check group banner group customer id ties
            */

            $bannerGroup_customerGroup_ties = !empty($_POST['bannerGroup_customerGroup_ties_promo']) ? $_POST['bannerGroup_customerGroup_ties_promo'] : 1;

            /*
            * --- check group banner start date
            */

            if(empty($_POST['bannerGroup_startDate_promo'])) {
                $error['bannerGroup_startDate_promo'] = "<span class='error'>(*) Vui lòng nhập tên ngày bắt đầu</span>";
            } else {
                $bannerGroup_startDate = strtotime($_POST['bannerGroup_startDate_promo']);
            }

            /*
            * --- check group banner end date
            */

            if(empty($_POST['bannerGroup_endDate_promo'])) {
                $error['bannerGroup_endDate_promo'] = "<span class='error'>(*) Vui lòng nhập ngày kết thúc</span>";
            } else {
                $bannerGroup_endDate = strtotime($_POST['bannerGroup_endDate_promo']);
            }

            /*
            * --- check group banner order
            */

            $bannerGroup_order = !empty($_POST['bannerGroup_order_promo']) ? (int)$_POST['bannerGroup_order_promo'] : ($this->GroupBannerModel->getOrderMaxPlus());

            /*
            * --- check group banner image
            */

            $listBannerPromo = [];
            if(!empty($_POST['bannerPromo'])) {
                foreach($_POST['bannerPromo'] as $bannerPromoItem) {
                    if((!empty($bannerPromoItem['title'])) && (!empty($bannerPromoItem['link']))) {
                        $listBannerPromo[] = $bannerPromoItem;
                    }
                }
            }

            if(empty($listBannerPromo)) {
                $error['listbannerPromo'] = "<span class='error'>(*) Vui lòng chọn ít nhất 1 ảnh cho banner</span>";
            } else {
                $_POST['listbannerPromo'] = $listBannerPromo;
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
                    if(!empty($listBannerPromo)) {
                        foreach($listBannerPromo as $bannerPromoItem) {
                            $dataBanner = [
                                "banner_name"               => $bannerPromoItem['title'],
                                "banner_desc"               => $bannerPromoItem['desc'],
                                "banner_link"               => $bannerPromoItem['link'],
                                "banner_target"             => !empty($bannerPromoItem['target']) ? $bannerPromoItem['target'] : 'blank',
                                "banner_imagePc"            => $bannerPromoItem['bannerPC'],
                                "banner_order"              => $bannerPromoItem['order'],
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
            "title"  => "Cập nhật banner phải",
            "layOut" => "UpdateGroupBannerPromo",
            "css"    => ["home","fancybox.min"],
            "data"   => [
                "groupBannerItem"         => !empty($groupBannerItem) ? $groupBannerItem : null,
                "listBanner"              => !empty($this->GroupBannerModel->getListBannerByGroupBannerId($groupBanner_id)) ? $this->GroupBannerModel->getListBannerByGroupBannerId($groupBanner_id) : null,
                "statusActionGroupBanner" => !empty($statusActionGroupBanner) ? $statusActionGroupBanner : null
            ]
        ];

        $this->view("MasterIndex", $dataView);
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
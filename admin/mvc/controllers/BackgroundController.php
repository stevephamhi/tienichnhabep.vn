<?php

class BackgroundController extends Controller
{
    private $BackgroundModel;

    public function __construct()
    {
        $this->BackgroundModel = $this->model("Background");
    }

    public function index($orderBy = 'desc', $status = 'all', $page = 1, $strSearch = '')
    {
        if(!empty($strSearch)) {
            $strSearch = Format::validationSearch($strSearch);
            $listBackground = $this->BackgroundModel->searchBackgroundByName($strSearch);
        } else {
            $orderByAllow    = ["asc","desc"];
            $statusAllow     = ["all","on","off"];
            $orderBy         = in_array($orderBy,$orderByAllow) ? $orderBy : "asc";
            $status          = in_array($status,$statusAllow)   ? $status  : "all";
            $page            = $page >= 1 ? $page : 1;
            $numPerPage      = 10;
            $totalBackground = count($this->BackgroundModel->getListBackgroundByStatus($status));
            $totalPage       = ceil($totalBackground / $numPerPage);
            $pageStart       = ($page - 1) * $numPerPage;
            $listBackground  = $this->BackgroundModel->getListBackgroundByPagination($orderBy, $status, $pageStart, $numPerPage);
        }

        $dataView = [
            "title"  => "Danh sách hình nền",
            "layOut" => "ListBackground",
            "css"    => ["home"],
            "data"   => [
                "orderBy"         => !empty($orderBy) ? $orderBy : null,
                "status"          => !empty($status) ? $status : null,
                "page"            => !empty($page) ? $page : null,
                "numPerPage"      => !empty($numPerPage) ? $numPerPage : null,
                "totalPage"       => !empty($totalPage) ? $totalPage : null,
                "strSearch"       => !empty($strSearch) ? $strSearch : null,
                "listBackground"  => !empty($listBackground) ? $listBackground : null,
                "totalBackground" => !empty($totalBackground) ? $totalBackground : count($listBackground),
            ]
        ];
        $this->view("MasterIndex", $dataView);
    }

    public function add()
    {

        $helper = new Helper;

        if(isset($_POST['addBackground_action'])) {
            $error = [];
            global $error;

            /*
            * --- check backgorund status
            */

            $background_status = !empty($_POST['background_status']) ? "on" : "off";

            /*
            * --- check backgorund name
            */

            if(empty($_POST['background_name'])) {
                $error['background_name'] = "<span class='error'>(*) Vui lòng thêm tên cho background</span>";
            } else {
                $background_name = $_POST['background_name'];
            }

            /*
            * --- check backgorund start date
            */

            if(empty($_POST['background_startDate'])) {
                $error['background_startDate'] = "<span class='error'>(*) Vui lòng thêm ngày bắt đầu</span>";
            } else {
                $background_startDate = strtotime($_POST['background_startDate']);
            }

            /*
            * --- check backgorund end date
            */

            if(empty($_POST['background_endDate'])) {
                $error['background_endDate'] = "<span class='error'>(*) Vui lòng thêm ngày kết thúc</span>";
            } else {
                $background_endDate = strtotime($_POST['background_endDate']);
            }

            /*
            * --- check backgorund end order
            */

            $background_order = !empty($_POST['background_order']) ? (int)$_POST['background_order'] : ($this->BackgroundModel->getOrderMaxPlus());

            /*
            * --- check backgorund image
            */

            if(empty($_POST['background_image'])) {
                $error['background_image'] = "<span class='error'>(*) Vui lòng chọn ảnh hiển thị</span>";
            } else {
                $background_image = $_POST['background_image'];
            }

            /*
            * --- check backgorund error
            */

            if(empty($error)) {
                if(!($this->BackgroundModel->checkBackgroundExists($background_startDate, $background_endDate))) {
                    $background_createDate = time();
                    $background_creatorId = $helper->infoUser("user_id");

                    $dataBackground = [
                        "background_name"       => $background_name,
                        "background_status"     => $background_status,
                        "background_image"      => $background_image,
                        "background_startDate"  => $background_startDate,
                        "background_endDate"    => $background_endDate,
                        "background_order"      => $background_order,
                        "background_createDate" => $background_createDate,
                        "background_creatorId"  => $background_creatorId,
                    ];

                    $idBackground = $this->BackgroundModel->addBackgroundNew($dataBackground);
                    if(is_int($idBackground)) {
                        $statusActionBackground = [
                            "status"    => "success",
                            "notifiTxt" => "Thêm background thành công"
                        ];
                    } else {
                        $statusActionBackground = [
                            "status"    => "error",
                            "notifiTxt" => "Thêm background không thành công"
                        ];
                    }
                } else {
                    $statusActionBackground = [
                        "status"    => "error",
                        "notifiTxt" => "Background này đã tồn tại [Trùng ngày bắt đầu và ngày kết thúc]"
                    ];
                }
            } else {
                $statusActionBackground = [
                    "status"    => "error",
                    "notifiTxt" => "Một số thông tin bạn chưa hoàn thành hoặc không đúng kiểu dữ liệu"
                ];
            }

        }

        $dataView = [
            "title"  => "Thêm hình nền giao diện",
            "layOut" => "AddBackground",
            "css"    => ["home","fancybox.min"],
            "data"   => [
                "statusActionBackground" => !empty($statusActionBackground) ? $statusActionBackground : null
            ]
        ];
        $this->view("MasterIndex", $dataView);
    }

    public function update($background_id = 0)
    {
        $background_id  = (!empty($background_id)) ? (int)$background_id : 0;
        $backgroundItem = $this->BackgroundModel->getBackgroundItemById($background_id);

        /*
        * ------------------------------------
        * ----- Handle update background -----
        * ------------------------------------
        */

        if(isset($_POST['updateBackground_action'])) {
            $error = [];
            global $error;

            /*
            * --- check backgorund status
            */

            $background_status = !empty($_POST['background_status']) ? "on" : "off";

            /*
            * --- check backgorund name
            */

            if(empty($_POST['background_name'])) {
                $error['background_name'] = "<span class='error'>(*) Vui lòng thêm tên cho background</span>";
            } else {
                $background_name = $_POST['background_name'];
            }

            /*
            * --- check backgorund start date
            */

            if(empty($_POST['background_startDate'])) {
                $error['background_startDate'] = "<span class='error'>(*) Vui lòng thêm ngày bắt đầu</span>";
            } else {
                $background_startDate = strtotime($_POST['background_startDate']);
            }

            /*
            * --- check backgorund end date
            */

            if(empty($_POST['background_endDate'])) {
                $error['background_endDate'] = "<span class='error'>(*) Vui lòng thêm ngày kết thúc</span>";
            } else {
                $background_endDate = strtotime($_POST['background_endDate']);
            }

            /*
            * --- check backgorund end order
            */

            $background_order = !empty($_POST['background_order']) ? (int)$_POST['background_order'] : ($this->BackgroundModel->getOrderMaxPlus());

            /*
            * --- check backgorund image
            */

            if(empty($_POST['background_image'])) {
                $error['background_image'] = "<span class='error'>(*) Vui lòng chọn ảnh hiển thị</span>";
            } else {
                $background_image = $_POST['background_image'];
            }

            /*
            * --- check backgorund error
            */

            if(empty($error)) {
                $background_updateDate = time();
                $dataBackground = [
                    "background_name"       => $background_name,
                    "background_status"     => $background_status,
                    "background_image"      => $background_image,
                    "background_startDate"  => $background_startDate,
                    "background_endDate"    => $background_endDate,
                    "background_order"      => $background_order,
                    "background_updateDate" => $background_updateDate,
                ];
                $process = $this->BackgroundModel->updateBackground($dataBackground, $background_id);
                if($process) {
                    $statusActionBackground = [
                        "status"    => "success",
                        "notifiTxt" => "Cập nhật background thành công"
                    ];
                } else {
                    $statusActionBackground = [
                        "status"    => "error",
                        "notifiTxt" => "Cập nhật background không thành công"
                    ];
                }
            } else {
                $statusActionBackground = [
                    "status"    => "error",
                    "notifiTxt" => "Một số thông tin bạn chưa hoàn thành hoặc không đúng kiểu dữ liệu"
                ];
            }
        }

        $dataView = [
            "title"  => "Cập nhật ảnh giao diện",
            "layOut" => "UpdateBackground",
            "css"    => ["home","fancybox.min"],
            "data"   => [
                "backgroundItem"         => !empty($backgroundItem) ? $backgroundItem : null,
                "statusActionBackground" => !empty($statusActionBackground) ? $statusActionBackground : null
            ]
        ];

        $this->view("MasterIndex", $dataView);
    }

    public function changeStatus()
    {
        $background_id  = (int)$_POST['background_id'];
        $statusChange = Format::validation($_POST['statusChange']);
        $dataBackground = [
            "background_status" => $statusChange
        ];
        $process = $this->BackgroundModel->updateBackground($dataBackground, $background_id);
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

    public function deleteItem()
    {
        $background_id = $_POST['background_id'];
        $process = $this->BackgroundModel->deleteBackground($background_id);
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
        $listBackgroundId = $_POST['listBackgroundId'];
        $cateBackgroundIdDeleteError   = [];
        foreach($listBackgroundId as $backgroundIdItem) {
            $idBackground = (int) $backgroundIdItem;
            $process    = $this->BackgroundModel->deleteBackground($idBackground);
            if(!$process) {
                $BackgroundIdDeleteError[] = $backgroundIdItem;
            }
        }
        if(!empty($cateBackgroundIdDeleteError)) {
            $dataAjax = [
                "status"            => "error",
                "cateBackgroundIdDeleteError" => $cateBackgroundIdDeleteError
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
        $listBackgroundId        = $_POST['listBackgroundId'];
        $statusChange          = $_POST['statusChange'];
        $backgroundIdUpdateError = [];
        foreach($listBackgroundId as $backgroundIdItem) {
            $idBackground   = (int) $backgroundIdItem;
            $dataBackground = [
                "Background_status" => $statusChange
            ];
            $process = $this->BackgroundModel->updateBackground($dataBackground, $idBackground);
            if(!$process) {
                $backgroundIdUpdateError[] = $backgroundIdItem;
            }
        }
        if(!empty($BackgroundIdUpdateError)) {
            $dataAjax = [
                "status"                => "error",
                "backgroundIdUpdateError" => $backgroundIdUpdateError
            ];
        } else {
            $dataAjax = [
                "status" => "success"
            ];
        }
        echo json_encode($dataAjax);
    }

    public function getAllBackground()
    {
        $dataAjax = [
            "listBackground" => $this->BackgroundModel->getListBackgroundByStatus("all")
        ];
        echo json_encode($dataAjax);
    }

    public function recommentSearch()
    {
        $vlSearch = $_POST['vlSearch'];
        $result   = $this->BackgroundModel->searchBackgroundByName($vlSearch);
        $dataAjax = [
            "searchData" => $result
        ];
        echo json_encode($dataAjax);
    }

    public function updateBackgroundOrder()
    {
        $backgroundOrderChange = (int) $_POST['backgroundOrderChange'];
        $background_ID           = (int) $_POST['background_ID'];
        $dataDisplay = [
            "background_order" => $backgroundOrderChange
        ];
        $process = $this->BackgroundModel->updateBackground($dataDisplay, $background_ID);
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
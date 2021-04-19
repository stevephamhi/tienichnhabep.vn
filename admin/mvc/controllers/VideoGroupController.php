<?php

class VideoGroupController extends Controller
{
    protected $VideoGroupModel;
    protected $ProductModel;

    function __construct()
    {
        $this->VideoGroupModel = $this->model("VideoGroup");
        $this->ProductModel    = $this->model("Product");
    }

    public function index($orderBy = 'desc', $status = 'all', $page = 1, $strSearch = '')
    {
        if(!empty($strSearch)) {
            $strSearch = Format::validationSearch($strSearch);
            $listVideoGroup = $this->VideoGroupModel->searchVideoGroupByName($strSearch);
        } else {
            $orderByAllow  = ["asc","desc"];
            $statusAllow   = ["all","on","off"];
            $orderBy       = in_array($orderBy,$orderByAllow) ? $orderBy : "asc";
            $status        = in_array($status,$statusAllow)   ? $status  : "all";
            $page          = $page >= 1 ? $page : 1;
            $numPerPage    = 10;
            $totalVideoGroup = count($this->VideoGroupModel->getListVideoGroupByStatus($status));
            $totalPage      = ceil($totalVideoGroup / $numPerPage);
            $pageStart      = ($page - 1) * $numPerPage;
            $listVideoGroup  = $this->VideoGroupModel->getListVideoGroupByPagination($orderBy,"videoGroup_order" , $status, $pageStart, $numPerPage);
        }

        $dataView = [
            "title"  => "Danh nhóm video",
            "layOut" => "ListVideoGroup",
            "css"    => ["home"],
            "data"   => [
                "orderBy"          => !empty($orderBy) ? $orderBy : null,
                "status"           => !empty($status) ? $status : null,
                "page"             => !empty($page) ? $page : null,
                "listVideoGroup"   => !empty($listVideoGroup) ? $listVideoGroup : null,
                "numPerPage"       => !empty($numPerPage) ? $numPerPage : null,
                "totalPage"        => !empty($totalPage) ? $totalPage : null,
                "strSearch"        => !empty($strSearch) ? $strSearch : null,
                "totalVideoGroup"  => !empty($totalVideoGroup) ? $totalVideoGroup : count($listVideoGroup),
            ]
        ];
        $this->view("MasterIndex", $dataView);
    }

    public function add()
    {
        $helper = new Helper;

        if(isset($_POST['addVideoGroup_action'])) {
            $error = [];
            global $error;

            /*
            * --- check group video status
            */

            $videoGroup_status = !empty($_POST['videoGroup_status']) ? "on" : "off";

            /*
            * --- check group video name
            */

            if(empty($_POST['videoGroup_name'])) {
                $error['videoGroup_name'] = "<span class='error'>(*) Vui lòng tên nhóm video</span>";
            } else {
                $videoGroup_name = $_POST['videoGroup_name'];
            }

            /*
            * --- check group video start date
            */

            if(empty($_POST['videoGroup_startDate'])) {
                $error['videoGroup_startDate'] = "<span class='error'>(*) Vui lòng nhập ngày bắt đầu</span>";
            } else {
                $videoGroup_startDate = strtotime($_POST['videoGroup_startDate']);
            }

            /*
            * --- check group video end date
            */

            if(empty($_POST['videoGroup_endDate'])) {
                $error['videoGroup_endDate'] = "<span class='error'>(*) Vui lòng nhập ngày kết thúc</span>";
            } else {
                $videoGroup_endDate = strtotime($_POST['videoGroup_endDate']);
            }

            /*
            * --- check group video order
            */

            $videoGroup_order = !empty($_POST['videoGroup_order']) ? (int) $_POST['videoGroup_order'] : ($this->VideoGroupModel->getOrderMaxPlus());

            /*
            * --- check group video video_iframe
            */

            if(empty($_POST['video_iframe'])) {
                $error['video_iframe'] = "<span class='error'>(*) Vui lòng nhập video từ youtube</span>";
            } else {
                $video_iframe = $_POST['video_iframe'];
            }

            /*
            * --- check group video product id ties 1
            */

            if(empty($_POST['video_prodId_ties_1']['id'])) {
                $error['video_prodId_ties_1'] = "<span class='error'>(*) Vui lòng chọn sản phẩm 1</span>";
            } else {
                $video_prodId_ties_1 = $_POST['video_prodId_ties_1']['id'];
            }


            /*
            * --- check group video product id ties 2
            */

            if(empty($_POST['video_prodId_ties_2']['id'])) {
                $error['video_prodId_ties_2'] = "<span class='error'>(*) Vui lòng chọn sản phẩm 2</span>";
            } else {
                $video_prodId_ties_2 = $_POST['video_prodId_ties_2']['id'];
            }

            /*
            * --- check group video product id ties 3
            */

            if(empty($_POST['video_prodId_ties_3']['id'])) {
                $error['video_prodId_ties_3'] = "<span class='error'>(*) Vui lòng chọn sản phẩm 3</span>";
            } else {
                $video_prodId_ties_3 = $_POST['video_prodId_ties_3']['id'];
            }

            /*
            * --- check group video product id ties 4
            */

            if(empty($_POST['video_prodId_ties_4']['id'])) {
                $error['video_prodId_ties_4'] = "<span class='error'>(*) Vui lòng chọn sản phẩm 4</span>";
            } else {
                $video_prodId_ties_4 = $_POST['video_prodId_ties_4']['id'];
            }

            /*
            * --- check group video error
            */

            if(empty($error)) {
                if(!($this->VideoGroupModel->checkVideoGroupExists($videoGroup_name, $videoGroup_startDate, $videoGroup_endDate))) {
                    if((int) $videoGroup_startDate >= (int) $videoGroup_endDate ) {
                        $statusActionVideoGroup = [
                            "status"    => "error",
                            "notifiTxt" => "Thời gian thực hiện không hợp lệ [ Ngày kết thúc phải lớn hơn ngày bắt đầu ]"
                        ];
                    } else {
                        $dataVideoGroup = [
                            "videoGroup_name"       => $videoGroup_name,
                            "videoGroup_status"     => $videoGroup_status,
                            "videoGroup_order"      => $videoGroup_order,
                            "videoGroup_startDate"  => $videoGroup_startDate,
                            "videoGroup_endDate"    => $videoGroup_endDate,
                            "videoGroup_createDate" => time(),
                            "videoGroup_creatorId"  => $helper->infoUser("user_id"),
                        ];

                        $idVideoGroup = $this->VideoGroupModel->addVideoGroupNew($dataVideoGroup);

                        if(is_int($idVideoGroup)) {
                            $dataVideo = [
                                "video_iframe"            => $video_iframe,
                                "video_prodId_ties_1"     => $video_prodId_ties_1,
                                "video_prodId_ties_2"     => $video_prodId_ties_2,
                                "video_prodId_ties_3"     => $video_prodId_ties_3,
                                "video_prodId_ties_4"     => $video_prodId_ties_4,
                                "video_videoGroupId_ties" => $idVideoGroup
                            ];

                            $this->VideoGroupModel->addVideoNew($dataVideo);

                            $statusActionVideoGroup = [
                                "status"    => "success",
                                "notifiTxt" => "Thêm video group thành công"
                            ];
                        } else {
                            $statusActionVideoGroup = [
                                "status"    => "error",
                                "notifiTxt" => "Thêm video group không thành công"
                            ];
                        }
                    }

                } else {
                    $statusActionVideoGroup = [
                        "status"    => "error",
                        "notifiTxt" => "Nhóm video này đã tồn tại trong hệ thống [ Trùng tên, ngày bắt đầu, ngày kết thúc ]"
                    ];
                }
            } else {
                $statusActionVideoGroup = [
                    "status"    => "error",
                    "notifiTxt" => "Một số thông tin bạn chưa hoàn thành hoặc không đúng kiểu dữ liệu"
                ];
            }

        }

        $dataView = [
            "title"  => "Video trang chủ",
            "layOut" => "AddVideoGroup",
            "css"    => ["home"],
            "data"   => [
                "statusActionVideoGroup" => !empty($statusActionVideoGroup) ? $statusActionVideoGroup : null
            ]
        ];
        $this->view("MasterIndex", $dataView);
    }

    public function update($videoGroup_id = 0)
    {
        $videoGroup_id  = (!empty($videoGroup_id)) ? (int) $videoGroup_id : 0;
        $videoGroupItem = $this->VideoGroupModel->getVideoGroupItemById($videoGroup_id);

        /*
        * -------------------------------------
        * ----- Handle update video group -----
        * -------------------------------------
        */

        if(isset($_POST['updateVideoGroup_action'])) {
            $error = [];
            global $error;

            /*
            * --- check group video status
            */

            $videoGroup_status = !empty($_POST['videoGroup_status']) ? "on" : "off";
            $_POST['videoGroup_status'] = $videoGroup_status;

            /*
            * --- check group video name
            */

            if(empty($_POST['videoGroup_name'])) {
                $error['videoGroup_name'] = "<span class='error'>(*) Vui lòng tên nhóm video</span>";
            } else {
                $videoGroup_name = $_POST['videoGroup_name'];
            }

            /*
            * --- check group video start date
            */

            if(empty($_POST['videoGroup_startDate'])) {
                $error['videoGroup_startDate'] = "<span class='error'>(*) Vui lòng nhập ngày bắt đầu</span>";
            } else {
                $videoGroup_startDate = strtotime($_POST['videoGroup_startDate']);
            }

            /*
            * --- check group video end date
            */

            if(empty($_POST['videoGroup_endDate'])) {
                $error['videoGroup_endDate'] = "<span class='error'>(*) Vui lòng nhập ngày kết thúc</span>";
            } else {
                $videoGroup_endDate = strtotime($_POST['videoGroup_endDate']);
            }

            /*
            * --- check group video order
            */

            $videoGroup_order = !empty($_POST['videoGroup_order']) ? (int) $_POST['videoGroup_order'] : ($this->VideoGroupModel->getOrderMaxPlus());

            /*
            * --- check group video video_iframe
            */

            if(empty($_POST['video_iframe'])) {
                $error['video_iframe'] = "<span class='error'>(*) Vui lòng nhập video từ youtube</span>";
            } else {
                $video_iframe = $_POST['video_iframe'];
            }

            /*
            * --- check group video product id ties 1
            */

            if(empty($_POST['video_prodId_ties_1']['id'])) {
                $error['video_prodId_ties_1'] = "<span class='error'>(*) Vui lòng chọn sản phẩm 1</span>";
            } else {
                $video_prodId_ties_1 = $_POST['video_prodId_ties_1']['id'];
            }


            /*
            * --- check group video product id ties 2
            */

            if(empty($_POST['video_prodId_ties_2']['id'])) {
                $error['video_prodId_ties_2'] = "<span class='error'>(*) Vui lòng chọn sản phẩm 2</span>";
            } else {
                $video_prodId_ties_2 = $_POST['video_prodId_ties_2']['id'];
            }

            /*
            * --- check group video product id ties 3
            */

            if(empty($_POST['video_prodId_ties_3']['id'])) {
                $error['video_prodId_ties_3'] = "<span class='error'>(*) Vui lòng chọn sản phẩm 3</span>";
            } else {
                $video_prodId_ties_3 = $_POST['video_prodId_ties_3']['id'];
            }

            /*
            * --- check group video product id ties 4
            */

            if(empty($_POST['video_prodId_ties_4']['id'])) {
                $error['video_prodId_ties_4'] = "<span class='error'>(*) Vui lòng chọn sản phẩm 4</span>";
            } else {
                $video_prodId_ties_4 = $_POST['video_prodId_ties_4']['id'];
            }

            /*
            * --- check group video error
            */

            if(empty($error)) {
                if(((int) $videoGroup_startDate >= (int) $videoGroup_endDate)) {
                    $statusActionVideoGroup = [
                        "status"    => "error",
                        "notifiTxt" => "Thời gian thực hiện không hợp lệ [ Ngày kết thúc phải lớn hơn ngày bắt đầu ]"
                    ];
                } else {
                    $dataVideoGroup = [
                        "videoGroup_name"       => $videoGroup_name,
                        "videoGroup_status"     => $videoGroup_status,
                        "videoGroup_order"      => $videoGroup_order,
                        "videoGroup_startDate"  => $videoGroup_startDate,
                        "videoGroup_endDate"    => $videoGroup_endDate,
                        "videoGroup_updateDate" => time(),
                    ];
                    $process = $this->VideoGroupModel->updateVideoGroup($dataVideoGroup, $videoGroup_id);
                    if($process) {
                        $this->VideoGroupModel->deleteTotalVideoByIdVideoGroup($videoGroup_id);
                        $dataVideo = [
                            "video_iframe"            => $video_iframe,
                            "video_prodId_ties_1"     => $video_prodId_ties_1,
                            "video_prodId_ties_2"     => $video_prodId_ties_2,
                            "video_prodId_ties_3"     => $video_prodId_ties_3,
                            "video_prodId_ties_4"     => $video_prodId_ties_4,
                            "video_videoGroupId_ties" => $videoGroup_id
                        ];
                        $this->VideoGroupModel->addVideoNew($dataVideo);
                        $statusActionVideoGroup = [
                            "status"    => "success",
                            "notifiTxt" => "Cập nhật nhóm video thành công"
                        ];
                    } else {
                        $statusActionVideoGroup = [
                            "status"    => "error",
                            "notifiTxt" => "Cập nhật nhóm video không thành công"
                        ];
                    }
                }
            } else {
                $statusActionVideoGroup = [
                    "status"    => "error",
                    "notifiTxt" => "Một số thông tin bạn chưa hoàn thành hoặc không đúng kiểu dữ liệu"
                ];
            }

        }

        $videoInfo  = $this->VideoGroupModel->getVideoInfoByIdVideoGroup($videoGroup_id);
        $videoGroupItem['video_iframe'] = $videoInfo['video_iframe'];
        $videoGroupItem['video_prod_1'] = $this->ProductModel->getProdItemById((int)$videoInfo['video_prodId_ties_1']);
        $videoGroupItem['video_prod_2'] = $this->ProductModel->getProdItemById((int)$videoInfo['video_prodId_ties_2']);
        $videoGroupItem['video_prod_3'] = $this->ProductModel->getProdItemById((int)$videoInfo['video_prodId_ties_3']);
        $videoGroupItem['video_prod_4'] = $this->ProductModel->getProdItemById((int)$videoInfo['video_prodId_ties_4']);
        $dataView = [
            "title"  => "Cập nhật nhóm video",
            "layOut" => "UpdateVideoGroup",
            "css"    => ["home"],
            "data"   => [
                "videoGroupItem"         => !empty($videoGroupItem) ? $videoGroupItem : null,
                "statusActionVideoGroup" => !empty($statusActionVideoGroup) ? $statusActionVideoGroup : null
            ]
        ];
        $this->view("MasterIndex", $dataView);

    }

    public function updateVideoGroupOrder()
    {
        $videoGrouppOrderChange = (int) $_POST['videoGrouppOrderChange'];
        $videoGroupID           = (int) $_POST['videoGroupID'];
        $dataDisplay = [
            "videoGroup_order" => $videoGrouppOrderChange
        ];
        $process = $this->VideoGroupModel->updateVideoGroup($dataDisplay, $videoGroupID);
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

    public function changeStatus()
    {
        $videoGroup_id  = (int)$_POST['videoGroup_id'];
        $statusChange = Format::validation($_POST['statusChange']);
        $dataVideoGroup = [
            "videoGroup_status" => $statusChange
        ];
        $process = $this->VideoGroupModel->updateVideoGroup($dataVideoGroup, $videoGroup_id);
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
        $videoGroup_id = $_POST['videoGroup_id'];
        $process = $this->VideoGroupModel->deleteVideoGroup($videoGroup_id);
        if($process) {
            $this->VideoGroupModel->deleteTotalVideoByIdVideoGroup($videoGroup_id);
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
        $listVideoGroupId = $_POST['listVideoGroupId'];
        $videoGroupIdDeleteError   = [];
        foreach($listVideoGroupId as $videoGroupIdItem) {
            $videoGroup_id = (int) $videoGroupIdItem;
            $process    = $this->VideoGroupModel->deleteVideoGroup($videoGroup_id);
            if(!$process) {
                $this->VideoGroupModel->deleteTotalVideoByIdVideoGroup($videoGroup_id);
                $videoGroupIdDeleteError[] = $videoGroupIdItem;
            }
        }
        if(!empty($videoGroupIdDeleteError)) {
            $dataAjax = [
                "status"            => "error",
                "listIdCantDeleted" => $videoGroupIdDeleteError
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
        $listVideoGroupId   = $_POST['listVideoGroupId'];
        $statusChange = $_POST['statusChange'];
        $videoGroupIdUpdateError = [];
        foreach($listVideoGroupId as $videoGroupIdItem) {
            $videoGroup_id   = (int) $videoGroupIdItem;
            $dataVideoGroup = [
                "videoGroup_status" => $statusChange
            ];
            $process = $this->VideoGroupModel->updateVideoGroup($dataVideoGroup, $videoGroup_id);
            if(!$process) {
                $videoGroupIdUpdateError[] = $videoGroupIdItem;
            }
        }
        if(!empty($videoGroupIdUpdateError)) {
            $dataAjax = [
                "status"            => "error",
                "videoGroupIdUpdateError" => $videoGroupIdUpdateError
            ];
        } else {
            $dataAjax = [
                "status" => "success"
            ];
        }
        echo json_encode($dataAjax);
    }

    public function getAllVideoGroup()
    {
        $dataAjax = [
            "listVideoGroup" => $this->VideoGroupModel->getListVideoGroupByStatus("all")
        ];
        echo json_encode($dataAjax);
    }

    public function recommentSearch()
    {
        $vlSearch = $_POST['vlSearch'];
        $result   = $this->VideoGroupModel->searchVideoGroupByName($vlSearch);
        $dataAjax = [
            "searchData" => $result
        ];
        echo json_encode($dataAjax);
    }
}
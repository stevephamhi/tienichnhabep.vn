<?php

class CateNewsController extends Controller
{
    public $CateNewsModel;

    function __construct()
    {
        $this->CateNewsModel = $this->model('CateNews');
    }

    public function index($orderBy = 'desc', $status = 'all', $page = 1, $strSearch = '')
    {
        if(!empty($strSearch)) {
            $strSearch = Format::validationSearch($strSearch);
            $listCateNews = $this->CateNewsModel->searchCateNewsByName($strSearch);
        } else {
            $orderByAllow  = ["asc","desc"];
            $statusAllow   = ["all","on","off"];
            $orderBy       = in_array($orderBy,$orderByAllow) ? $orderBy : "asc";
            $status        = in_array($status,$statusAllow)   ? $status  : "all";
            $page          = $page >= 1 ? $page : 1;
            $numPerPage    = 10;
            $totalCateNews = count($this->CateNewsModel->getListCateNewsByStatus($status));
            $totalPage     = ceil($totalCateNews / $numPerPage);
            $pageStart     = ($page - 1) * $numPerPage;
            $listCateNews  = $this->CateNewsModel->getCateNewsByPagination($orderBy, $status, $pageStart, $numPerPage);
        }
        $dataView = [
            "title"  => "Danh sách danh mục tin tức",
            "layOut" => "ListCateNews",
            "css"    => ["home"],
            "data"   => [
                "orderBy"       => !empty($orderBy) ? $orderBy : null,
                "status"        => !empty($status) ? $status : null,
                "page"          => !empty($page) ? $page : null,
                "numPerPage"    => !empty($numPerPage) ? $numPerPage : null,
                "totalPage"     => !empty($totalPage) ? $totalPage : null,
                "strSearch"     => !empty($strSearch) ? $strSearch : null,
                "listCateNews"  => !empty($listCateNews) ? $listCateNews : null,
                "totalCateNews" => !empty($totalCateNews) ? $totalCateNews : count($listCateNews),
            ]
        ];
        $this->view("MasterIndex", $dataView);
    }

    public function add()
    {
        $helper = new Helper;
        if(isset($_POST['addCateNews_action'])) {
            $error = [];
            global $error;

            /*
            * --- check cateNews status
            */

            $cateNews_status = !empty($_POST['cateNews_status']) ? 'on' : 'off';

            /*
            * --- check cateNews name
            */

            if(empty($_POST['cateNews_name'])) {
                $error['cateNews_name'] = "<span class='error'>(*) Vui lòng nhập tên danh mục</span>";
            } else {
                $cateNews_name = Format::validation($_POST['cateNews_name']);
            }


            /*
            * --- check cateNews desc
            */

            $cateNews_desc = !empty($_POST['cateNews_desc']) ? $_POST['cateNews_desc'] : '';

            /*
            * --- check cateNews meta title
            */

            if(empty($_POST['cateNews_metaTitle'])) {
                $error['cateNews_metaTitle'] = "<span class='error'>(*) Vui lòng nhập thẻ tiêu đề (Meta title)</span>";
            } else {
                $cateNews_metaTitle =  Format::validation($_POST['cateNews_metaTitle']);
            }

            /*
            * --- check cateNews meta desc
            */

            if(empty($_POST['cateNews_metaDesc'])) {
                $error['cateNews_metaDesc'] = "<span class='error'>(*) Vui lòng nhập thẻ mô tả (Meta desc)</span>";
            } else {
                $cateNews_metaDesc = Format::validation($_POST['cateNews_metaDesc']);
            }

            /*
            * --- check cateNews seo url
            */

            if(empty($_POST['cateNews_seoUrl'])) {
                $error['cateNews_seoUrl'] = "<span class='error'>(*) Vui lòng nhập đường dẫn SEO</span>";
            } else {
                $cateNews_seoUrl = Format::create_slug(Format::validation($_POST['cateNews_seoUrl']));
            }

            /*
            * --- check cateNews parent ID
            */

            $cateNews_parentId = !empty($_POST['cateNews_parentId']) ? (int) $_POST['cateNews_parentId'] : 0;

            /*
            * --- check cateNews banner PC
            */

            $cateNews_bannerPc = !empty($_POST['cateNews_bannerPc']) ? $_POST['cateNews_bannerPc'] : null;

            /*
            * --- check cateNews banner mobile
            */

            $cateNews_bannerMb = !empty($_POST['cateNews_bannerMb']) ? $_POST['cateNews_bannerMb'] : null;

            /*
            * --- check cateNews order
            */

            $cateNews_order = !empty($_POST['cateNews_order']) ? (int)$_POST['cateNews_order'] : ($this->CateNewsModel->getOrderMaxPlus());
            $_POST['cateNews_order'] = $cateNews_order;

            /*
            * --- check cateNews error
            */

            if(empty($error)) {
                if(!($this->CateNewsModel->checkCateNewsExist($cateNews_name, $cateNews_parentId))) {
                    $cateNews_createDate = time();
                    $cateNews_creatorId  = (int)$helper->infoUser("user_id");
                    $dataCateNews = [
                        "cateNews_name"       => $cateNews_name,
                        "cateNews_bannerPc"   => $cateNews_bannerPc,
                        "cateNews_bannerMb"   => $cateNews_bannerMb,
                        "cateNews_desc"       => $cateNews_desc,
                        "cateNews_order"      => $cateNews_order,
                        "cateNews_metaTitle"  => $cateNews_metaTitle,
                        "cateNews_metaDesc"   => $cateNews_metaDesc,
                        "cateNews_seoUrl"     => $cateNews_seoUrl,
                        "cateNews_parentId"   => $cateNews_parentId,
                        "cateNews_createDate" => $cateNews_createDate,
                        "cateNews_status"     => $cateNews_status,
                        "cateNews_creatorId"  => $cateNews_creatorId,
                    ];
                    $idCateNews = $this->CateNewsModel->addCateNewsNew($dataCateNews);
                    if(is_int($idCateNews)) {
                        $statusActionCateNews = [
                            "status"    => "success",
                            "notifiTxt" => "Thêm danh mục tin tức thành công"
                        ];
                    } else {
                        $statusActionCateNews = [
                            "status"    => "error",
                            "notifiTxt" => "Thêm danh mục tin tức không thành công"
                        ];
                    }
                } else {
                    $statusActionCateNews = [
                        "status"    => "error",
                        "notifiTxt" => "Danh mục tin tức đã tồn tại [ ERROR: Trùng tên và danh mục cha ]"
                    ];
                }
            } else {
                $statusActionCateNews = [
                    "status"    => "error",
                    "notifiTxt" => "Một số thông tin bạn chưa hoàn thành hoặc không đúng kiểu dữ liệu"
                ];
            }
        }
        $dataView = [
            "title"  => "Thêm danh mục tin tức",
            "layOut" => "AddCateNews",
            "css"    => ["home","fancybox.min"],
            "data"   => [
                "listCateNews"         => $this->CateNewsModel->getMultiLevelCateNews($this->CateNewsModel->getListTotalCateNews()),
                "statusActionCateNews" => !empty($statusActionCateNews) ? $statusActionCateNews : []
            ]
        ];
        $this->view("MasterIndex", $dataView);
    }

    public function changeStatus()
    {
        $cateNews_id  = (int)$_POST['cateNews_id'];
        $statusChange = Format::validation($_POST['statusChange']);
        $dataCateNews = [
            "cateNews_status" => $statusChange
        ];
        $process = $this->CateNewsModel->updateCateNews($dataCateNews, $cateNews_id);
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
        $cateNews_id = $_POST['cateNews_id'];
        $process = $this->CateNewsModel->deleteCateNews($cateNews_id);
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
        $listCateNewsId = $_POST['listCateNewsId'];
        $cateNewsIdDeleteError   = [];
        foreach($listCateNewsId as $cateNewsIdItem) {
            $idCateNews = (int) $cateNewsIdItem;
            $process    = $this->CateNewsModel->deleteCateNews($idCateNews);
            if(!$process) {
                $cateNewsIdDeleteError[] = $cateNewsIdItem;
            }
        }
        if(!empty($cateNewsIdDeleteError)) {
            $dataAjax = [
                "status"            => "error",
                "listIdCantDeleted" => $cateNewsIdDeleteError
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
        $listCateNewsId        = $_POST['listCateNewsId'];
        $statusChange          = $_POST['statusChange'];
        $cateNewsIdUpdateError = [];
        foreach($listCateNewsId as $cateNewsIdItem) {
            $idCateNews   = (int) $cateNewsIdItem;
            $dataCateNews = [
                "cateNews_status" => $statusChange
            ];
            $process = $this->CateNewsModel->updateCateNews($dataCateNews, $idCateNews);
            if(!$process) {
                $cateNewsIdUpdateError[] = $cateNewsIdItem;
            }
        }
        if(!empty($cateNewsIdUpdateError)) {
            $dataAjax = [
                "status"                => "error",
                "cateNewsIdUpdateError" => $cateNewsIdUpdateError
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
        $vlSearch = $_POST['vlSearch'];
        $result   = $this->CateNewsModel->searchCateNewsByName($vlSearch);
        $dataAjax = [
            "searchData" => $result
        ];
        echo json_encode($dataAjax);
    }

    public function update($cateNews_id = 0)
    {
        $cateNews_id  = (!empty($cateNews_id)) ? (int)$cateNews_id : 0;
        $cateNewsItem = $this->CateNewsModel->getCateNewsById($cateNews_id);

        /*
        * -----------------------------------
        * ----- Handle update cate news -----
        * -----------------------------------
        */

        if(isset($_POST['updateCateNews_action'])) {
            $error = [];
            global $error;

            /*
            * --- check cateNews status
            */

            $_POST['cateNews_status'] = !empty($_POST['cateNews_status']) ? "on" : "off";
            $cateNews_status = $_POST['cateNews_status'];

            /*
            * --- check cateNews name
            */

            if(empty($_POST['cateNews_name'])) {
                $error['cateNews_name'] = "<span class='error'>(*) Vui lòng nhập tên danh mục</span>";
            } else {
                $cateNews_name = Format::validation($_POST['cateNews_name']);
            }

            /*
            * --- check cateNews desc
            */

            $cateNews_desc = !empty($_POST['cateNews_desc']) ? $_POST['cateNews_desc'] : '';

            /*
            * --- check cateNews meta title
            */

            if(empty($_POST['cateNews_metaTitle'])) {
                $error['cateNews_metaTitle'] = "<span class='error'>(*) Vui lòng nhập thẻ tiêu đề (Meta desc)</span>";
            } else {
                $cateNews_metaTitle =  Format::validation($_POST['cateNews_metaTitle']);
            }

            /*
            * --- check cateNews meta desc
            */

            if(empty($_POST['cateNews_metaDesc'])) {
                $error['cateNews_metaDesc'] = "<span class='error'>(*) Vui lòng nhập thẻ mô tả (Meta desc)</span>";
            } else {
                $cateNews_metaDesc = Format::validation($_POST['cateNews_metaDesc']);
            }

            /*
            * --- check cateNews seo url
            */

            if(empty($_POST['cateNews_seoUrl'])) {
                $error['cateNews_seoUrl'] = "<span class='error'>(*) Vui lòng nhập đường dẫn SEO</span>";
            } else {
                $cateNews_seoUrl = Format::create_slug(Format::validation($_POST['cateNews_seoUrl']));
            }

            /*
            * --- check cateNews parent ID
            */

            $cateNews_parentId = !empty($_POST['cateNews_parentId']) ? (int) $_POST['cateNews_parentId'] : 0;

            /*
            * --- check cateNews banner PC
            */

            $cateNews_bannerPc = !empty($_POST['cateNews_bannerPc']) ? $_POST['cateNews_bannerPc'] : "";

            /*
            * --- check cateNews banner mobile
            */

            $cateNews_bannerMb = !empty($_POST['cateNews_bannerMb']) ? $_POST['cateNews_bannerMb'] : "";

            /*
            * --- check cateNews order
            */

            $cateNews_order = !empty($_POST['cateNews_order']) ? (int)$_POST['cateNews_order'] : ($this->CateNewsModel->getOrderMaxPlus());

            /*
            * --- check cateNews error
            */

            if(empty($error)) {
                $cateNews_updateDate = time();
                $dataCateNews = [
                    "cateNews_name"       => $cateNews_name,
                    "cateNews_bannerPc"   => $cateNews_bannerPc,
                    "cateNews_bannerMb"   => $cateNews_bannerMb,
                    "cateNews_desc"       => $cateNews_desc,
                    "cateNews_order"      => $cateNews_order,
                    "cateNews_metaTitle"  => $cateNews_metaTitle,
                    "cateNews_metaDesc"   => $cateNews_metaDesc,
                    "cateNews_seoUrl"     => $cateNews_seoUrl,
                    "cateNews_parentId"   => $cateNews_parentId,
                    "cateNews_updateDate" => $cateNews_updateDate,
                    "cateNews_status"     => $cateNews_status,
                ];
                $process = $this->CateNewsModel->updateCateNews($dataCateNews, $cateNews_id);
                if($process) {
                    $statusActionCateNews = [
                        "status"    => "success",
                        "notifiTxt" => "Cập nhật danh mục tin tức thành công"
                    ];
                } else {
                    $statusActionCateNews = [
                        "status"    => "error",
                        "notifiTxt" => "Cập nhật danh mục tin tức không thành công"
                    ];
                }
            } else {
                $statusActionCateNews = [
                    "status"    => "error",
                    "notifiTxt" => "Một số thông tin bạn chưa hoàn thành hoặc không đúng kiểu dữ liệu"
                ];
            }
        }

        $dataView = [
            "title"  => "Cập nhật danh mục tin tức",
            "layOut" => "UpdateCateNews",
            "css"    => ["home","fancybox.min"],
            "data"   => [
                "listCateNews"         => $this->CateNewsModel->getMultiLevelCateNews($this->CateNewsModel->getListTotalCateNews()),
                "statusActionCateNews" => !empty($statusActionCateNews) ? $statusActionCateNews : [],
                "cateNewsItem"         => $cateNewsItem
            ]
        ];

        $this->view("MasterIndex", $dataView);
    }
}
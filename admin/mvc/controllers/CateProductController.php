<?php

class CateProductController extends Controller
{
    protected $CateProductModel;
    protected $ProductModel;

    function __construct()
    {
        $this->CateProductModel = $this->model('CateProduct');
        $this->ProductModel     = $this->model("Product");
    }

    public function index($orderBy = 'desc', $status = 'all', $page = 1, $strSearch = '')
    {
        if(!empty($strSearch)) {
            $strSearch = Format::validationSearch($strSearch);
            $listCateProducts = $this->CateProductModel->searchCateProdByName($strSearch);
        } else {
            $orderByAllow     = ["asc","desc"];
            $statusAllow      = ["all","on","off"];
            $orderBy          = in_array($orderBy,$orderByAllow) ? $orderBy : "asc";
            $status           = in_array($status,$statusAllow)   ? $status  : "all";
            $page             = $page >= 1 ? $page : 1;
            $numPerPage       = 10;
            $totalCateProd    = count($this->CateProductModel->getListCateProdByStatus($status));
            $totalPage        = ceil($totalCateProd / $numPerPage);
            $pageStart        = ($page - 1) * $numPerPage;
            $listCateProducts = $this->CateProductModel->getCateProdByPagination($orderBy, "cateProd_name", $status, $pageStart, $numPerPage);
        }

        $dataView = [
            "title"  => "Danh mục sản phẩm",
            "layOut" => "ListCateProducts",
            "css"    => ["home"],
            "data"   => [
                "orderBy"          => !empty($orderBy) ? $orderBy : null,
                "status"           => !empty($status) ? $status : null,
                "page"             => !empty($page) ? $page : null,
                "numPerPage"       => !empty($numPerPage) ? $numPerPage : null,
                "totalPage"        => !empty($totalPage) ? $totalPage : null,
                "strSearch"        => !empty($strSearch) ? $strSearch : null,
                "listCateProducts" => !empty($listCateProducts) ? $listCateProducts : null,
                "totalCateProd"    => !empty($totalCateProd) ? $totalCateProd : count($listCateProducts),
            ]
        ];
        $this->view("MasterIndex", $dataView);
    }

    public function analysis($orderBy = 'desc', $status = 'all', $page = 1, $strSearch = '')
    {
        if(!empty($strSearch)) {
            $listCateProducts = $this->CateProductModel->searchCateProdByName($strSearch);
        } else {
            $orderByAllow     = ["asc","desc"];
            $statusAllow      = ["all","on","off"];
            $orderBy          = in_array($orderBy,$orderByAllow) ? $orderBy : "asc";
            $status           = in_array($status,$statusAllow)   ? $status  : "all";
            $page             = $page >= 1 ? $page : 1;
            $numPerPage       = 10;
            $totalCateProd    = count($this->CateProductModel->getListCateProdByStatus($status));
            $totalPage        = ceil($totalCateProd / $numPerPage);
            $pageStart        = ($page - 1) * $numPerPage;
            $listCateProducts = $this->CateProductModel->getCateProdByPagination($orderBy,"cateProd_views", $status, $pageStart, $numPerPage);
        }

        $listTotalProd = $this->ProductModel->getListProdByStatus("all");

        foreach($listCateProducts as &$cateProdItem) {
            $cateProdItem['cateProd_numTotalProd_ties'] = $this->getNumTotalProdByCateProdId($listTotalProd, $cateProdItem['cateProd_id']);
        }

        $dataView = [
            "title"  => "Phân tích danh mục",
            "layOut" => "CateProdAnalysis",
            "css"    => ["home"],
            "data"   => [
                "orderBy"          => !empty($orderBy) ? $orderBy : null,
                "status"           => !empty($status) ? $status : null,
                "page"             => !empty($page) ? $page : null,
                "numPerPage"       => !empty($numPerPage) ? $numPerPage : null,
                "totalPage"        => !empty($totalPage) ? $totalPage : null,
                "strSearch"        => !empty($strSearch) ? $strSearch : null,
                "listCateProducts" => !empty($listCateProducts) ? $listCateProducts : null,
                "totalCateProd"    => !empty($totalCateProd) ? $totalCateProd : count($listCateProducts),
            ]
        ];
        $this->view("MasterIndex", $dataView);
    }

    public function getNumTotalProdByCateProdId($listTotalProd, $cateProd_id)
    {
        $result = 0;
        foreach($listTotalProd as $prodItem) {
            if( in_array($cateProd_id, json_decode($prodItem['prod_listId_cateProd_ties'])) ) {
                $result ++;
            }
        }
        return $result;
    }

    public function getListTotalCateProd()
    {
        $dataAjax = [
            "dataRecomment" => $this->CateProductModel->getListCateProdByStatus("all")
        ];
        echo json_encode($dataAjax);
    }

    public function changeNumViews()
    {
        $numViewsNew = (int) $_POST['numViewsNew'];
        $cateProd_id = (int) $_POST['cateProd_id'];
        $dataCateProd = [
            "cateProd_views" => $numViewsNew
        ];
        $process = $this->CateProductModel->updateCateProd($dataCateProd, $cateProd_id);
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

    public function changeCateProdHot()
    {
        $cateProd_id = (int) $_POST['cateProd_id'];
        $checkValue  = (int) $_POST['checkValue'];
        $dataCateProd = [
            "cateProd_hot" => $checkValue
        ];
        $process = $this->CateProductModel->updateCateProd($dataCateProd, $cateProd_id);
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

    public function add()
    {
        $helper = new Helper;
        if(isset($_POST['addCateProd_action'])) {
            $error = [];
            global $error;

            /*
            * --- check cateprod status
            */

            $cateProd_status = !empty($_POST['cateProd_status']) ? "on" : "off";

            /*
            * --- check cateprod name
            */

            if(empty($_POST['cateProd_name'])) {
                $error['cateProd_name'] = "<span class='error'>(*) Vui lòng nhập tên danh mục</span>";
            } else {
                $cateProd_name = Format::validation($_POST['cateProd_name']);
            }

            /*
            * --- check cateprod desc
            */

            $cateProd_desc = !empty($_POST['cateProd_desc']) ? $_POST['cateProd_desc'] : '';

            /*
            * --- check cateprod meta title
            */

            if(empty($_POST['cateProd_keyword'])) {
                $error['cateProd_keyword'] = "<span class='error'>(*) Vui lòng nhập từ khóa cho danh mục</span>";
            } else {
                $cateProd_keyword =  Format::validation($_POST['cateProd_keyword']);
            }

            /*
            * --- check cateprod meta title
            */

            if(empty($_POST['cateProd_metaTitle'])) {
                $error['cateProd_metaTitle'] = "<span class='error'>(*) Vui lòng nhập thẻ tiêu đề (Meta desc)</span>";
            } else {
                $cateProd_metaTitle =  Format::validation($_POST['cateProd_metaTitle']);
            }

            /*
            * --- check cateprod meta desc
            */

            if(empty($_POST['cateProd_metaDesc'])) {
                $error['cateProd_metaDesc'] = "<span class='error'>(*) Vui lòng nhập thẻ mô tả (Meta desc)</span>";
            } else {
                $cateProd_metaDesc = Format::validation($_POST['cateProd_metaDesc']);
            }

            /*
            * --- check cateprod seo url
            */

            if(empty($_POST['cateProd_seoUrl'])) {
                $error['cateProd_seoUrl'] = "<span class='error'>(*) Vui lòng nhập đường dẫn SEO</span>";
            } else {
                $cateProd_seoUrl = Format::create_slug(Format::validation($_POST['cateProd_seoUrl']));
            }

            /*
            * --- check cateprod parent ID
            */

            $cateProd_parentId = !empty($_POST['cateProd_parentId']) ? (int) $_POST['cateProd_parentId'] : 0;

            /*
            * --- check cateprod image
            */

            if(empty($_POST['cateProd_image'])) {
                $error['cateProd_image'] = "<span class='error'>(*) Vui lòng chọn mini icon</span>";
            } else {
                $cateProd_image = $_POST['cateProd_image'];
            }

            /*
            * --- check cateprod banner PC
            */

            if(empty($_POST['cateProd_bannerPc'])) {
                $error['cateProd_bannerPc'] = "<span class='error'>(*) Vui lòng chọn banner cho PC</span>";
            } else {
                $cateProd_bannerPc = $_POST['cateProd_bannerPc'];
            }

            /*
            * --- check cateprod banner mobile
            */

            if(empty($_POST['cateProd_bannerMb'])) {
                $error['cateProd_bannerMb'] = "<span class='error'>(*) Vui lòng chọn banner cho mobile</span>";
            } else {
                $cateProd_bannerMb = $_POST['cateProd_bannerMb'];
            }

            /*
            * --- check cateprod order
            */

            $cateProd_order = !empty($_POST['cateProd_order']) ? (int)$_POST['cateProd_order'] : ($this->CateProductModel->getOrderMaxPlus());
            $_POST['cateProd_order'] = $cateProd_order;

            /*
            * --- check cateprod error
            */

            if(empty($error)) {
                if(!($this->CateProductModel->checkCateProdExist($cateProd_name, $cateProd_parentId))) {
                    $cateProd_createDate = time();
                    $cateProd_creatorId  = (int)$helper->infoUser("user_id");
                    $dataCateProd = [
                        "cateProd_name"       => $cateProd_name,
                        "cateProd_image"      => $cateProd_image,
                        "cateProd_bannerPc"   => $cateProd_bannerPc,
                        "cateProd_bannerMb"   => $cateProd_bannerMb,
                        "cateProd_desc"       => $cateProd_desc,
                        "cateProd_order"      => $cateProd_order,
                        "cateProd_keyword"    => $cateProd_keyword,
                        "cateProd_metaTitle"  => $cateProd_metaTitle,
                        "cateProd_metaDesc"   => $cateProd_metaDesc,
                        "cateProd_seoUrl"     => $cateProd_seoUrl,
                        "cateProd_parentId"   => $cateProd_parentId,
                        "cateProd_createDate" => $cateProd_createDate,
                        "cateProd_status"     => $cateProd_status,
                        "cateProd_creatorId"  => $cateProd_creatorId,
                    ];
                    $idCateProd = $this->CateProductModel->addCateNew($dataCateProd);
                    if(is_int($idCateProd)) {
                        $statusActionCateProd = [
                            "status"    => "success",
                            "notifiTxt" => "Thêm danh mục sản phẩm thành công"
                        ];
                    } else {
                        $statusActionCateProd = [
                            "status"    => "error",
                            "notifiTxt" => "Thêm danh mục sản phẩm không thành công"
                        ];
                    }
                } else {
                    $statusActionCateProd = [
                        "status"    => "error",
                        "notifiTxt" => "Danh mục sản phẩm đã tồn tại [ ERROR: Trùng tên và danh mục cha ]"
                    ];
                }
            } else {
                $statusActionCateProd = [
                    "status"    => "error",
                    "notifiTxt" => "Một số thông tin bạn chưa hoàn thành hoặc không đúng kiểu dữ liệu"
                ];
            }
        }
        $dataView = [
            "title"  => "Thêm danh mục sản phẩm",
            "layOut" => "AddCateProducts",
            "css"    => ["home","fancybox.min"],
            "data"   => [
                "listCateProd"         => $this->CateProductModel->getMultiLevelCateProd($this->CateProductModel->getListTotalCateProd()),
                "statusActionCateProd" => !empty($statusActionCateProd) ? $statusActionCateProd : []
            ]
        ];
        $this->view("MasterIndex", $dataView);
    }

    public function update($cateProd_id = 0)
    {
        $cateProd_id = (!empty($cateProd_id)) ? (int)$cateProd_id : 0;
        $cateProdItem = $this->CateProductModel->getCateProdItemById($cateProd_id);

        /*
        * --------------------------------------
        * ----- Handle update cate product -----
        * --------------------------------------
        */

        if(isset($_POST['updateCateProd_action'])) {
            $error = [];
            global $error;

            /*
            * --- check cateprod status
            */

            $_POST['cateProd_status'] = !empty($_POST['cateProd_status']) ? "on" : "off";
            $cateProd_status = $_POST['cateProd_status'];

            /*
            * --- check cateprod name
            */

            if(empty($_POST['cateProd_name'])) {
                $error['cateProd_name'] = "<span class='error'>(*) Vui lòng nhập tên danh mục</span>";
            } else {
                $cateProd_name = Format::validation($_POST['cateProd_name']);
            }

            /*
            * --- check cateprod desc
            */

            $cateProd_desc = !empty($_POST['cateProd_desc']) ? $_POST['cateProd_desc'] : '';

            /*
            * --- check cateprod meta title
            */

            if(empty($_POST['cateProd_keyword'])) {
                $error['cateProd_keyword'] = "<span class='error'>(*) Vui lòng nhập từ khóa cho danh mục</span>";
            } else {
                $cateProd_keyword =  Format::validation($_POST['cateProd_keyword']);
            }

            /*
            * --- check cateprod meta title
            */

            if(empty($_POST['cateProd_metaTitle'])) {
                $error['cateProd_metaTitle'] = "<span class='error'>(*) Vui lòng nhập thẻ tiêu đề (Meta desc)</span>";
            } else {
                $cateProd_metaTitle =  Format::validation($_POST['cateProd_metaTitle']);
            }

            /*
            * --- check cateprod meta desc
            */

            if(empty($_POST['cateProd_metaDesc'])) {
                $error['cateProd_metaDesc'] = "<span class='error'>(*) Vui lòng nhập thẻ mô tả (Meta desc)</span>";
            } else {
                $cateProd_metaDesc = Format::validation($_POST['cateProd_metaDesc']);
            }

            /*
            * --- check cateprod seo url
            */

            if(empty($_POST['cateProd_seoUrl'])) {
                $error['cateProd_seoUrl'] = "<span class='error'>(*) Vui lòng nhập đường dẫn SEO</span>";
            } else {
                $cateProd_seoUrl = Format::create_slug(Format::validation($_POST['cateProd_seoUrl']));
            }

            /*
            * --- check cateprod parent ID
            */

            $cateProd_parentId = !empty($_POST['cateProd_parentId']) ? (int) $_POST['cateProd_parentId'] : 0;

            /*
            * --- check cateprod image
            */

            if(empty($_POST['cateProd_image'])) {
                $error['cateProd_image'] = "<span class='error'>(*) Vui lòng chọn mini icon</span>";
            } else {
                $cateProd_image = $_POST['cateProd_image'];
            }

            /*
            * --- check cateprod banner PC
            */

            if(empty($_POST['cateProd_bannerPc'])) {
                $error['cateProd_bannerPc'] = "<span class='error'>(*) Vui lòng chọn banner cho PC</span>";
            } else {
                $cateProd_bannerPc = $_POST['cateProd_bannerPc'];
            }

            /*
            * --- check cateprod banner mobile
            */

            if(empty($_POST['cateProd_bannerMb'])) {
                $error['cateProd_bannerMb'] = "<span class='error'>(*) Vui lòng chọn banner cho mobile</span>";
            } else {
                $cateProd_bannerMb = $_POST['cateProd_bannerMb'];
            }

            /*
            * --- check cateprod order
            */

            $cateProd_order = !empty($_POST['cateProd_order']) ? (int)$_POST['cateProd_order'] : ($this->CateProductModel->getOrderMaxPlus());

            /*
            * --- check cateprod error
            */

            if(empty($error)) {
                $cateProd_updateDate = time();
                $dataCateProd = [
                    "cateProd_name"       => $cateProd_name,
                    "cateProd_image"      => $cateProd_image,
                    "cateProd_bannerPc"   => $cateProd_bannerPc,
                    "cateProd_bannerMb"   => $cateProd_bannerMb,
                    "cateProd_desc"       => $cateProd_desc,
                    "cateProd_order"      => $cateProd_order,
                    "cateProd_keyword"    => $cateProd_keyword,
                    "cateProd_metaTitle"  => $cateProd_metaTitle,
                    "cateProd_metaDesc"   => $cateProd_metaDesc,
                    "cateProd_seoUrl"     => $cateProd_seoUrl,
                    "cateProd_parentId"   => $cateProd_parentId,
                    "cateProd_updateDate" => $cateProd_updateDate,
                    "cateProd_status"     => $cateProd_status,
                ];
                $process = $this->CateProductModel->updateCateProd($dataCateProd, $cateProd_id);
                if($process) {
                    $statusActionCateProd = [
                        "status"    => "success",
                        "notifiTxt" => "Cập nhật danh mục sản phẩm thành công"
                    ];
                } else {
                    $statusActionCateProd = [
                        "status"    => "error",
                        "notifiTxt" => "Cập nhật danh mục sản phẩm không thành công"
                    ];
                }
            }
        }
        $dataView = [
            "title"  => "Cập nhật danh mục sản phẩm",
            "layOut" => "UpdateCateProduct",
            "css"    => ["home","fancybox.min"],
            "data"   => [
                "listCateProd"         => $this->CateProductModel->getMultiLevelCateProd($this->CateProductModel->getListTotalCateProd()),
                "cateProdItem"         => $cateProdItem,
                "statusActionCateProd" => !empty($statusActionCateProd) ? $statusActionCateProd : []
            ]
        ];

        $this->view("MasterIndex", $dataView);
    }

    public function changeStatus()
    {
        $cateProd_id  = (int)$_POST['cateProd_id'];
        $cateProd_status = Format::validation($_POST['statusChange']);
        $dataCateProd = [
            "cateProd_status" => $cateProd_status
        ];
        $process = $this->CateProductModel->updateCateProd($dataCateProd, $cateProd_id);
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
        $cateProd_id = $_POST['cateProd_id'];
        $process = $this->CateProductModel->deleteCateProd($cateProd_id);
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
        $listCateProdId = $_POST['listCateProdId'];
        $cateProdIdDeleteError = [];
        foreach($listCateProdId as $cateProdIdItem) {
            $idCateProd = (int) $cateProdIdItem;
            $process = $this->CateProductModel->deleteCateProd($idCateProd);
            if(!$process) {
                $cateProdIdDeleteError[] = $cateProdIdItem;
            }
        }
        if(!empty($cateProdIdDeleteError)) {
            $dataAjax = [
                "status"            => "error",
                "listIdCantDeleted" => $cateProdIdDeleteError
            ];
        } else {
            $dataAjax = [
                "status" => "success"
            ];
        }
        echo json_encode($dataAjax);
    }

    public function multiChangeStatus() {
        $listCateProdId = $_POST['listCateProdId'];
        $statusChange   = $_POST['statusChange'];
        $cateProdIdUpdateError = [];
        foreach($listCateProdId as $cateProdIdItem) {
            $idCateProd = (int) $cateProdIdItem;
            $dataCateProd = [
                "cateProd_status" => $statusChange
            ];
            $process = $this->CateProductModel->updateCateProd($dataCateProd, $idCateProd);
            if(!$process) {
                $cateProdIdUpdateError[] = $cateProdIdItem;
            }
        }
        if(!empty($cateProdIdUpdateError)) {
            $dataAjax = [
                "status"            => "error",
                "listIdCantDeleted" => $cateProdIdUpdateError
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
        $result   = $this->CateProductModel->searchCateProdByName($vlSearch);
        $dataAjax = [
            "searchData" => $result
        ];
        echo json_encode($dataAjax);
    }

    public function loadCateByField()
    {
        $fieldName = $_POST['fieldName'];
        $dataAjax = [
            "listData" => $this->CateProductModel->loadCateProductByField($fieldName)
        ];
        echo json_encode($dataAjax);
    }

    public function searchRecommentByFile()
    {
        $searchValue = $_POST['searchValue'];
        $fieldName   = $_POST['fieldName'];
        $dataAjax = [
            "searchData" => $this->CateProductModel->searchRecommentByFile($fieldName, $searchValue)
        ];
        echo json_encode($dataAjax);
    }

    public function recommentCateProdByCateProdParentId()
    {
        $data = $_POST['data'];
        $cateId = (int) $data['cateId'];
        $dataAjax = [
            "dataRecomment" => $this->CateProductModel->getCateProdByParentCateId($cateId)
        ];
        echo json_encode($dataAjax);
    }
}
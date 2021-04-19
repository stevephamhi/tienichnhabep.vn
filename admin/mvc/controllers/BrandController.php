<?php

class BrandController extends Controller
{

    public $BrandModel;

    function __construct()
    {
        $this->BrandModel = $this->model('Brand');
    }

    public function index($orderBy = 'desc', $status = 'all', $page = 1, $strSearch = '')
    {
        if(!empty($strSearch)) {
            $strSearch = Format::validationSearch($strSearch);
            $listBrand = $this->BrandModel->searchBrandByName(Format::validation($strSearch));
        } else {
            $orderByAllow = ["asc","desc"];
            $statusAllow  = ["all","on","off"];
            $orderBy      = in_array($orderBy,$orderByAllow) ? $orderBy : "asc";
            $status       = in_array($status,$statusAllow)   ? $status  : "all";
            $page         = $page >= 1 ? $page : 1;
            $numPerPage   = 10;
            $totalBrand   = count($this->BrandModel->getListTotalBrandByStatus($status));
            $totalPage    = ceil($totalBrand/$numPerPage);
            $pageStart    = (int) ($page-1) * $numPerPage;
            $listBrand    = $this->BrandModel->getBrandByPagination($orderBy, $status, $pageStart, $numPerPage);
        }
        $dataView = [
            "title"  => "Danh sách thương hiệu",
            "layOut" => "ListBrands",
            "css"    => ["home"],
            "data"   => [
                "orderBy"    => !empty($orderBy)    ? $orderBy    : null,
                "status"     => !empty($status)     ? $status     : null,
                "page"       => !empty($page)       ? $page       : null,
                "totalPage"  => !empty($totalPage)  ? $totalPage  : null,
                "numPerPage" => !empty($numPerPage) ? $numPerPage : null,
                "listBrand"  => !empty($listBrand)  ? $listBrand  : null,
                "strSearch"  => !empty($strSearch)  ? $strSearch  : null,
                "totalBrand" => !empty($totalBrand) ? $totalBrand : count($listBrand),
            ]
        ];
        $this->view("MasterIndex", $dataView);
    }

    public function add()
    {
        $helper = new Helper;
        if(isset($_POST['addBrand_action'])) {
            $error = [];
            global $error;

            /*
            * --- check brand status
            */

            $brand_status = !empty($_POST['brand_status']) ? "on" : "off";

            /*
            * --- check brand name
            */

            if(empty($_POST['brand_name'])) {
                $error['brand_name'] = "<span class='error'>(*) Vui lòng nhập tên thương hiệu</span>";
            } else {
                $brand_name = Format::validation($_POST['brand_name']);
            }

            /*
            * --- check brand keywords
            */

            $brand_keywords = !empty($_POST['brand_keywords']) ? Format::validation($_POST['brand_keywords']) : null;

            /*
            * --- check brand image
            */

            if(empty($_POST['brand_image'])) {
                $error['brand_image'] = "<span class='error'>(*) Vui lòng chọn image logo cho của thương hiệu</span>";
            } else {
                $brand_image = $_POST['brand_image'];
            }

            /*
            * --- check brand order
            */

            $brand_order = !empty($_POST['brand_order']) ? (int)$_POST['brand_order'] : "0";
            $_POST['brand_order'] = $brand_order;

            /*
            * --- check brand meta image
            */

            if(empty($_POST['brand_metaImg'])) {
                $error['brand_metaImg'] = "<span class='error'>(*) Vui lòng nhập ảnh meta</span>";
            } else {
                $brand_metaImg = $_POST['brand_metaImg'];
            }


            /*
            * --- check brand meta title
            */

            if(empty($_POST['brand_metaTitle'])) {
                $error['brand_metaTitle'] = "<span class='error'>(*) Vui lòng nhập thẻ tiêu đề</span>";
            } else {
                $brand_metaTitle = $_POST['brand_metaTitle'];
            }

            /*
            * --- check brand meta title
            */

            if(empty($_POST['brand_metaDesc'])) {
                $error['brand_metaDesc'] = "<span class='error'>(*) Vui lòng nhập thẻ mô tả</span>";
            } else {
                $brand_metaDesc = $_POST['brand_metaDesc'];
            }

            /*
            * --- check brand seo url
            */

            if(empty($_POST['brand_seoUrl'])) {
                $error['brand_seoUrl'] = "<span class='error'>(*) Vui lòng nhập đường dẫn seo</span>";
            } else {
                $brand_seoUrl = $_POST['brand_seoUrl'];
            }

            /*
            * --- check brand banner
            */

            $brand_banner = !empty($_POST['brand_banner']) ? $_POST['brand_banner'] : null;

            /*
            * --- check error
            */

            if(empty($error)) {
                if(!($this->BrandModel->checkBrandExists($brand_name))) {
                    $brand_createDate = time();
                    $brand_creatorId  = (int)$helper->infoUser("user_id");
                    $dataBrand = [
                        "brand_name"       => $brand_name,
                        "brand_image"      => $brand_image,
                        "brand_keywords"   => $brand_keywords,
                        "brand_order"      => $brand_order,
                        "brand_metaImg"    => $brand_metaImg,
                        "brand_metaTitle"  => $brand_metaTitle,
                        "brand_metaDesc"   => $brand_metaDesc,
                        "brand_seoUrl"     => $brand_seoUrl,
                        "brand_banner"     => $brand_banner,
                        "brand_createDate" => $brand_createDate,
                        "brand_status"     => $brand_status,
                        "brand_creatorId"  => $brand_creatorId,
                    ];
                    $idBrand = $this->BrandModel->addBrandNew($dataBrand);
                    if(is_int($idBrand)) {
                        $statusActionBrand = [
                            "status"    => "success",
                            "notifiTxt" => "Thêm thương hiệu thành công"
                        ];
                    } else {
                        $statusActionBrand = [
                            "status"    => "error",
                            "notifiTxt" => "Thêm thương hiệu không thành công"
                        ];
                    }
                } else {
                    $statusActionBrand = [
                        "status"    => "error",
                        "notifiTxt" => "Thương hiệu đã tồn tại [ ERROR: Trùng tên thương hiệu ]"
                    ];
                }
            } else {
                $statusActionBrand = [
                    "status"    => "error",
                    "notifiTxt" => "Một số thông tin bạn chưa hoàn thành hoặc không đúng kiểu dữ liệu"
                ];
            }

        }
        $dataView = [
            "title"  => "Thêm thương hiệu",
            "layOut" => "AddBrand",
            "css"    => ["home","fancybox.min"],
            "data"   => [
                "statusActionBrand" => !empty($statusActionBrand) ? $statusActionBrand : []
            ]
        ];
        $this->view("MasterIndex", $dataView);
    }

    public function changeStatus() {
        $brand_id     = (int)$_POST['brand_id'];
        $brand_status = $_POST['statusChange'];
        $dataBrand    = [
            "brand_status" => $brand_status
        ];
        $process = $this->BrandModel->updateBrand($dataBrand, $brand_id);
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
        $brand_id = $_POST['brand_id'];
        $process  = $this->BrandModel->deleteBrand($brand_id);
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
        $listBrandId        = $_POST['listBrandId'];
        $BrandIdDeleteError = [];
        foreach($listBrandId as $BrandIdItem) {
            $idBrand = (int) $BrandIdItem;
            $process = $this->BrandModel->deleteBrand($idBrand);
            if(!$process) {
                $BrandIdDeleteError[] = $BrandIdItem;
            }
        }
        if(!empty($BrandIdDeleteError)) {
            $dataAjax = [
                "status"            => "error",
                "listIdCantDeleted" => $BrandIdDeleteError
            ];
        } else {
            $dataAjax = [
                "status" => "success"
            ];
        }
        echo json_encode($dataAjax);
    }

    public function multiChangeStatus()
    {
        $listBrandId        = $_POST['listBrandId'];
        $statusChange       = $_POST['statusChange'];
        $BrandIdUpdateError = [];
        foreach($listBrandId as $BrandIdItem) {
            $idBrand = (int) $BrandIdItem;
            $dataBrand = [
                "brand_status" => $statusChange
            ];
            $process = $this->BrandModel->updateBrand($dataBrand, $idBrand);
            if(!$process) {
                $BrandIdUpdateError[] = $BrandIdItem;
            }
        }
        if(!empty($BrandIdUpdateError)) {
            $dataAjax = [
                "status"            => "error",
                "listIdCantUpdate"  => $BrandIdUpdateError
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
        $vlSearch = Format::validation($_POST['vlSearch']);
        $result   = $this->BrandModel->searchBrandByName($vlSearch);
        $dataAjax = [
            "searchData" => $result
        ];
        echo json_encode($dataAjax);
    }


    public function update($brand_id = 0)
    {
        $brand_id = (!empty($brand_id)) ? (int)$brand_id : 0;
        $brandItem = $this->BrandModel->getBrandItemById($brand_id);

        /*
        * -------------------------------
        * ----- Handle update brand -----
        * -------------------------------
        */

        if(isset($_POST['updateBrand_action'])) {
            $error = [];
            global $error;

            /*
            * --- check brand status
            */

            $_POST['brand_status'] = !empty($_POST['brand_status']) ? "on" : "off";
            $brand_status = $_POST['brand_status'];

            /*
            * --- check brand name
            */

            if(empty($_POST['brand_name'])) {
                $error['brand_name'] = "<span class='error'>(*) Vui lòng nhập tên thương hiệu</span>";
            } else {
                $brand_name = Format::validation($_POST['brand_name']);
            }

            /*
            * --- check brand keywords
            */

            $brand_keywords = !empty($_POST['brand_keywords']) ? Format::validation($_POST['brand_keywords']) : null;

            /*
            * --- check brand image
            */

            if(empty($_POST['brand_image'])) {
                $error['brand_image'] = "<span class='error'>(*) VUi lòng chọn image logo cho của thương hiệu</span>";
            } else {
                $brand_image = $_POST['brand_image'];
            }

            /*
            * --- check brand order
            */

            $brand_order = !empty($_POST['brand_order']) ? (int)$_POST['brand_order'] : 0;
            $_POST['brand_order'] = $brand_order;

            /*
            * --- check brand meta image
            */

            if(empty($_POST['brand_metaImg'])) {
                $error['brand_metaImg'] = "<span class='error'>(*) Vui lòng nhập ảnh meta</span>";
            } else {
                $brand_metaImg = $_POST['brand_metaImg'];
            }


            /*
            * --- check brand meta title
            */

            if(empty($_POST['brand_metaTitle'])) {
                $error['brand_metaTitle'] = "<span class='error'>(*) Vui lòng nhập thẻ tiêu đề</span>";
            } else {
                $brand_metaTitle = $_POST['brand_metaTitle'];
            }

            /*
            * --- check brand meta title
            */

            if(empty($_POST['brand_metaDesc'])) {
                $error['brand_metaDesc'] = "<span class='error'>(*) Vui lòng nhập thẻ mô tả</span>";
            } else {
                $brand_metaDesc = $_POST['brand_metaDesc'];
            }

            /*
            * --- check brand seo url
            */

            if(empty($_POST['brand_seoUrl'])) {
                $error['brand_seoUrl'] = "<span class='error'>(*) Vui lòng nhập đường dẫn seo</span>";
            } else {
                $brand_seoUrl = $_POST['brand_seoUrl'];
            }

            /*
            * --- check brand banner
            */

            $brand_banner = !empty($_POST['brand_banner']) ? $_POST['brand_banner'] : null;

            /*
            * --- check error
            */

            if(empty($error)) {
                $brand_updateDate = time();
                $dataBrand = [
                    "brand_name"       => $brand_name,
                    "brand_image"      => $brand_image,
                    "brand_keywords"   => $brand_keywords,
                    "brand_order"      => $brand_order,
                    "brand_metaImg"    => $brand_metaImg,
                    "brand_metaTitle"  => $brand_metaTitle,
                    "brand_metaDesc"   => $brand_metaDesc,
                    "brand_seoUrl"     => $brand_seoUrl,
                    "brand_banner"     => $brand_banner,
                    "brand_updateDate" => $brand_updateDate,
                    "brand_status"     => $brand_status,
                ];
                $process = $this->BrandModel->updateBrand($dataBrand, $brand_id);
                if($process) {
                    $statusActionBrand = [
                        "status"    => "success",
                        "notifiTxt" => "Cập nhật thương hiệu thành công"
                    ];
                } else {
                    $statusActionBrand = [
                        "status"    => "error",
                        "notifiTxt" => "Cập nhật thương hiệu không thành công"
                    ];
                }
            }

        }

        $dataView = [
            "title"  => "Cập nhật thương hiệu",
            "layOut" => "UpdateBrand",
            "css"    => ["home","fancybox.min"],
            "data"   => [
                "brandItem"            => $brandItem,
                "statusActionCateProd" => !empty($statusActionCateProd) ? $statusActionCateProd : [],
                "statusActionBrand"    => !empty($statusActionBrand) ? $statusActionBrand : null
            ]
        ];
        $this->view("MasterIndex", $dataView);
    }

    public function getListTotalBrandByStatus()
    {
        $status = $_POST['status'];
        $dataAjax = [
            "listBrand" => $this->BrandModel->getListTotalBrandByStatus($status)
        ];
        echo json_encode($dataAjax);
    }

    public function handleGetOrderMax()
    {
        $dataAjax = [
            "orderMax" => $this->BrandModel->getOrderMax()
        ];
        echo json_encode($dataAjax['orderMax']);
    }
}
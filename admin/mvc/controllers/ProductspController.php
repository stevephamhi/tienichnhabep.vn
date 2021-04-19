<?php

class ProductspController extends Controller
{
    private $ProductspModel;

    public function __construct()
    {
        $this->ProductspModel = $this->model("Productsp");
    }

    public function index($orderBy = 'desc', $status = 'all', $page = 1, $strSearch = '')
    {
        if(!empty($strSearch)) {
            $strSearch = Format::validationSearch($strSearch);
            $listProdsp = $this->ProductspModel->searchProdspByName($strSearch);
        } else {
            $orderByAllow     = ["asc","desc"];
            $statusAllow      = ["all","on","off"];
            $orderBy          = in_array($orderBy,$orderByAllow) ? $orderBy : "asc";
            $status           = in_array($status,$statusAllow)   ? $status  : "all";
            $page             = $page >= 1 ? $page : 1;
            $numPerPage       = 10;
            $totalProdsp      = count($this->ProductspModel->getListProdspByStatus($status));
            $totalPage        = ceil($totalProdsp / $numPerPage);
            $pageStart        = ($page - 1) * $numPerPage;
            $listProdsp       = $this->ProductspModel->getProdspByPagination($orderBy, "prodsp_order", $status, $pageStart, $numPerPage);
        }
        $dataView = [
            "title"  => "Danh sách thông tin hỗ trợ",
            "layOut" => "ListProdsp",
            "css"    => ["home"],
            "data"   => [
                "orderBy"     => !empty($orderBy)     ? $orderBy     : null,
                "status"      => !empty($status)      ? $status      : null,
                "page"        => !empty($page)        ? $page        : null,
                "numPerPage"  => !empty($numPerPage)  ? $numPerPage  : null,
                "totalPage"   => !empty($totalPage)   ? $totalPage   : null,
                "strSearch"   => !empty($strSearch)   ? $strSearch   : null,
                "listProdsp"  => !empty($listProdsp)  ? $listProdsp  : null,
                "totalProdsp" => !empty($totalProdsp) ? $totalProdsp : count($listProdsp),
            ]
        ];
        $this->view("MasterIndex", $dataView);
    }

    public function add()
    {
        $helper = new Helper;

        if(isset($_POST['addProductsp_action'])) {
            $error = [];
            global $error;

            /*
            * --- check prodsp status
            */

            $prodsp_status = !empty($_POST['prodsp_status']) ? "on" : "off";

            /*
            * --- check prodsp image
            */

            if(empty($_POST['prodsp_image'])) {
                $error['prodsp_image'] = "<span class='error'>(*) Vui lòng nhập ảnh thông tin</span>";
            } else {
                $prodsp_image = $_POST['prodsp_image'];
            }

            /*
            * --- check prodsp name
            */

            if(empty($_POST['prodsp_name'])) {
                $error['prodsp_name'] = "<span class='error'>(*) Vui lòng nhập tên thông tin</span>";
            } else {
                $prodsp_name = $_POST['prodsp_name'];
            }

            /*
            * --- check prodsp order
            */

            $prodsp_order = !empty($_POST['prodsp_order']) ? (int) $_POST['prodsp_order'] : 0;
            $_POST['prodsp_order'] = $prodsp_order;

            /*
            * --- check prodsp content
            */

            if(empty($_POST['prodsp_content'])) {
                $error['prodsp_content'] = "<span class='error'>(*) Vui lòng nhập nội dung</span>";
            } else {
                $prodsp_content = $_POST['prodsp_content'];
            }


            /*
            * --- check prodsp meta title
            */

            if(empty($_POST['prodsp_metaImg'])) {
                $error['prodsp_metaImg'] = "<span class='error'>(*) Vui lòng nhập meta ảnh thông tin hỗ trợ</span>";
            } else {
                $prodsp_metaImg = $_POST['prodsp_metaImg'];
            }

            /*
            * --- check prodsp meta title
            */

            if(empty($_POST['prodsp_metaTitle'])) {
                $error['prodsp_metaTitle'] = "<span class='error'>(*) Vui lòng nhập meta title</span>";
            } else {
                $prodsp_metaTitle = $_POST['prodsp_metaTitle'];
            }

            /*
            * --- check prodsp meta desc
            */

            if(empty($_POST['prodsp_metaDesc'])) {
                $error['prodsp_metaDesc'] = "<span class='error'>(*) Vui lòng nhập mô tả seo</span>";
            } else {
                $prodsp_metaDesc = $_POST['prodsp_metaDesc'];
            }

            /*
            * --- check prodsp seo url
            */

            if(empty($_POST['prodsp_seoUrl'])) {
                $error['prodsp_seoUrl'] = "<span class='error'>(*) Vui lòng nhập seo url</span>";
            } else {
                $prodsp_seoUrl = $_POST['prodsp_seoUrl'];
            }

            if(empty($error)) {
                if( !($this->ProductspModel->checkProdspExists($prodsp_name)) ) {
                    $prodsp_createDate = time();
                    $prodsp_creatorId  = $helper->infoUser("user_id");
                    $dataProdsp = [
                        "prodsp_name"       => $prodsp_name,
                        "prodsp_image"      => $prodsp_image,
                        "prodsp_content"    => $prodsp_content,
                        "prodsp_order"      => $prodsp_order,
                        "prodsp_metaImg"    => $prodsp_metaImg,
                        "prodsp_metaTitle"  => $prodsp_metaTitle,
                        "prodsp_metaDesc"   => $prodsp_metaDesc,
                        "prodsp_seoUrl"     => $prodsp_seoUrl,
                        "prodsp_status"     => $prodsp_status,
                        "prodsp_createDate" => $prodsp_createDate,
                        "prodsp_creatorId"  => $prodsp_creatorId
                    ];
                    $idProdsp = $this->ProductspModel->addProdspNew($dataProdsp);
                    if(is_int($idProdsp)) {
                        $statusActionProdsp = [
                            "status"    => "success",
                            "notifiTxt" => "Thêm thông tin hỗ trợ thành công"
                        ];
                    } else {
                        $statusActionProdsp = [
                            "status"    => "success",
                            "notifiTxt" => "Thêm thông tin hỗ trợ không thành công"
                        ];
                    }
                } else {
                    $statusActionProdsp = [
                        "status"    => "error",
                        "notifiTxt" => "Thông tin hỗ trợ đã tồn tại [ Trùng tên thông tin ]"
                    ];
                }
            } else {
                $statusActionProdsp = [
                    "status"    => "error",
                    "notifiTxt" => "Một số thông tin bạn chưa hoàn thành hoặc không đúng kiểu dữ liệu"
                ];
            }

        }

        $dataView = [
            "title"  => "Thêm thông tin hỗ trợ sản phẩm",
            "layOut" => "AddProdsp",
            "css"    => ["home","fancybox.min"],
            "data"   => [
                "statusActionProdsp" => !empty($statusActionProdsp) ? $statusActionProdsp : null
            ]
        ];
        $this->view("MasterIndex", $dataView);
    }

    public function update($infoSpProd_id)
    {
        $infoSpProd_id  = (!empty($infoSpProd_id)) ? (int)$infoSpProd_id : 0;
        $infoSpProdItem = $this->ProductspModel->getProdSupportInfoById($infoSpProd_id);

        /*
        * -----------------------------------
        * ----- Handle update info prod -----
        * -----------------------------------
        */

        if(isset($_POST['updateProductsp_action'])) {
            $error = [];
            global $error;

            /*
            * --- check prodsp status
            */

            $prodsp_status = !empty($_POST['prodsp_status']) ? "on" : "off";

            /*
            * --- check prodsp image
            */

            if(empty($_POST['prodsp_image'])) {
                $error['prodsp_image'] = "<span class='error'>(*) Vui lòng nhập ảnh thông tin</span>";
            } else {
                $prodsp_image = $_POST['prodsp_image'];
            }

            /*
            * --- check prodsp name
            */

            if(empty($_POST['prodsp_name'])) {
                $error['prodsp_name'] = "<span class='error'>(*) Vui lòng nhập tên thông tin</span>";
            } else {
                $prodsp_name = $_POST['prodsp_name'];
            }

            /*
            * --- check prodsp order
            */

            $prodsp_order = !empty($_POST['prodsp_order']) ? (int) $_POST['prodsp_order'] : 0;
            $_POST['prodsp_order'] = $prodsp_order;

            /*
            * --- check prodsp content
            */

            if(empty($_POST['prodsp_content'])) {
                $error['prodsp_content'] = "<span class='error'>(*) Vui lòng nhập nội dung</span>";
            } else {
                $prodsp_content = $_POST['prodsp_content'];
            }


            /*
            * --- check prodsp meta title
            */

            if(empty($_POST['prodsp_metaImg'])) {
                $error['prodsp_metaImg'] = "<span class='error'>(*) Vui lòng nhập meta ảnh thông tin hỗ trợ</span>";
            } else {
                $prodsp_metaImg = $_POST['prodsp_metaImg'];
            }

            /*
            * --- check prodsp meta title
            */

            if(empty($_POST['prodsp_metaTitle'])) {
                $error['prodsp_metaTitle'] = "<span class='error'>(*) Vui lòng nhập meta title</span>";
            } else {
                $prodsp_metaTitle = $_POST['prodsp_metaTitle'];
            }

            /*
            * --- check prodsp meta desc
            */

            if(empty($_POST['prodsp_metaDesc'])) {
                $error['prodsp_metaDesc'] = "<span class='error'>(*) Vui lòng nhập mô tả seo</span>";
            } else {
                $prodsp_metaDesc = $_POST['prodsp_metaDesc'];
            }

            /*
            * --- check prodsp seo url
            */

            if(empty($_POST['prodsp_seoUrl'])) {
                $error['prodsp_seoUrl'] = "<span class='error'>(*) Vui lòng nhập seo url</span>";
            } else {
                $prodsp_seoUrl = $_POST['prodsp_seoUrl'];
            }

            if(empty($error)) {
                $prodsp_createDate = time();
                $dataProdsp = [
                    "prodsp_name"       => $prodsp_name,
                    "prodsp_image"      => $prodsp_image,
                    "prodsp_content"    => $prodsp_content,
                    "prodsp_order"      => $prodsp_order,
                    "prodsp_metaImg"    => $prodsp_metaImg,
                    "prodsp_metaTitle"  => $prodsp_metaTitle,
                    "prodsp_metaDesc"   => $prodsp_metaDesc,
                    "prodsp_seoUrl"     => $prodsp_seoUrl,
                    "prodsp_status"     => $prodsp_status,
                    "prodsp_createDate" => $prodsp_createDate,
                    "prodsp_updateDate" => time()
                ];
                $process = $this->ProductspModel->updateProdsp($dataProdsp, $infoSpProd_id);
                if($process) {
                    $statusActionProdsp = [
                        "status"    => "success",
                        "notifiTxt" => "Cập nhật thông tin hỗ trợ thành công"
                    ];
                } else {
                    $statusActionProdsp = [
                        "status"    => "success",
                        "notifiTxt" => "Cập nhật tin hỗ trợ không thành công"
                    ];
                }
            } else {
                $statusActionProdsp = [
                    "status"    => "error",
                    "notifiTxt" => "Một số thông tin bạn chưa hoàn thành hoặc không đúng kiểu dữ liệu"
                ];
            }

        }

        $dataView = [
            "title"  => "Cập nhật thông tin hỗ trợ sản phẩm",
            "layOut" => "UpdateProdsp",
            "css"    => ["home","fancybox.min"],
            "data"   => [
                "infoSpProdItem"     => $infoSpProdItem,
                "statusActionProdsp" => !empty($statusActionProdsp) ? $statusActionProdsp : null,
            ]
        ];

        $this->view("MasterIndex", $dataView);

    }

    public function handleGetOrderMax()
    {
        $dataAjax = [
            "orderMax" => $this->ProductspModel->getOrderMax()
        ];
        echo json_encode($dataAjax['orderMax']);
    }

    public function updateProdspOrder()
    {
        $prodspOrderChange = (int) $_POST['prodspOrderChange'];
        $prodspID          = (int) $_POST['prodspID'];
        $dataProdsp = [
            "prodsp_order" => $prodspOrderChange
        ];
        $process = $this->ProductspModel->updateProdsp($dataProdsp, $prodspID);
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
        $prodsp_id     = (int)$_POST['prodsp_id'];
        $prodsp_status = $_POST['statusChange'];
        $dataProdsp = [
            "prodsp_status" => $prodsp_status
        ];
        $process = $this->ProductspModel->updateProdsp($dataProdsp, $prodsp_id);
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
        $prodsp_id = $_POST['prodsp_id'];
        $process = $this->ProductspModel->deleteProdsp($prodsp_id);
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
        $listProdspId = $_POST['listProdspId'];
        $prodspIdDeleteError = [];
        foreach($listProdspId as $prodspIdItem) {
            $idProdsp = (int) $prodspIdItem;
            $process = $this->ProductspModel->deleteProdsp($idProdsp);
            if(!$process) {
                $prodspIdDeleteError[] = $prodspIdItem;
            }
        }
        if(!empty($prodspIdDeleteError)) {
            $dataAjax = [
                "status"            => "error",
                "listIdCantDeleted" => $prodspIdDeleteError
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
        $listProdspId = $_POST['listProdspId'];
        $statusChange = $_POST['statusChange'];
        $prodspIdUpdateError = [];
        foreach($listProdspId as $prodspIdItem) {
            $idProdsp = (int) $prodspIdItem;
            $dataProdsp = [
                "prodsp_status" => $statusChange
            ];
            $process = $this->ProductspModel->updateProdsp($dataProdsp, $idProdsp);
            if(!$process) {
                $prodspIdUpdateError[] = $prodspIdItem;
            }
        }
        if(!empty($prodspIdUpdateError)) {
            $dataAjax = [
                "status"            => "error",
                "listIdCantDeleted" => $prodspIdUpdateError
            ];
        } else {
            $dataAjax = [
                "status" => "success"
            ];
        }
        echo json_encode($dataAjax);
    }

    public function getAllProdsp()
    {
        $dataAjax = [
            "listProdsp" => $this->ProductspModel->getListProdspByStatus("all")
        ];
        echo json_encode($dataAjax);
    }

    public function recommentSearch()
    {
        $vlSearch = $_POST['vlSearch'];
        $result   = $this->ProductspModel->searchProdspByName($vlSearch);
        $dataAjax = [
            "searchData" => $result
        ];
        echo json_encode($dataAjax);
    }
}
<?php

class PolicyController extends Controller
{
    private $PolicyModel;

    public function __construct()
    {
        $this->PolicyModel = $this->model("Policy");
    }

    public function index($orderBy = 'desc', $status = 'all', $page = 1, $strSearch = '')
    {
        if(!empty($strSearch)) {
            $strSearch = Format::validationSearch($strSearch);
            $listPolicy = $this->PolicyModel->searchPolicyByName($strSearch);
        } else {
            $orderByAllow  = ["asc","desc"];
            $statusAllow   = ["all","on","off"];
            $orderBy       = in_array($orderBy,$orderByAllow) ? $orderBy : "asc";
            $status        = in_array($status,$statusAllow)   ? $status  : "all";
            $page          = $page >= 1 ? $page : 1;
            $numPerPage    = 10;
            $totalPolicy   = count($this->PolicyModel->getListPolicyByStatus($status));
            $totalPage     = ceil($totalPolicy / $numPerPage);
            $pageStart     = ($page - 1) * $numPerPage;
            $listPolicy    = $this->PolicyModel->getListPolicyByPagination($orderBy, $status, $pageStart, $numPerPage);
        }

        $dataView = [
            "title"  => "Danh sách chính sách",
            "layOut" => "ListPolicy",
            "css"    => ["home"],
            "data"   => [
                "orderBy"     => !empty($orderBy)      ? $orderBy    : null,
                "status"      => !empty($status)       ? $status     : null,
                "page"        => !empty($page)         ? $page       : null,
                "listPolicy"  => !empty($listPolicy)   ? $listPolicy : null,
                "numPerPage"  => !empty($numPerPage)   ? $numPerPage : null,
                "totalPage"   => !empty($totalPage)    ? $totalPage  : null,
                "strSearch"   => !empty($strSearch)    ? $strSearch  : null,
                "totalPolicy" => !empty($totalPolicy)  ? $totalPolicy  : count($listPolicy),
            ]
        ];
        $this->view("MasterIndex", $dataView);
    }

    public function add()
    {

        $helper = new Helper;

        if(isset($_POST['addPolicy_action'])) {
            $error = [];
            global $error;

            /*
            * --- check policy status
            */

            $policy_status = !empty($_POST['policy_status']) ? "on" : "off";

            /*
            * --- check policy title
            */

            if(empty($_POST['policy_title'])) {
                $error['policy_title'] = "<span class='error'>(*) Bạn vui lòng nhập tiêu đề</span>";
            } else {
                $policy_title = $_POST['policy_title'];
            }

            /*
            * --- check policy desc
            */

            if(empty($_POST['policy_desc'])) {
                $error['policy_desc'] = "<span class='error'>(*) Bạn vui lòng nhập mô tả</span>";
            } else {
                $policy_desc = $_POST['policy_desc'];
            }

            /*
            * --- check policy meta title
            */

            if(empty($_POST['policy_metaTitle'])) {
                $error['policy_metaTitle'] = "<span class='error'>(*) Bạn vui lòng nhập meta title</span>";
            } else {
                $policy_metaTitle = $_POST['policy_metaTitle'];
            }

            /*
            * --- check policy meta desc
            */

            if(empty($_POST['policy_metaDesc'])) {
                $error['policy_metaDesc'] = "<span class='error'>(*) Bạn vui lòng nhập meta description</span>";
            } else {
                $policy_metaDesc = $_POST['policy_metaDesc'];
            }

            /*
            * --- check policy meta seo url
            */

            if(empty($_POST['policy_seoUrl'])) {
                $error['policy_seoUrl'] = "<span class='error'>(*) Bạn vui lòng nhập đường dẫn seo</span>";
            } else {
                $policy_seoUrl = $_POST['policy_seoUrl'];
            }

            /*
            * --- check policy meta order
            */

            $policy_order = !empty($_POST['policy_order']) ? (int) $_POST['policy_order'] : 0;

            /*
            * --- check policy error
            */

            if(empty($error)) {
                if(!($this->PolicyModel->checkPolicyExists($policy_title))) {
                    $policy_createDate = time();
                    $policy_creatorId  = $helper->infoUser("user_id");

                    $dataPolicy = [
                        "policy_title"      => $policy_title,
                        "policy_desc"       => $policy_desc,
                        "policy_metaTitle"  => $policy_metaTitle,
                        "policy_metaDesc"   => $policy_metaDesc,
                        "policy_status"     => $policy_status,
                        "policy_seoUrl"     => $policy_seoUrl,
                        "policy_order"      => $policy_order,
                        "policy_createDate" => $policy_createDate,
                        "policy_creatorId"  => $policy_creatorId
                    ];

                    $idPolicy = $this->PolicyModel->addPolicyNew($dataPolicy);
                    if(is_int($idPolicy)) {
                        $statusActionPolicy = [
                            "status"    => "success",
                            "notifiTxt" => "Thêm chính sách thành công"
                        ];
                    } else {
                        $statusActionPolicy = [
                            "status"    => "error",
                            "notifiTxt" => "Thêm chính sách không thành công"
                        ];
                    }
                } else {
                    $statusActionPolicy = [
                        "status"    => "error",
                        "notifiTxt" => "Chính sách đã tồn tại [ ERROR: Trùng tên chính sách ]"
                    ];
                }
            } else {
                $statusActionPolicy = [
                    "status"    => "error",
                    "notifiTxt" => "Một số thông tin bạn chưa hoàn thành hoặc không đúng kiểu dữ liệu"
                ];
            }

        }

        $dataView = [
            "title"  => "Thêm chính sách",
            "layOut" => "AddPolicy",
            "css"    => ["home","fancybox.min"],
            "data"   => [
                "statusActionPolicy" =>  !empty($statusActionPolicy) ? $statusActionPolicy : null,
            ]
        ];

        $this->view("MasterIndex", $dataView);
    }

    public function update($policy_id = 0)
    {
        $policy_id  = (!empty($policy_id)) ? (int) $policy_id : 1;
        $policyItem = $this->PolicyModel->getPolicyItemById($policy_id);

        /*
        * ------------------------------
        * ----- Handle update news -----
        * ------------------------------
        */

        if(isset($_POST['updatePolicy_action'])) {
            $error = [];
            global $error;

            /*
            * --- check policy status
            */

            $policy_status = !empty($_POST['policy_status']) ? "on" : "off";

            /*
            * --- check policy title
            */

            if(empty($_POST['policy_title'])) {
                $error['policy_title'] = "<span class='error'>(*) Bạn vui lòng nhập tiêu đề</span>";
            } else {
                $policy_title = $_POST['policy_title'];
            }

            /*
            * --- check policy desc
            */

            if(empty($_POST['policy_desc'])) {
                $error['policy_desc'] = "<span class='error'>(*) Bạn vui lòng nhập mô tả</span>";
            } else {
                $policy_desc = $_POST['policy_desc'];
            }

            /*
            * --- check policy meta title
            */

            if(empty($_POST['policy_metaTitle'])) {
                $error['policy_metaTitle'] = "<span class='error'>(*) Bạn vui lòng nhập meta title</span>";
            } else {
                $policy_metaTitle = $_POST['policy_metaTitle'];
            }

            /*
            * --- check policy meta desc
            */

            if(empty($_POST['policy_metaDesc'])) {
                $error['policy_metaDesc'] = "<span class='error'>(*) Bạn vui lòng nhập meta description</span>";
            } else {
                $policy_metaDesc = $_POST['policy_metaDesc'];
            }

            /*
            * --- check policy meta seo url
            */

            if(empty($_POST['policy_seoUrl'])) {
                $error['policy_seoUrl'] = "<span class='error'>(*) Bạn vui lòng nhập đường dẫn seo</span>";
            } else {
                $policy_seoUrl = $_POST['policy_seoUrl'];
            }

            /*
            * --- check policy meta order
            */

            $policy_order = !empty($_POST['policy_order']) ? (int) $_POST['policy_order'] : 0;

            /*
            * --- check policy error
            */

            if(empty($error)) {
                $policy_updateDate = time();
                $dataPolicy = [
                    "policy_title"      => $policy_title,
                    "policy_desc"       => $policy_desc,
                    "policy_metaTitle"  => $policy_metaTitle,
                    "policy_metaDesc"   => $policy_metaDesc,
                    "policy_status"     => $policy_status,
                    "policy_seoUrl"     => $policy_seoUrl,
                    "policy_order"      => $policy_order,
                    "policy_updateDate" => $policy_updateDate,
                ];

                $process = $this->PolicyModel->updatePolicy($dataPolicy, $policy_id);
                if($process) {
                    $statusActionPolicy = [
                        "status"    => "success",
                        "notifiTxt" => "Cập nhật chính sách thành công"
                    ];
                } else {
                    $statusActionPolicy = [
                        "status"    => "error",
                        "notifiTxt" => "Cập nhật chính sách không thành công"
                    ];
                }
            } else {
                $statusActionPolicy = [
                    "status"    => "error",
                    "notifiTxt" => "Một số thông tin bạn chưa hoàn thành hoặc không đúng kiểu dữ liệu"
                ];
            }

        }

        $dataView = [
            "title"  => "Cập nhật chính sách",
            "layOut" => "UpdatePolicy",
            "css"    => ["home","fancybox.min"],
            "data"   => [
                "policyItem"         => !empty($policyItem) ? $policyItem : null,
                "statusActionPolicy" => !empty($statusActionPolicy) ? $statusActionPolicy : null
            ]
        ];
        $this->view("MasterIndex", $dataView);
    }

    public function changeStatus()
    {
        $policy_id  = (int)$_POST['policy_id'];
        $statusChange = Format::validation($_POST['statusChange']);
        $dataPolicy = [
            "policy_status" => $statusChange
        ];
        $process = $this->PolicyModel->updatePolicy($dataPolicy, $policy_id);
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
        $policy_id = $_POST['policy_id'];
        $process = $this->PolicyModel->deletePolicy($policy_id);
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
        $listPolicyId = $_POST['listPolicyId'];
        $policyIdDeleteError   = [];
        foreach($listPolicyId as $policyIdItem) {
            $idPolicy = (int) $policyIdItem;
            $process    = $this->PolicyModel->deletePolicy($idPolicy);
            if(!$process) {
                $policyIdDeleteError[] = $policyIdItem;
            }
        }
        if(!empty($policyIdDeleteError)) {
            $dataAjax = [
                "status"            => "error",
                "listIdCantDeleted" => $policyIdDeleteError
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
        $listPolicyId = $_POST['listPolicyId'];
        $statusChange  = $_POST['statusChange'];
        $policyIdUpdateError = [];
        foreach($listPolicyId as $policyIdItem) {
            $idPolicy   = (int) $policyIdItem;
            $dataPolicy = [
                "policy_status" => $statusChange
            ];
            $process = $this->PolicyModel->updatePolicy($dataPolicy, $idPolicy);
            if(!$process) {
                $policyIdUpdateError[] = $policyIdItem;
            }
        }
        if(!empty($policyIdUpdateError)) {
            $dataAjax = [
                "status"            => "error",
                "policyIdUpdateError" => $policyIdUpdateError
            ];
        } else {
            $dataAjax = [
                "status" => "success"
            ];
        }
        echo json_encode($dataAjax);
    }

    public function getAllPolicy()
    {
        $dataAjax = [
            "listPolicy" => $this->PolicyModel->getListPolicyByStatus("all")
        ];
        echo json_encode($dataAjax);
    }

    public function recommentSearch()
    {
        $vlSearch = $_POST['vlSearch'];
        $result   = $this->PolicyModel->searchPolicyByName($vlSearch);
        $dataAjax = [
            "searchData" => $result
        ];
        echo json_encode($dataAjax);
    }
}
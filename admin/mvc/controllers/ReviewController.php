<?php
class ReviewController extends Controller
{
    public $ReviewModel;
    public $ProductModel;

    function __construct()
    {
        $this->ReviewModel  = $this->model("Review");
        $this->ProductModel = $this->model("Product");
    }

    public function index($orderBy = 'desc', $status = 'all', $page = 1, $fieldName = 'review_customerFullname', $strSearch = '')
    {
        if(!empty($strSearch)) {
            $strSearch = Format::validationSearch($strSearch);
            if($fieldName == "prod_name") {
                $prodItem   = $this->ProductModel->getProdItemByField($fieldName, $strSearch);
                $fieldName  = "review_prodId_ties";
                $prod_id    = $prodItem['prod_id'];
                $listReview = [];
                $listTotalReview = $this->ReviewModel->getListReviewByStatus("all");
                foreach($listTotalReview as $reviewItem) {
                    if($reviewItem['review_prodId_ties'] == $prod_id) {
                        $listReview[] = $reviewItem;
                    }
                }
            } else {
                $listReview = $this->ReviewModel->searchRecommentByFile($fieldName, $strSearch);
            }
        } else {
            $orderByAllow  = ["asc","desc"];
            $statusAllow   = ["all","on","off"];
            $orderBy       = in_array($orderBy,$orderByAllow) ? $orderBy : "asc";
            $status        = in_array($status,$statusAllow)   ? $status  : "all";
            $page          = $page >= 1 ? $page : 1;
            $numPerPage    = 10;
            $totalReview   = count($this->ReviewModel->getListReviewByStatus($status));
            $totalPage     = ceil($totalReview / $numPerPage);
            $pageStart     = ($page - 1) * $numPerPage;
            $listReview    = $this->ReviewModel->getListReviewByPagination($orderBy, $status, $pageStart, $numPerPage);
        }

        if(!empty($listReview)) {
            foreach($listReview as &$reviewItem) {
                $reviewItem['review_product_name'] = $this->ProductModel->getProdItemById($reviewItem['review_prodId_ties'])['prod_name'];
            }
        }

        $dataView = [
            "title"  => "Danh sách review",
            "layOut" => "ListReview",
            "css"    => ["home"],
            "data"   => [
                "orderBy"      => !empty($orderBy)     ? $orderBy : null,
                "status"       => !empty($status)      ? $status : null,
                "page"         => !empty($page)        ? $page : null,
                "listReview"   => !empty($listReview)  ? $listReview : null,
                "numPerPage"   => !empty($numPerPage)  ? $numPerPage : null,
                "totalPage"    => !empty($totalPage)   ? $totalPage : null,
                "strSearch"    => !empty($strSearch)   ? $strSearch : null,
                "totalReview"  => !empty($totalReview) ? $totalReview : count($listReview),
            ]
        ];

        $this->view("MasterIndex", $dataView);
    }

    public function add()
    {

        if(isset($_POST['addReview_action'])) {
            $error = [];
            global $error;

            /*
            * --- check review status
            */

            $review_status = !empty($_POST['review_status']) ? "on" : "off";

            /*
            * --- check review customer fullname
            */

            if(empty($_POST['review_customerFullname'])) {
                $error['review_customerFullname'] = "<span class='error'>(*) Vui lòng nhập tên khách hàng</span>";
            } else {
                $review_customerFullname = $_POST['review_customerFullname'];
            }

            /*
            * --- check review prod ties
            */

            if(empty($_POST['prodId'])) {
                $error['prodId'] = "<span class='error'>(*) Vui lòng chọn ít nhất 1 sản phẩm</span>";
            } else {
                $review_prodId_ties = $_POST['prodId'][0];
            }

            /*
            * --- check review content
            */

            if(empty($_POST['review_content'])) {
                $error['review_content'] = "<span class='error'>(*) Vui lòng nhập nội dung review</span>";
            } else {
                $review_content = $_POST['review_content'];
            }

            /*
            * --- check review purchased
            */

            $purchased = !empty($_POST['purchased']) ? "1" : "0";

            /*
            * --- check review rating
            */

            if(empty($_POST['rating'])) {
                $error['rating'] = "<span class='error'>(*) Vui lòng chọn mức độ</span>";
            } else {
                $review_rating = $_POST['rating'][0];
            }

            if(empty($_POST['review_createDate'])) {
                $error['review_createDate'] = "<span class='error'>(*) Vui lòng chọn thời gian review</span>";
            } else {
                if( strtotime($_POST['review_createDate']) > time() ) {
                    $error['review_createDate'] = "<span class='error'>(*) Ngày review không hợp lệ</span>";
                } else {
                    $review_createDate = strtotime($_POST['review_createDate']);
                }
            }

            $list_review_img = [];
            if(!empty($_POST['reviewImg'])) {
                foreach($_POST['reviewImg'] as $reviewImgItem) {
                    if(!empty($reviewImgItem)) {
                        $list_review_img[] = $reviewImgItem;
                    }
                }
            }

            $_POST['reviewImg'] = $list_review_img;

            /*
            * --- check review error
            */

            if(empty($error)) {
                if(!($this->ReviewModel->checkReviewExist($review_customerFullname, $review_prodId_ties, $review_content, $review_createDate))) {
                    $dataReview = [
                        "review_customerFullname" => $review_customerFullname,
                        "review_prodId_ties"      => $review_prodId_ties,
                        "review_content"          => $review_content,
                        "purchased"               => $purchased,
                        "review_rating"           => $review_rating,
                        "review_createDate"       => $review_createDate,
                        "review_status"           => $review_status
                    ];

                    $idReview = $this->ReviewModel->addReviewNew($dataReview);

                    if(is_int($idReview)) {
                        if(!empty($list_review_img)) {
                            foreach($list_review_img as $review_img_item) {
                                $dataReviewImg = [
                                    "review_img_src" => $review_img_item,
                                    "review_img_reviewId_ties" => $idReview
                                ];
                                $this->ReviewModel->addReviewImgNew($dataReviewImg);
                            }
                        }
                        $statusActionReview = [
                            "status"    => "success",
                            "notifiTxt" => "Thêm review thành công"
                        ];
                    } else {
                        $statusActionReview = [
                            "status"    => "error",
                            "notifiTxt" => "Thêm review không thành công"
                        ];
                    }
                } else {
                    $statusActionReview = [
                        "status"    => "error",
                        "notifiTxt" => "Review này đã tồn tại [ trùng tên khách hàng, sản phẩm, nội dung, ngày thêm ]"
                    ];
                }
            } else {
                $statusActionReview = [
                    "status"    => "error",
                    "notifiTxt" => "Một số thông tin bạn chưa hoàn thành hoặc không đúng kiểu dữ liệu"
                ];
            }
        }

        $dataView = [
            "title"  => "Thêm đánh giá",
            "layOut" => "addReview",
            "css"    => ["home","fancybox.min"],
            "data"   => [
                "statusActionReview" => !empty($statusActionReview) ? $statusActionReview : null,
                "listProd"           => !empty($this->ProductModel->getListProdByStatus("all")) ? $this->ProductModel->getListProdByStatus("all") : null,
            ]
        ];
        $this->view("MasterIndex", $dataView);
    }

    public function update($review_id = 0)
    {
        $review_id  = (!empty($review_id)) ? (int) $review_id : 0;
        $reviewItem = $this->ReviewModel->getReviewItemById($review_id);


        /*
        * ------------------------------
        * ----- Handle update news -----
        * ------------------------------
        */

        if(isset($_POST['updateReview_action'])) {
            $error = [];
            global $error;

            /*
            * --- check review status
            */

            $review_status = !empty($_POST['review_status']) ? "on" : "off";

            /*
            * --- check review customer fullname
            */

            if(empty($_POST['review_customerFullname'])) {
                $error['review_customerFullname'] = "<span class='error'>(*) Vui lòng nhập tên khách hàng</span>";
            } else {
                $review_customerFullname = $_POST['review_customerFullname'];
            }

            /*
            * --- check review prod ties
            */

            if(empty($_POST['prodId'])) {
                $error['prodId'] = "<span class='error'>(*) Vui lòng chọn ít nhất 1 sản phẩm</span>";
            } else {
                $review_prodId_ties = $_POST['prodId'][0];
            }

            /*
            * --- check review content
            */

            if(empty($_POST['review_content'])) {
                $error['review_content'] = "<span class='error'>(*) Vui lòng nhập nội dung review</span>";
            } else {
                $review_content = $_POST['review_content'];
            }

            /*
            * --- check review purchased
            */

            if(!empty($_POST['purchased'])) {
                $purchased = $_POST['purchased'] == "1" ? "1" : "2";
            } else {
                $purchased = "2";
            }

            $_POST['purchased'] = $purchased;

            /*
            * --- check review rating
            */

            if(empty($_POST['rating'])) {
                $error['rating'] = "<span class='error'>(*) Vui lòng chọn mức độ</span>";
            } else {
                $review_rating = $_POST['rating'][0];
            }

            if(empty($_POST['review_createDate'])) {
                $error['review_createDate'] = "<span class='error'>(*) Vui lòng chọn thời gian review</span>";
            } else {
                if( strtotime($_POST['review_createDate']) > time() ) {
                    $error['review_createDate'] = "<span class='error'>(*) Ngày review không hợp lệ</span>";
                } else {
                    $review_createDate = strtotime($_POST['review_createDate']);
                }
            }

            $list_review_img = [];
            if(!empty($_POST['reviewImg'])) {
                foreach($_POST['reviewImg'] as $reviewImgItem) {
                    if(!empty($reviewImgItem)) {
                        $list_review_img[] = $reviewImgItem;
                    }
                }
            }

            $_POST['reviewImg'] = $list_review_img;

            /*
            * --- check review error
            */

            if(empty($error)) {
                $dataReview = [
                    "review_customerFullname" => $review_customerFullname,
                    "review_prodId_ties"      => $review_prodId_ties,
                    "review_content"          => $review_content,
                    "review_rating"           => $review_rating,
                    "purchased"               => $purchased,
                    "review_createDate"       => $review_createDate,
                    "review_status"           => $review_status
                ];

                $process = $this->ReviewModel->updateReview($dataReview, $review_id);

                if($process) {
                    $this->ReviewModel->deleteTotalImgReviewByIdReView($review_id);
                    if(!empty($list_review_img)) {
                        foreach($list_review_img as $review_img_item) {
                            $dataReviewImg = [
                                "review_img_src" => $review_img_item,
                                "review_img_reviewId_ties" => $review_id
                            ];
                            $this->ReviewModel->addReviewImgNew($dataReviewImg);
                        }
                    }
                    $statusActionReview = [
                        "status"    => "success",
                        "notifiTxt" => "Cập nhật review thành công"
                    ];
                } else {
                    $statusActionReview = [
                        "status"    => "error",
                        "notifiTxt" => "Cập nhật review không thành công"
                    ];
                }
            } else {
                $statusActionReview = [
                    "status"    => "error",
                    "notifiTxt" => "Một số thông tin bạn chưa hoàn thành hoặc không đúng kiểu dữ liệu"
                ];
            }
        }

        $dataView = [
            "title"  => "Cập nhật review",
            "layOut" => "UpdateReview",
            "css"    => ["home","fancybox.min"],
            "data"   => [
                "reviewItem"         => !empty($reviewItem) ? $reviewItem : null,
                "listImgReview"      => !empty($this->ReviewModel->getListImgReviewByIdReview($review_id)) ? $this->ReviewModel->getListImgReviewByIdReview($review_id) : null,
                "listProd"           => !empty($this->ProductModel->getListProdByStatus("all")) ? $this->ProductModel->getListProdByStatus("all") : null,
                "statusActionReview" => !empty($statusActionReview) ? $statusActionReview : null
            ]
        ];

        $this->view("MasterIndex", $dataView);

    }

    public function changeStatus()
    {
        $review_id  = (int)$_POST['review_id'];
        $statusChange = Format::validation($_POST['statusChange']);
        $dataReview = [
            "review_status" => $statusChange
        ];
        $process = $this->ReviewModel->updateReview($dataReview, $review_id);
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
        $review_id = $_POST['review_id'];
        $process = $this->ReviewModel->deleteReview($review_id);
        if($process) {
            $this->ReviewModel->deleteTotalImgReviewByIdReView($review_id);
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
        $listReviewId = $_POST['listReviewId'];
        $reviewIdDeleteError   = [];
        foreach($listReviewId as $reviewIdItem) {
            $idReview = (int) $reviewIdItem;
            $process    = $this->ReviewModel->deleteReview($idReview);
            if(!$process) {
                $reviewIdDeleteError[] = $reviewIdItem;
            } else {
                $this->ReviewModel->deleteTotalImgReviewByIdReView($idReview);
            }
        }
        if(!empty($reviewIdDeleteError)) {
            $dataAjax = [
                "status"            => "error",
                "listIdCantDeleted" => $reviewIdDeleteError
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
        $listReviewId   = $_POST['listReviewId'];
        $statusChange = $_POST['statusChange'];
        $reviewIdUpdateError = [];
        foreach($listReviewId as $reviewIdItem) {
            $idReview   = (int) $reviewIdItem;
            $dataReview = [
                "review_status" => $statusChange
            ];
            $process = $this->ReviewModel->updateReview($dataReview, $idReview);
            if(!$process) {
                $reviewIdUpdateError[] = $reviewIdItem;
            }
        }
        if(!empty($reviewIdUpdateError)) {
            $dataAjax = [
                "status"            => "error",
                "reviewIdUpdateError" => $reviewIdUpdateError
            ];
        } else {
            $dataAjax = [
                "status" => "success"
            ];
        }
        echo json_encode($dataAjax);
    }

    public function loadReviewByField()
    {
        $fieldName = $_POST['fieldName'];
        $dataAjax = [
            "listData" => $this->ReviewModel->loadReviewByField($fieldName)
        ];
        echo json_encode($dataAjax);
    }

    public function searchRecommentByFile()
    {
        $searchValue = $_POST['searchValue'];
        $fieldName   = $_POST['fieldName'];
        $dataAjax = [
            "searchData" => $this->ReviewModel->searchRecommentByFile($fieldName, $searchValue)
        ];
        echo json_encode($dataAjax);
    }
}
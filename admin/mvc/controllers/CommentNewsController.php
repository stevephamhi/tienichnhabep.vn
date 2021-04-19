<?php

class CommentNewsController extends Controller
{
    protected $CommentNewsModel;
    protected $NewsModel;

    function __construct()
    {
        $this->CommentNewsModel = $this->model("CommentNews");
        $this->NewsModel        = $this->model("News");
    }

    public function index($orderBy = 'desc', $status = 'all', $page = 1, $fieldName = 'commentnews_customerFullname', $strSearch = '')
    {
        if(!empty($strSearch)) {
            $strSearch = Format::validationSearch($strSearch);
            if($fieldName == "news_name") {
                $newsItem = $this->NewsModel->getNewsItemByField($fieldName, $strSearch);
                $fieldName = "commentnews_newsId_ties";
                $news_id   = $newsItem['news_id'];
                $listCommentNews = [];
                $listTotalCommentNews = $this->CommentNewsModel->getListCommentNewsByStatus("all");
                foreach($listTotalCommentNews as &$commentnewsItem) {
                    if($commentnewsItem['commentnews_newsId_ties'] == $news_id) {
                        $listCommentNews[] = $commentnewsItem;
                    }
                }
            } else {
                $listCommentNews = $this->CommentNewsModel->searchRecommentByFile($fieldName, $strSearch);
            }
        } else {
            $orderByAllow         = ["asc","desc"];
            $statusAllow          = ["all","on","off"];
            $orderBy              = in_array($orderBy,$orderByAllow) ? $orderBy : "asc";
            $status               = in_array($status,$statusAllow)   ? $status  : "all";
            $page                 = $page >= 1 ? $page : 1;
            $numPerPage           = 10;
            $listTotalCommentNews = count($this->CommentNewsModel->getListCommentNewsByStatus($status));
            $totalPage            = ceil($listTotalCommentNews / $numPerPage);
            $pageStart            = ($page - 1) * $numPerPage;
            $listCommentNews      = $this->CommentNewsModel->getListCommentNewsByPagination($orderBy, $status, $pageStart, $numPerPage);
        }

        if(!empty($listCommentNews)) {
            foreach($listCommentNews as &$commentNewsItem) {
                $commentNewsItem['commentnews_news_name'] = $this->NewsModel->getNewsItemById($commentNewsItem['commentnews_newsId_ties'])['news_name'];
            }
        }

        $dataView = [
            "title"  => "Danh sách bình luận bài viết",
            "layOut" => "ListCommentNews",
            "css"    => ["home"],
            "data"   => [
                "page"             => !empty($page) ? $page : null,
                "status"           => !empty($status) ? $status : null,
                "orderBy"          => !empty($orderBy) ? $orderBy : null,
                "totalPage"        => !empty($totalPage) ? $totalPage : null,
                "strSearch"        => !empty($strSearch) ? $strSearch : null,
                "numPerPage"       => !empty($numPerPage) ? $numPerPage : null,
                "listCommentNews"  => !empty($listCommentNews) ? $listCommentNews : null,
                "totalCommentNews" => !empty($listTotalCommentNews) ? $listTotalCommentNews : count($listCommentNews),
                "fieldName"        => !empty($fieldName) ? $fieldName : null
            ]
        ];

        $this->view("MasterIndex", $dataView);

    }

    public function add()
    {

        if(isset($_POST['addCommentNews_action'])) {
            $error = [];
            global $error;

            /*
            * --- check commtent news status
            */

            $commentnews_status = !empty($_POST['commentnews_status']) ? "on" : "off";

            /*
            * --- check commtent news customer fullname
            */

            if(empty($_POST['commentnews_customerFullname'])) {
                $error['commentnews_customerFullname'] = "<span class='error'>(*) Vui lòng nhập tên khách hàng</span>";
            } else {
                $commentnews_customerFullname = $_POST['commentnews_customerFullname'];
            }

            /*
            * --- check commtent news ties news id
            */

            if(empty($_POST['newsId'])) {
                $error['newsId'] = "<span class='error'>(*) Vui lòng chọn bài viết comment</span>";
            } else {
                $commentnews_newsId_ties = $_POST['newsId'][0];
            }

            /*
            * --- check commtent comment
            */

            if(empty($_POST['commentnews_content'])) {
                $error['commentnews_content'] = "<span class='error'>(*) Vui lòng viết nội dung của comment</span>";
            } else {
                $commentnews_content = $_POST['commentnews_content'];
            }

            /*
            * --- check commtent create date
            */

            if(empty($_POST['commentnews_createDate'])) {
                $error['commentnews_createDate'] = "<span class='error'>(*) Vui lòng chọn ngày comment</span>";
            } else {
                if(strtotime($_POST['commentnews_createDate']) > time()) {
                    $error['commentnews_createDate'] = "<span class='error'>(*) Ngày comment không hợp lệ</span>";
                } else {
                    $commentnews_createDate = strtotime($_POST['commentnews_createDate']);
                }
            }

            /*
            * --- check commtent error
            */

            if(empty($error)) {
                if(!($this->CommentNewsModel->checkCommentNewsExist($commentnews_customerFullname, $commentnews_newsId_ties, $commentnews_content, $commentnews_createDate))) {
                    $dataCommentNews = [
                        "commentnews_customerFullname" => $commentnews_customerFullname,
                        "commentnews_newsId_ties"      => $commentnews_newsId_ties,
                        "commentnews_content"          => $commentnews_content,
                        "commentnews_createDate"       => $commentnews_createDate,
                        "commentnews_status"           => $commentnews_status
                    ];

                    $idCommentNews = $this->CommentNewsModel->addCommentNewsNew($dataCommentNews);

                    if(is_int($idCommentNews)) {
                        $statusActionCommentNews = [
                            "status"    => "success",
                            "notifiTxt" => "Thêm Comment bài viết thành công"
                        ];
                    } else {
                        $statusActionCommentNews = [
                            "status"    => "success",
                            "notifiTxt" => "Thêm Comment bài viết không thành công"
                        ];
                    }

                } else {
                    $statusActionCommentNews = [
                        "status"    => "error",
                        "notifiTxt" => "Comment bài viết này đã tồn tại"
                    ];
                }
            } else {
                $statusActionCommentNews = [
                    "status"    => "error",
                    "notifiTxt" => "Một số thông tin bạn chưa hoàn thành hoặc không đúng kiểu dữ liệu"
                ];
            }

        }

        $dataView = [
            "title"  => "Thêm comment tin tức",
            "layOut" => "AddCommentNews",
            "css"    => ["home","fancybox.min"],
            "data"   => [
                "statusActionCommentNews" => $statusActionCommentNews ?? null,
                "listNews"                => $this->NewsModel->getListNewsByStatus("all") ?? null,
            ]
        ];
        $this->view("MasterIndex", $dataView);
    }

    public function update($commentnews_id = 0)
    {
        $commentnews_id  = (!empty($commentnews_id)) ? (int) $commentnews_id : 0;
        $commentnewsItem = $this->CommentNewsModel->getCommentNewsItemById($commentnews_id);

        /*
        * -------------------------------------
        * ----- Handle update commentnews -----
        * -------------------------------------
        */

        if(isset($_POST['updateCommentNews_action'])) {
            $error = [];
            global $error;

            /*
            * --- check commtent news status
            */

            $commentnews_status = !empty($_POST['commentnews_status']) ? "on" : "off";

            /*
            * --- check commtent news customer fullname
            */

            if(empty($_POST['commentnews_customerFullname'])) {
                $error['commentnews_customerFullname'] = "<span class='error'>(*) Vui lòng nhập tên khách hàng</span>";
            } else {
                $commentnews_customerFullname = $_POST['commentnews_customerFullname'];
            }

            /*
            * --- check commtent news ties news id
            */

            if(empty($_POST['newsId'])) {
                $error['newsId'] = "<span class='error'>(*) Vui lòng chọn bài viết comment</span>";
            } else {
                $commentnews_newsId_ties = $_POST['newsId'][0];
            }

            /*
            * --- check commtent comment
            */

            if(empty($_POST['commentnews_content'])) {
                $error['commentnews_content'] = "<span class='error'>(*) Vui lòng viết nội dung của comment</span>";
            } else {
                $commentnews_content = $_POST['commentnews_content'];
            }

            /*
            * --- check commtent create date
            */

            if(empty($_POST['commentnews_createDate'])) {
                $error['commentnews_createDate'] = "<span class='error'>(*) Vui lòng chọn ngày comment</span>";
            } else {
                if(strtotime($_POST['commentnews_createDate']) > time()) {
                    $error['commentnews_createDate'] = "<span class='error'>(*) Ngày comment không hợp lệ</span>";
                } else {
                    $commentnews_createDate = $_POST['commentnews_createDate'];
                }
            }

            /*
            * --- check commtent error
            */

            if(empty($error)) {
                $dataCommentNews = [
                    "commentnews_customerFullname" => $commentnews_customerFullname,
                    "commentnews_newsId_ties"      => $commentnews_newsId_ties,
                    "commentnews_content"          => $commentnews_content,
                    "commentnews_createDate"       => $commentnews_createDate,
                    "commentnews_status"           => $commentnews_status
                ];

                $process = $this->CommentNewsModel->updateCommentNews($dataCommentNews, $commentnews_id);

                if($process) {
                    $statusActionCommentNews = [
                        "status"    => "success",
                        "notifiTxt" => "Cập nhật Comment bài viết thành công"
                    ];
                } else {
                    $statusActionCommentNews = [
                        "status"    => "success",
                        "notifiTxt" => "Cập nhật Comment bài viết không thành công"
                    ];
                }
            } else {
                $statusActionCommentNews = [
                    "status"    => "error",
                    "notifiTxt" => "Một số thông tin bạn chưa hoàn thành hoặc không đúng kiểu dữ liệu"
                ];
            }
        }

        $dataView = [
            "title"  => "Cập nhật comment tin",
            "layOut" => "UpdateCommentNews",
            "css"    => ["home","fancybox.min"],
            "data"   => [
                "commentnewsItem"         => !empty($commentnewsItem) ? $commentnewsItem : null,
                "listNews"                => !empty($this->NewsModel->getListNewsByStatus("all")) ? $this->NewsModel->getListNewsByStatus("all") : null,
                "statusActionCommentNews" => !empty($statusActionCommentNews) ? $statusActionCommentNews : null
            ]
        ];

        $this->view("MasterIndex", $dataView);
    }

    public function changeStatus()
    {
        $commentnews_id  = (int)$_POST['commentnews_id'];
        $statusChange = Format::validation($_POST['statusChange']);
        $dataCommentNews = [
            "commentnews_status" => $statusChange
        ];
        $process = $this->CommentNewsModel->updateCommentNews($dataCommentNews, $commentnews_id);
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
        $commentnews_id = $_POST['commentnews_id'];
        $process = $this->CommentNewsModel->deletecommentNews($commentnews_id);
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
        $listCommentnewsId = $_POST['listCommentnewsId'];
        $commentNewsIdDeleteError   = [];
        foreach($listCommentnewsId as $commentnewsIdItem) {
            $idCommentNews = (int) $commentnewsIdItem;
            $process    = $this->CommentNewsModel->deletecommentNews($idCommentNews);
            if(!$process) {
                $commentNewsIdDeleteError[] = $commentnewsIdItem;
            }
        }
        if(!empty($commentNewsIdDeleteError)) {
            $dataAjax = [
                "status"                   => "error",
                "commentNewsIdDeleteError" => $commentNewsIdDeleteError
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
        $listCommentnewsId   = $_POST['listCommentnewsId'];
        $statusChange = $_POST['statusChange'];
        $commentNewsIdUpdateError = [];
        foreach($listCommentnewsId as $commentnewsIdItem) {
            $idCommentnews   = (int) $commentnewsIdItem;
            $dataCommentNews = [
                "commentnews_status" => $statusChange
            ];
            $process = $this->CommentNewsModel->updateCommentNews($dataCommentNews, $idCommentnews);
            if(!$process) {
                $commentNewsIdUpdateError[] = $commentnewsIdItem;
            }
        }
        if(!empty($commentNewsIdUpdateError)) {
            $dataAjax = [
                "status"                   => "error",
                "commentNewsIdUpdateError" => $commentNewsIdUpdateError
            ];
        } else {
            $dataAjax = [
                "status" => "success"
            ];
        }
        echo json_encode($dataAjax);
    }

    public function loadCommentNewsByField()
    {
        $fieldName = $_POST['fieldName'];
        $dataAjax = [
            "listData" => $this->CommentNewsModel->loadCommentNewsByField($fieldName)
        ];
        echo json_encode($dataAjax);
    }

    public function searchRecommentByFile()
    {
        $searchValue = $_POST['searchValue'];
        $fieldName   = $_POST['fieldName'];
        $dataAjax = [
            "searchData" => $this->CommentNewsModel->searchRecommentByFile($fieldName, $searchValue)
        ];
        echo json_encode($dataAjax);
    }
}
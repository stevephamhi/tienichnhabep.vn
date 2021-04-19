<?php
class NewsController extends Controller
{
    protected $CateNewsModel;
    protected $NewsModel;

    function __construct()
    {
        $this->CateNewsModel = $this->model('CateNews');
        $this->NewsModel     = $this->model('News');
    }

    public function index($orderBy = 'desc', $status = 'all', $page = 1, $strSearch = '')
    {
        if(!empty($strSearch)) {
            $strSearch = Format::validationSearch($strSearch);
            $listNews = !empty($this->NewsModel->searchNewsByName($strSearch)) ? $this->NewsModel->searchNewsByName($strSearch) : null;
        } else {
            $orderByAllow  = ["asc","desc"];
            $statusAllow   = ["all","on","off"];
            $orderBy       = in_array($orderBy,$orderByAllow) ? $orderBy : "asc";
            $status        = in_array($status,$statusAllow)   ? $status  : "all";
            $page          = $page >= 1 ? $page : 1;
            $numPerPage    = 10;
            $totalNews     = count($this->NewsModel->getListNewsByStatus($status));
            $totalPage     = ceil($totalNews / $numPerPage);
            $pageStart     = ($page - 1) * $numPerPage;
            $listNews      = $this->NewsModel->getListNewsByPagination($orderBy, $status, $pageStart, $numPerPage);
        }
        $dataView = [
            "title"  => "Danh sách tin tức",
            "layOut" => "ListNews",
            "css"    => ["home"],
            "data"   => [
                "orderBy"    => !empty($orderBy)    ? $orderBy    : null,
                "status"     => !empty($status)     ? $status     : null,
                "page"       => !empty($page)       ? $page       : null,
                "listNews"   => !empty($listNews)   ? $listNews   : null,
                "numPerPage" => !empty($numPerPage) ? $numPerPage : null,
                "totalPage"  => !empty($totalPage)  ? $totalPage  : null,
                "strSearch"  => !empty($strSearch)  ? $strSearch  : null,
                "totalNews"  => !empty($totalNews)  ? $totalNews  : count($listNews),
            ]
        ];
        $this->view("MasterIndex", $dataView);
    }

    public function add()
    {

        $helper = new Helper;
        if(isset($_POST['addNews_action'])) {
            $error = [];
            global $error;

            /*
            * --- check news status
            */

            $news_status = !empty($_POST['news_status']) ? 'on' : 'off';

            /*
            * --- check news name
            */

            if(empty($_POST['news_name'])) {
                $error['news_name'] = "<span class='error'>(*) Vui lòng nhập tên tin tức</span>";
            } else {
                $news_name = Format::validation($_POST['news_name']);
            }

            /*
            * --- check news desc
            */

            if(empty($_POST['news_desc'])) {
                $error['news_desc'] = "<span class='error'>(*) Vui lòng nhập mô tả tin tức</span>";
            } else {
                $news_desc = Format::validation($_POST['news_desc']);
            }

            /*
            * --- check news content
            */

            if(empty($_POST['news_content'])) {
                $error['news_content'] = "<span class='error'>(*) Vui lòng nhập nội dung tin tức</span>";
            } else {
                $news_content = $_POST['news_desc'];
            }

            /*
            * --- check news meta title
            */

            if(empty($_POST['news_metaTitle'])) {
                $error['news_metaTitle'] = "<span class='error'>(*) Vui lòng nhập meta title</span>";
            } else {
                $news_metaTitle = Format::validation($_POST['news_metaTitle']);
            }

            /*
            * --- check news meta desc
            */

            if(empty($_POST['news_metaDesc'])) {
                $error['news_metaDesc'] = "<span class='error'>(*) Vui lòng nhập meta description</span>";
            } else {
                $news_metaDesc = Format::validation($_POST['news_metaDesc']);
            }

            /*
            * --- check news key words
            */

            $news_keywords = !empty($_POST['news_keywords']) ? Format::validation($_POST['news_keywords']) : null;

            /*
            * --- check news seo url
            */

            if(empty($_POST['news_seoUrl'])) {
                $error['news_seoUrl'] = "<span class='error'>(*) Vui lòng nhập đường dẫn seo url</span>";
            } else {
                $news_seoUrl = Format::validation($_POST['news_seoUrl']);
            }

            /*
            * --- check news image
            */

            if(empty($_POST['news_image'])) {
                $error['news_image'] = "<span class='error'>(*) Vui lòng chọn ảnh cho tin tức</span>";
            } else {
                $news_image = $_POST['news_image'];
            }

            /*
            * --- check news banner PC
            */

            $news_bannerPc = !empty($_POST['news_bannerPc']) ? $_POST['news_bannerPc'] : null;

            /*
            * --- check news banner Mb
            */

            $news_bannerMb = !empty($_POST['news_bannerMb']) ? $_POST['news_bannerMb'] : null;

            /*
            * --- check news news_video
            */

            $_POST['news_video'] = !empty($_POST['news_video']) ? htmlentities($_POST['news_video']) : null;
            $news_video = $_POST['news_video'];

            /*
            * --- check news news_target
            */

            $news_target = $_POST['news_target'];

            /*
            * --- check news news_order
            */

            $news_order = !empty($_POST['news_order']) ? (int)$_POST['news_order'] : ($this->NewsModel->getOrderMaxPlus());

            /*
            * --- check news ties cateNews
            */


            if(empty($_POST['cateNewsId'])) {
                $error['cateNewsId'] = "<span class='error'>(*) Vui lòng chọn danh mục cha cho tin tức</span>";
            } else {
                $news_listId_cateNews_ties = json_encode($_POST['cateNewsId']);
            }

            /*
            * --- check news views
            */

            $news_views = !empty($_POST['news_views']) ? $_POST['news_views'] : 0;

            /*
            * --- check news likes
            */

            $news_likes = !empty($_POST['news_likes']) ? $_POST['news_likes'] : 0;

            /*
            * --- check news error
            */

            if(empty($error)) {
                if(!$this->NewsModel->checkNewsExists($news_name, $news_listId_cateNews_ties)) {
                    $news_createDate = time();
                    $news_creatorId  = $helper->infoUser("user_id");
                    $dataNews        = [
                        "news_name"                 => $news_name,
                        "news_status"               => $news_status,
                        "news_desc"                 => $news_desc,
                        "news_content"              => $news_content,
                        "news_metaTitle"            => $news_metaTitle,
                        "news_metaDesc"             => $news_metaDesc,
                        "news_keywords"             => $news_keywords,
                        "news_seoUrl"               => $news_seoUrl,
                        "news_image"                => $news_image,
                        "news_bannerPc"             => $news_bannerPc,
                        "news_bannerMb"             => $news_bannerMb,
                        "news_video"                => $news_video,
                        "news_target"               => $news_target,
                        "news_listId_cateNews_ties" => $news_listId_cateNews_ties,
                        "news_views"                => $news_views,
                        "news_likes"                => $news_likes,
                        "news_order"                => $news_order,
                        "news_createDate"           => $news_createDate,
                        "news_creatorId"            => $news_creatorId,
                    ];
                    $idNews = $this->NewsModel->addNewsNew($dataNews);
                    if(is_int($idNews)) {
                        $statusActionNews = [
                            "status"    => "success",
                            "notifiTxt" => "Thêm bản tin thành công"
                        ];
                    } else {
                        $statusActionNews = [
                            "status"    => "error",
                            "notifiTxt" => "Thêm bản tin không thành công"
                        ];
                    }
                } else {
                    $statusActionNews = [
                        "status"    => "error",
                        "notifiTxt" => "Bản tin tức đã tồn tại [ ERROR: Trùng tên và danh sách danh mục cha ]"
                    ];
                }
            } else {
                $statusActionNews = [
                    "status"    => "error",
                    "notifiTxt" => "Một số thông tin bạn chưa hoàn thành hoặc không đúng kiểu dữ liệu"
                ];
            }

        }

        $dataView = [
            "title"  => "Thêm tin tức",
            "layOut" => "AddNews",
            "css"    => ["home","fancybox.min"],
            "data"   => [
                "listTotalCateNews" => $this->CateNewsModel->getMultiLevelCateNews($this->CateNewsModel->getListTotalCateNews()),
                "statusActionNews"  => !empty($statusActionNews) ? $statusActionNews : []
            ]
        ];
        $this->view("MasterIndex", $dataView);
    }

    public function changeStatus()
    {
        $news_id  = (int)$_POST['news_id'];
        $statusChange = Format::validation($_POST['statusChange']);
        $dataNews = [
            "News_status" => $statusChange
        ];
        $process = $this->NewsModel->updateNews($dataNews, $news_id);
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
        $news_id = $_POST['news_id'];
        $process = $this->NewsModel->deleteNews($news_id);
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
        $listNewsId = $_POST['listNewsId'];
        $NewsIdDeleteError   = [];
        foreach($listNewsId as $NewsIdItem) {
            $idNews = (int) $NewsIdItem;
            $process    = $this->NewsModel->deleteNews($idNews);
            if(!$process) {
                $NewsIdDeleteError[] = $NewsIdItem;
            }
        }
        if(!empty($NewsIdDeleteError)) {
            $dataAjax = [
                "status"            => "error",
                "listIdCantDeleted" => $NewsIdDeleteError
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
        $listNewsId   = $_POST['listNewsId'];
        $statusChange = $_POST['statusChange'];
        $NewsIdUpdateError = [];
        foreach($listNewsId as $NewsIdItem) {
            $idNews   = (int) $NewsIdItem;
            $dataNews = [
                "News_status" => $statusChange
            ];
            $process = $this->NewsModel->updateNews($dataNews, $idNews);
            if(!$process) {
                $NewsIdUpdateError[] = $NewsIdItem;
            }
        }
        if(!empty($NewsIdUpdateError)) {
            $dataAjax = [
                "status"            => "error",
                "NewsIdUpdateError" => $NewsIdUpdateError
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
        $result   = $this->NewsModel->searchNewsByName($vlSearch);
        $dataAjax = [
            "searchData" => $result
        ];
        echo json_encode($dataAjax);
    }

    public function update($news_id = 0)
    {
        $news_id  = (!empty($news_id)) ? (int) $news_id : 0;
        $newsItem = $this->NewsModel->getNewsItemById($news_id);

        /*
        * ------------------------------
        * ----- Handle update news -----
        * ------------------------------
        */

        if(isset($_POST['updateNews_action'])) {
            $error = [];
            global $error;

            /*
            * --- check news status
            */

            $news_status = !empty($_POST['news_status']) ? 'on' : 'off';

            /*
            * --- check news name
            */

            if(empty($_POST['news_name'])) {
                $error['news_name'] = "<span class='error'>(*) Vui lòng nhập tên tin tức</span>";
            } else {
                $news_name = Format::validation($_POST['news_name']);
            }

            /*
            * --- check news desc
            */

            if(empty($_POST['news_desc'])) {
                $error['news_desc'] = "<span class='error'>(*) Vui lòng nhập mô tả tin tức</span>";
            } else {
                $news_desc = Format::validation($_POST['news_desc']);
            }

            /*
            * --- check news content
            */

            if(empty($_POST['news_content'])) {
                $error['news_content'] = "<span class='error'>(*) Vui lòng nhập nội dung tin tức</span>";
            } else {
                $news_content = $_POST['news_desc'];
            }

            /*
            * --- check news meta title
            */

            if(empty($_POST['news_metaTitle'])) {
                $error['news_metaTitle'] = "<span class='error'>(*) Vui lòng nhập meta title</span>";
            } else {
                $news_metaTitle = Format::validation($_POST['news_metaTitle']);
            }

            /*
            * --- check news meta desc
            */

            if(empty($_POST['news_metaDesc'])) {
                $error['news_metaDesc'] = "<span class='error'>(*) Vui lòng nhập meta description</span>";
            } else {
                $news_metaDesc = Format::validation($_POST['news_metaDesc']);
            }

            /*
            * --- check news key words
            */

            $news_keywords = !empty($_POST['news_keywords']) ? Format::validation($_POST['news_keywords']) : null;

            /*
            * --- check news seo url
            */

            if(empty($_POST['news_seoUrl'])) {
                $error['news_seoUrl'] = "<span class='error'>(*) Vui lòng nhập đường dẫn seo url</span>";
            } else {
                $news_seoUrl = Format::validation($_POST['news_seoUrl']);
            }

            /*
            * --- check news image
            */

            if(empty($_POST['news_image'])) {
                $error['news_image'] = "<span class='error'>(*) Vui lòng chọn ảnh cho tin tức</span>";
            } else {
                $news_image = $_POST['news_image'];
            }

            /*
            * --- check news banner PC
            */

            $news_bannerPc = !empty($_POST['news_bannerPc']) ? $_POST['news_bannerPc'] : null;

            /*
            * --- check news banner Mb
            */

            $news_bannerMb = !empty($_POST['news_bannerMb']) ? $_POST['news_bannerMb'] : null;

            /*
            * --- check news news_video
            */

            $_POST['news_video'] = !empty($_POST['news_video']) ? htmlentities($_POST['news_video']) : null;
            $news_video = $_POST['news_video'];

            /*
            * --- check news news_target
            */

            $news_target = $_POST['news_target'];

            /*
            * --- check news news_order
            */

            $news_order = !empty($_POST['news_order']) ? (int)$_POST['news_order'] : ($this->NewsModel->getOrderMaxPlus());

            /*
            * --- check news ties cateNews
            */


            if(empty($_POST['cateNewsId'])) {
                $error['cateNewsId'] = "<span class='error'>(*) Vui lòng chọn danh mục cha cho tin tức</span>";
            } else {
                $news_listId_cateNews_ties = json_encode($_POST['cateNewsId']);
            }

            /*
            * --- check news views
            */

            $news_views = !empty($_POST['news_views']) ? $_POST['news_views'] : 0;

            /*
            * --- check news likes
            */

            $news_likes = !empty($_POST['news_likes']) ? $_POST['news_likes'] : 0;

            /*
            * --- check news error
            */

            if(empty($error)) {
                $news_updateDate = time();
                $dataNews = [
                    "news_name"                 => $news_name,
                    "news_status"               => $news_status,
                    "news_desc"                 => $news_desc,
                    "news_content"              => $news_content,
                    "news_metaTitle"            => $news_metaTitle,
                    "news_metaDesc"             => $news_metaDesc,
                    "news_keywords"             => $news_keywords,
                    "news_seoUrl"               => $news_seoUrl,
                    "news_image"                => $news_image,
                    "news_bannerPc"             => $news_bannerPc,
                    "news_bannerMb"             => $news_bannerMb,
                    "news_video"                => $news_video,
                    "news_target"               => $news_target,
                    "news_listId_cateNews_ties" => $news_listId_cateNews_ties,
                    "news_views"                => $news_views,
                    "news_likes"                => $news_likes,
                    "news_order"                => $news_order,
                    "news_updateDate"           => $news_updateDate,
                ];
                $process = $this->NewsModel->updateNews($dataNews, $news_id);
                if($process) {
                    $statusActionNews = [
                        "status"    => "success",
                        "notifiTxt" => "Cập nhật bản tin thành công"
                    ];
                } else {
                    $statusActionNews = [
                        "status"    => "error",
                        "notifiTxt" => "Cập nhật bản tin không thành công"
                    ];
                }
            }
        }
        $dataView = [
            "title"  => "Cập nhật tin tức",
            "layOut" => "UpdateNews",
            "css"    => ["home","fancybox.min"],
            "data"   => [
                "listTotalCateNews"      => $this->CateNewsModel->getMultiLevelCateNews($this->CateNewsModel->getListTotalCateNews()),
                "statusActionNews"       => !empty($statusActionNews) ? $statusActionNews : [],
                "newsItem"               => !empty($newsItem) ? $newsItem : null,
                "listCateNewsByNewsItem" => !empty($newsItem['news_listId_cateNews_ties']) ? json_decode($newsItem['news_listId_cateNews_ties']) : [],
            ]
        ];
        $this->view("MasterIndex", $dataView);
    }

    public function loadReviewByField()
    {
        $fieldName = $_POST['fieldName'];
        $dataAjax = [
            "listData" => $this->NewsModel->loadNewsByField($fieldName)
        ];
        echo json_encode($dataAjax);
    }
}
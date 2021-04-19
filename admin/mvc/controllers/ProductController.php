<?php
class ProductController extends Controller
{
    public $CateProductModel;
    public $ProductModel;
    public $NewsModel;
    public $BrandModel;
    public $FlashSaleModel;

    function __construct()
    {
        $this->ProductModel     = $this->model("Product");
        $this->CateProductModel = $this->model("CateProduct");
        $this->NewsModel        = $this->model("News");
        $this->BrandModel       = $this->model("Brand");
        $this->FlashSaleModel   = $this->model("FlashSale");
    }

    public function index($orderBy = 'desc', $status = 'all', $page = 1, $fieldName = 'prod_name', $strSearch = '')
    {
        if(!empty($strSearch)) {
            $strSearch = Format::validationSearch($strSearch);
            if($fieldName == "cateProd_name") {
                $cateProdItem  = $this->CateProductModel->getCateProdItemByField($fieldName, $strSearch);
                $fieldName     = "prod_listId_cateProd_ties";
                $cateProd_id   = $cateProdItem['cateProd_id'];
                $listTotalProd = $this->ProductModel->getListProdByStatus("all");
                $listProd      = [];
                foreach($listTotalProd as $prodItem) {
                    $prod_listId_cateProd_ties = json_decode($prodItem['prod_listId_cateProd_ties']);
                    if(in_array($cateProd_id, $prod_listId_cateProd_ties)) {
                        $listProd[] = $prodItem;
                    }
                }
            } else {
                $listProd = $this->ProductModel->searchRecommentByFile($fieldName, $strSearch);
            }
        } else {
            $orderByAllow = ["asc","desc"];
            $statusAllow  = ["all","on","off"];
            $orderBy      = in_array($orderBy,$orderByAllow) ? $orderBy : "asc";
            $status       = in_array($status,$statusAllow)   ? $status  : "all";
            $page         = $page >= 1 ? $page : 1;
            $numPerPage   = 10;
            $totalProd    = count($this->ProductModel->getListProdByStatus($status));
            $totalPage    = ceil($totalProd / $numPerPage);
            $pageStart    = ($page - 1) * $numPerPage;
            $listProd     = $this->ProductModel->getListProdByPagination($orderBy, $status, $pageStart, $numPerPage);
        }

        $numRow = 0;
        foreach($listProd as &$prodItem) {
            $brandItem = $this->BrandModel->getBrandItemById((int)$prodItem['prod_ties_brand_id']);
            $listProd[$numRow]['prod_brand_name'] = $brandItem['brand_name'];
            $listProd[$numRow]['prod_brand_id']   = $brandItem['brand_id'];
            $numRow++;
        }
        $dataView = [
            "title"  => "Danh sách sản phẩm",
            "layOut" => "ListProducts",
            "css"    => ["home"],
            "data"   => [
                "orderBy"    => !empty($orderBy) ? $orderBy : null,
                "status"     => !empty($status) ? $status : null,
                "page"       => !empty($page) ? $page : null,
                "listProd"   => !empty($listProd) ? $listProd : null,
                "numPerPage" => !empty($numPerPage) ? $numPerPage : null,
                "totalPage"  => !empty($totalPage) ? $totalPage : null,
                "strSearch"  => !empty($strSearch) ? $strSearch : null,
                "fieldName"  => !empty($fieldName) ? $fieldName : null,
                "totalProd"  => !empty($totalNews) ? $totalNews : count($listProd),
            ]

        ];
        $this->view('MasterIndex', $dataView);
    }

    public function add()
    {
        $helper = new Helper;

        /*
        * ---------- ADD PRODUCT ACTION -----------
        */

        if(isset($_POST['addProd_action'])) {
            $error = [];
            global $error;

            /*
            * --- check product status
            */

            $prod_status = !empty($_POST['prod_status']) ? "on" : "off";

            /*
            * --- check product name
            */

            if(empty($_POST['prod_name'])) {
                $error['prod_name'] = "<span class='error'>(*) Vui lòng nhập tên sản phẩm</span>";
            } else {
                $prod_name = Format::validation($_POST['prod_name']);
            }

            /*
            * --- check product desc
            */

            $prod_desc = !empty($_POST['prod_desc']) ? Format::validation($_POST['prod_desc']) : null;

            /*
            * --- check product content
            */

            $prod_content = !empty($_POST['prod_content']) ? $_POST['prod_content'] : null;

            /*
            * --- check product meta title
            */

            if(empty($_POST['prod_metaTitle'])) {
                $error['prod_metaTitle'] = "<span class='error'>(*) Vui lòng nhập meta title sản phẩm</span>";
            } else {
                $prod_metaTitle = Format::validation($_POST['prod_metaTitle']);
            }

            /*
            * --- check product meta desc
            */

            if(empty($_POST['prod_metaDesc'])) {
                $error['prod_metaDesc'] = "<span class='error'>(*) Vui lòng nhập meta desc sản phẩm</span>";
            } else {
                $prod_metaDesc = Format::validation($_POST['prod_metaDesc']);
            }

            /*
            * --- check product meta key words
            */

            $prod_keywords = !empty($_POST['prod_keywords']) ? Format::validation($_POST['prod_keywords']) : null;

            /*
            * --- check product meta seo url
            */

            if(empty($_POST['prod_seoUrl'])) {
                $error['prod_seoUrl'] = "<span class='error'>(*) Vui lòng nhập seo title sản phẩm</span>";
            } else {
                $prod_seoUrl = Format::validation($_POST['prod_seoUrl']);
            }

            /*
            * --- check product avatar
            */

            if(empty($_POST['prod_avatar'])) {
                $error['prod_avatar'] = "<span class='error'>(*) Vui lòng chọn avatar sản phẩm</span>";
            } else {
                $prod_avatar = $_POST['prod_avatar'];
            }
            
            $prod_banner = !empty($_POST['prod_banner']) ? $_POST['prod_banner'] : null;


            /*
            * --- check product video
            */

            $_POST['prod_video'] = !empty($_POST['prod_video']) ? htmlentities($_POST['prod_video']) : null;
            $prod_video = $_POST['prod_video'];

            /*
            * --- check product current price
            */

            if(empty($_POST['prod_currentPrice'])) {
                $error['prod_currentPrice'] = "<span class='error'>(*) Vui lòng nhập giá sản phẩm</span>";
            } else {
                $prod_currentPrice = $_POST['prod_currentPrice'];
            }

            /*
            * --- check product old price
            */

            $prod_oldPrice = !empty($_POST['prod_oldPrice']) ? $_POST['prod_oldPrice'] : null;

            /*
            * --- check product model
            */

            $prod_model = !empty($_POST['prod_model']) ? Format::validation($_POST['prod_model']) : null;

            /*
            * --- check product amount
            */

            if(empty($_POST['prod_amount'])) {
                $error['prod_amount'] = "<span class='error'>(*) Vui lòng nhập số lượng sản phẩm</span>";
            } else {
                $prod_amount = (int)$_POST['prod_amount'];
            }

            /*
            * --- check product minimum amount
            */

            if(empty($_POST['prod_minimun_amount'])) {
                $error['prod_minimun_amount'] = "<span class='error'>(*) Vui lòng nhập số lượng tối thiếu mà khách hàng phải mua</span>";
            } else {
                $prod_minimun_amount = Format::validation($_POST['prod_minimun_amount']);
            }

            /*
            * --- check product sku
            */

            $prod_sku = !empty($_POST['prod_sku']) ? Format::validation($_POST['prod_sku']) : null;

            /*
            * --- check product order
            */

            $prod_order = !empty($_POST['prod_order']) ? (int)$_POST['prod_order'] : ($this->ProductModel->getOrderMaxPlus());

            /*
            * --- check product stock status
            */

            if(empty($_POST['prod_stock_status'])) {
                $error['prod_stock_status'] = "<span class='error'>(*) Vui lòng nhập trạng thái tồn kho sản phẩm</span>";
            } else {
                $prod_stock_status = $_POST['prod_stock_status'];
            }

            /*
            * --- check deliveryPromo status
            */

            $prod_deliveryPromo = !empty($_POST['prod_deliveryPromo']) ? $_POST['prod_deliveryPromo'] : null;

            /*
            * --- check product installment
            */

            $_POST['prod_installment'] = !empty( $_POST['prod_installment']) ? $_POST['prod_installment'][0] : '2';
            $prod_installment          = $_POST['prod_installment'];
            
            /*
            * --- check product for agents
            */
            
            $_POST['prod_for_agents'] = !empty( $_POST['prod_for_agents']) ? $_POST['prod_for_agents'][0] : '2';
            $prod_for_agents          = $_POST['prod_for_agents'];

            /*
            * --- check product installment rate
            */

            if(empty($_POST['prod_installment_rate'])) {
                $prod_installment_rate = null;
            } else {
                $prod_installment_rate = $_POST['prod_installment_rate'];
            }

            /*
            * --- check product V.A.T Tax
            */

            $_POST['prod_avt_tax'] = !empty( $_POST['prod_avt_tax'] ) ? $_POST['prod_avt_tax'][0] : '2';
            $prod_avt_tax          = $_POST['prod_avt_tax'];

            /*
            * --- check product liquidation
            */

            $_POST['prod_liquidation'] = !empty( $_POST['prod_liquidation'] ) ? $_POST['prod_liquidation'][0] : '2';
            $prod_liquidation          = $_POST['prod_liquidation'];

            /*
            * --- check product brand ties
            */

            if(empty($_POST['prod_ties_brand_id'])) {
                $error['prod_ties_brand_id'] = "<span class='error'>(*) Vui lòng chọn thương hiệu cho sản phẩm</span>";
            } else {
                $prod_ties_brand_id = $_POST['prod_ties_brand_id'];
            }

            /*
            * --- check product cateProd ties
            */

            if(empty($_POST['cateProdId'])) {
                $error['cateProdId'] = "<span class='error'>(*) Vui lòng chọn danh mục cho sản phẩm</span>";
            } else {
                $prod_listId_cateProd_ties = json_encode($_POST['cateProdId']);
            }

            /*
            * --- check product news intro ties
            */

            $prod_listId_newsIntro_ties = !empty($_POST['newsIntroId']) ? json_encode($_POST['newsIntroId']) : null;

            /*
            * --- check product news tutorial ties
            */

            $prod_listId_newsTutorial_ties = !empty($_POST['newsIdTutorial']) ? json_encode($_POST['newsIdTutorial']) : null;

            /*
            * --- check product recomment ties
            */

            if(empty($_POST['prod_listId_recomment'])) {
                $prod_listId_recomment = null;
            } else {
                foreach($_POST['prod_listId_recomment'] as $item) {
                    $prod_listId_recomment[] = $item['prod_id'];
                }
                $prod_listId_recomment = json_encode($prod_listId_recomment);
            }

            /*
            * --- check product img desc ties
            */
            $prod_image_desc = [];
            if(!empty($_POST['prod_image_desc'])) {
                foreach($_POST['prod_image_desc'] as $prod_image_desc_item) {
                    if(!empty($prod_image_desc_item['image'])) {
                        $prod_image_desc[] = $prod_image_desc_item;
                    }
                }
            }

            $_POST['prod_image_desc'] = $prod_image_desc;

            /*
            * --- check product intro content
            */

            $prod_intro_content = !empty($_POST['prod_intro_content']) ? $_POST['prod_intro_content'] : null;

            /*
            * --- check product specialFeutures content
            */

            $prod_old_content_ties = !empty($_POST['prod_old_content_ties']) ? $_POST['prod_old_content_ties'] : null;

            /*
            * --- check product specifications content
            */

            $prod_specifications_content = !empty($_POST['prod_specifications_content']) ? $_POST['prod_specifications_content'] : null;

            /*
            * --- check product outstanding features
            */

            $prod_outstanding_features = !empty($_POST['prod_outstanding_features']) ? $_POST['prod_outstanding_features'] : null;

            /*
            * --- check product flashSale
            */

            $prod_listFlashSale = [];
            if(!empty($_POST['prod_flashSale'])) {
                foreach($_POST['prod_flashSale'] as $prod_flashSale_item) {
                    if(!empty($prod_flashSale_item['price'])) {
                        $prod_listFlashSale[] = $prod_flashSale_item;
                    }
                }
            }

            $_POST['prod_flashSale'] = $prod_listFlashSale;

            /*
            * --- check product flashSale
            */

            $prod_discout_content = !empty($_POST['prod_discout_content']) ? $_POST['prod_discout_content'] : null;

            /*
            * --- check product error
            */

            if(empty($error)) {
                if(!($this->ProductModel->checkProdExists($prod_name, $prod_listId_cateProd_ties))) {
                    $prod_createDate = time();
                    $prod_creatorId  = $helper->infoUser("user_id");
                    $dataProd        = [
                        "prod_status"                   => $prod_status,
                        "prod_name"                     => $prod_name,
                        "prod_desc"                     => $prod_desc,
                        "prod_content"                  => $prod_content,
                        "prod_metaTitle"                => $prod_metaTitle,
                        "prod_metaDesc"                 => $prod_metaDesc,
                        "prod_keywords"                 => $prod_keywords,
                        "prod_seoUrl"                   => $prod_seoUrl,
                        "prod_avatar"                   => $prod_avatar,
                        "prod_banner"                   => $prod_banner,
                        "prod_video"                    => $prod_video,
                        "prod_currentPrice"             => $prod_currentPrice,
                        "prod_oldPrice"                 => $prod_oldPrice,
                        "prod_model"                    => $prod_model,
                        "prod_amount"                   => $prod_amount,
                        "prod_minimun_amount"           => $prod_minimun_amount,
                        "prod_sku"                      => $prod_sku,
                        "prod_order"                    => $prod_order,
                        "prod_stock_status"             => $prod_stock_status,
                        "prod_deliveryPromo"            => $prod_deliveryPromo,
                        "prod_installment"              => $prod_installment,
                        "prod_installment_rate"         => $prod_installment_rate,
                        "prod_avt_tax"                  => $prod_avt_tax,
                        "prod_liquidation"              => $prod_liquidation,
                        "prod_ties_brand_id"            => $prod_ties_brand_id,
                        "prod_listId_cateProd_ties"     => $prod_listId_cateProd_ties,
                        "prod_listId_newsIntro_ties"    => $prod_listId_newsIntro_ties,
                        "prod_listId_newsTutorial_ties" => $prod_listId_newsTutorial_ties,
                        "prod_listId_recomment"         => $prod_listId_recomment,
                        "prod_createDate"               => $prod_createDate,
                        "prod_creatorId"                => $prod_creatorId,
                        "prod_intro_content"            => $prod_intro_content,
                        "prod_old_content_ties"         => $prod_old_content_ties,
                        "prod_specifications_content"   => $prod_specifications_content,
                        "prod_outstanding_features"     => $prod_outstanding_features,
                        "prod_discout_content"          => $prod_discout_content,
                        "prod_for_agents"               => $prod_for_agents
                    ];
                    $prodId_add = $this->ProductModel->addProdNew($dataProd);
                    if(is_int($prodId_add)) {
                        if(!empty($prod_image_desc)) {
                            foreach($prod_image_desc as $image_desc_item) {
                                $dataProdListImg = [
                                    "prod_listImg_ties_order"  => $image_desc_item['sort_order'],
                                    "prod_listImg_ties_src"    => $image_desc_item['image'],
                                    "prod_listImg_prodId_ties" => $prodId_add
                                ];
                                $this->ProductModel->addListImgNew($dataProdListImg);
                            }
                        }
                        if(!empty($prod_listFlashSale)) {
                            foreach($prod_listFlashSale as $prodFlashSaleItem) {
                                $dataProdFlashSale = [
                                    "prod_flashsale_prodId"           => $prodId_add,
                                    "prod_flashsale_customer_groupId" => !empty($prodFlashSaleItem['customer_group_id']) ? $prodFlashSaleItem['customer_group_id'] : 1,
                                    "prod_flashsale_order"            => $prodFlashSaleItem['order'],
                                    "prod_flashsale_price"            => $prodFlashSaleItem['price'],
                                    "prod_flashsale_dateStart"        => strtotime($prodFlashSaleItem['date_start']),
                                    "prod_flashsale_dateEnd"          => strtotime($prodFlashSaleItem['date_end']),
                                    "prod_flashsale_createDate"       => time(),
                                    "prod_flashsale_creatorId"        => $helper->infoUser("user_id"),
                                    "prod_flashsale_status"           => $prodFlashSaleItem['status']
                                ];
                                $this->ProductModel->addListFlashSaleNew($dataProdFlashSale);
                            }
                        }
                        $statusActionProd = [
                            "status"    => "success",
                            "notifiTxt" => "Thêm sản phẩm thành công"
                        ];
                    } else {
                        $statusActionProd = [
                            "status"    => "success",
                            "notifiTxt" => "Thêm sản phẩm không thành công"
                        ];
                    }
                } else {
                    $statusActionProd = [
                        "status"    => "error",
                        "notifiTxt" => "Sản phẩm đã tồn tại [ ERROR: Trùng tên và danh sách danh mục cha ]"
                    ];
                }
            } else {
                $statusActionProd = [
                    "status"    => "error",
                    "notifiTxt" => "Một số thông tin bạn chưa hoàn thành hoặc không đúng kiểu dữ liệu"
                ];
            }
        }

        $dataView = [
            "title"  => "Thêm sản phẩm",
            "layOut" => "AddProduct",
            "css"    => ["home","fancybox.min"],
            "data"   => [
                "listCateProd"     => !empty($this->CateProductModel->getMultiLevelCateProd($this->CateProductModel->getListTotalCateProd())) ? $this->CateProductModel->getMultiLevelCateProd($this->CateProductModel->getListTotalCateProd()) : null,
                "listNews"         => !empty($this->NewsModel->getListNewsByStatus("all")) ? $this->NewsModel->getListNewsByStatus("all") : null,
                "listTotalProd"    => !empty($this->ProductModel->getListProdByStatus("all")) ? $this->ProductModel->getListProdByStatus("all") : null,
                "listBrand"        => !empty($this->BrandModel->getListTotalBrandByStatus("all")) ? $this->BrandModel->getListTotalBrandByStatus("all") : null,
                "statusActionProd" => !empty($statusActionProd) ? $statusActionProd : []
            ]
        ];
        $this->view("MasterIndex", $dataView);
    }

    public function update($prod_id = 0)
    {

        $helper = new Helper;

        $prod_id  = (!empty($prod_id)) ? (int) $prod_id : 0;
        $prodItem = $this->ProductModel->getProdItemById($prod_id);

        /*
        * -----------------------------------
        * ----- Handle update product -------
        * -----------------------------------
        */

        if(isset($_POST['updateProd_action'])) {
            $error = [];
            global $error;

            /*
            * --- check product status
            */

            $_POST['prod_status'] = !empty($_POST['prod_status']) ? "on" : "off";
            $prod_status = $_POST['prod_status'];

            /*
            * --- check product name
            */

            if(empty($_POST['prod_name'])) {
                $error['prod_name'] = "<span class='error'>(*) Vui lòng nhập tên sản phẩm</span>";
            } else {
                $prod_name = Format::validation($_POST['prod_name']);
            }

            /*
            * --- check product desc
            */

            $prod_desc = !empty($_POST['prod_desc']) ? Format::validation($_POST['prod_desc']) : null;

            /*
            * --- check product content
            */

            $prod_content = !empty($_POST['prod_content']) ? $_POST['prod_content'] : null;

            /*
            * --- check product meta title
            */

            if(empty($_POST['prod_metaTitle'])) {
                $error['prod_metaTitle'] = "<span class='error'>(*) Vui lòng nhập meta title sản phẩm</span>";
            } else {
                $prod_metaTitle = Format::validation($_POST['prod_metaTitle']);
            }

            /*
            * --- check product meta desc
            */

            if(empty($_POST['prod_metaDesc'])) {
                $error['prod_metaDesc'] = "<span class='error'>(*) Vui lòng nhập meta desc sản phẩm</span>";
            } else {
                $prod_metaDesc = Format::validation($_POST['prod_metaDesc']);
            }

            /*
            * --- check product meta key words
            */

            $prod_keywords = !empty($_POST['prod_keywords']) ? Format::validation($_POST['prod_keywords']) : null;

            /*
            * --- check product meta seo url
            */

            if(empty($_POST['prod_seoUrl'])) {
                $error['prod_seoUrl'] = "<span class='error'>(*) Vui lòng nhập seo title sản phẩm</span>";
            } else {
                $prod_seoUrl = Format::validation($_POST['prod_seoUrl']);
            }

            /*
            * --- check product avatar
            */

            if(empty($_POST['prod_avatar'])) {
                $error['prod_avatar'] = "<span class='error'>(*) Vui lòng chọn avatar sản phẩm</span>";
            } else {
                $prod_avatar = $_POST['prod_avatar'];
            }

            $prod_banner = !empty($_POST['prod_banner']) ? $_POST['prod_banner'] : null;

            /*
            * --- check product video
            */

            $_POST['prod_video'] = !empty($_POST['prod_video']) ? $_POST['prod_video'] : null;
            $prod_video = $_POST['prod_video'];

            /*
            * --- check product current price
            */

            if(empty($_POST['prod_currentPrice'])) {
                $error['prod_currentPrice'] = "<span class='error'>(*) Vui lòng nhập giá sản phẩm</span>";
            } else {
                $prod_currentPrice = $_POST['prod_currentPrice'];
            }

            /*
            * --- check product old price
            */

            $prod_oldPrice = !empty($_POST['prod_oldPrice']) ? $_POST['prod_oldPrice'] : null;

            /*
            * --- check product model
            */

            $prod_model = !empty($_POST['prod_model']) ? Format::validation($_POST['prod_model']) : null;

            /*
            * --- check product amount
            */

            if(empty($_POST['prod_amount'])) {
                $error['prod_amount'] = "<span class='error'>(*) Vui lòng nhập số lượng sản phẩm</span>";
            } else {
                $prod_amount = (int)$_POST['prod_amount'];
            }

            /*
            * --- check product minimum amount
            */

            if(empty($_POST['prod_minimun_amount'])) {
                $error['prod_minimun_amount'] = "<span class='error'>(*) Vui lòng nhập số lượng tối thiếu mà khách hàng phải mua</span>";
            } else {
                $prod_minimun_amount = Format::validation($_POST['prod_minimun_amount']);
            }

            /*
            * --- check product sku
            */

            $prod_sku = !empty($_POST['prod_sku']) ? Format::validation($_POST['prod_sku']) : null;

            /*
            * --- check product order
            */

            $prod_order = !empty($_POST['prod_order']) ? (int)$_POST['prod_order'] : ($this->ProductModel->getOrderMaxPlus());

            /*
            * --- check product stock status
            */

            if(empty($_POST['prod_stock_status'])) {
                $error['prod_stock_status'] = "<span class='error'>(*) Vui lòng nhập trạng thái tồn kho sản phẩm</span>";
            } else {
                $prod_stock_status = $_POST['prod_stock_status'];
            }

            /*
            * --- check deliveryPromo status
            */

            $prod_deliveryPromo = !empty($_POST['prod_deliveryPromo']) ? $_POST['prod_deliveryPromo'] : null;

            /*
            * --- check product installment
            */

            $_POST['prod_installment'] = !empty( $_POST['prod_installment']) ? $_POST['prod_installment'][0] : '2';
            $prod_installment          = $_POST['prod_installment'];
            
            /*
            * --- check product for agents
            */
            
            $_POST['prod_for_agents'] = !empty( $_POST['prod_for_agents']) ? $_POST['prod_for_agents'][0] : '2';
            $prod_for_agents          = $_POST['prod_for_agents'];

            /*
            * --- check product installment rate
            */

            if(empty($_POST['prod_installment_rate'])) {
                $prod_installment_rate = null;
            } else {
                $prod_installment_rate = $_POST['prod_installment_rate'];
            }

            /*
            * --- check product V.A.T Tax
            */

            $_POST['prod_avt_tax'] = !empty( $_POST['prod_avt_tax']) ? $_POST['prod_avt_tax'][0] : '2';
            $prod_avt_tax          = $_POST['prod_avt_tax'];

            /*
            * --- check product liquidation
            */

            $_POST['prod_liquidation'] = !empty( $_POST['prod_liquidation']) ? $_POST['prod_liquidation'][0] : '2';
            $prod_liquidation          = $_POST['prod_liquidation'];

            /*
            * --- check product brand ties
            */

            if(empty($_POST['prod_ties_brand_id'])) {
                $error['prod_ties_brand_id'] = "<span class='error'>(*) Vui lòng chọn thương hiệu cho sản phẩm</span>";
            } else {
                $prod_ties_brand_id = $_POST['prod_ties_brand_id'];
            }

            /*
            * --- check product cateProd ties
            */

            if(empty($_POST['cateProdId'])) {
                $error['cateProdId'] = "<span class='error'>(*) Vui lòng chọn danh mục cho sản phẩm</span>";
            } else {
                $prod_listId_cateProd_ties = json_encode($_POST['cateProdId']);
            }

            /*
            * --- check product news intro ties
            */

            $prod_listId_newsIntro_ties = !empty($_POST['newsIntroId']) ? json_encode($_POST['newsIntroId']) : null;

            /*
            * --- check product news tutorial ties
            */

            $prod_listId_newsTutorial_ties = !empty($_POST['newsIdTutorial']) ? json_encode($_POST['newsIdTutorial']) : null;

            /*
            * --- check product recomment ties
            */


            if(empty($_POST['prod_listId_recomment'])) {
                $prod_listId_recomment = null;
            } else {
                foreach($_POST['prod_listId_recomment'] as $item) {
                    $prod_listId_recomment[] = $item['prod_id'];
                }
                $prod_listId_recomment = json_encode($prod_listId_recomment);
            }


            /*
            * --- check product img desc ties
            */
            $prod_image_desc = [];
            if(!empty($_POST['prod_image_desc'])) {
                foreach($_POST['prod_image_desc'] as $prod_image_desc_item) {
                    if(!empty($prod_image_desc_item['image'])) {
                        $prod_image_desc[] = $prod_image_desc_item;
                    }
                }
            }

            $_POST['prod_image_desc'] = $prod_image_desc;

            /*
            * --- check product intro content
            */

            $prod_intro_content = !empty($_POST['prod_intro_content']) ? $_POST['prod_intro_content'] : null;

            /*
            * --- check product old product content
            */

            $prod_old_content_ties = !empty($_POST['prod_old_content_ties']) ? $_POST['prod_old_content_ties'] : null;

            /*
            * --- check product specifications content
            */

            $prod_specifications_content = !empty($_POST['prod_specifications_content']) ? $_POST['prod_specifications_content'] : null;

             /*
            * --- check product outstanding features
            */

            $prod_outstanding_features = !empty($_POST['prod_outstanding_features']) ? $_POST['prod_outstanding_features'] : null;

            /*
            * --- check product flashSale
            */

            $prod_listFlashSale = [];
            if(!empty($_POST['prod_flashSale'])) {
                foreach($_POST['prod_flashSale'] as $prod_flashSale_item) {
                    if(!empty($prod_flashSale_item['price'])) {
                        $prod_listFlashSale[] = $prod_flashSale_item;
                    }
                }
            }

            $_POST['prod_flashSale'] = $prod_listFlashSale;

            /*
            * --- check product flashSale
            */

            $prod_discout_content = !empty($_POST['prod_discout_content']) ? $_POST['prod_discout_content'] : null;

            /*
            * --- check product error
            */

            if(empty($error)) {
                    $prod_updateDate = time();
                    $dataProd        = [
                        "prod_status"                   => $prod_status,
                        "prod_name"                     => $prod_name,
                        "prod_desc"                     => $prod_desc,
                        "prod_content"                  => $prod_content,
                        "prod_metaTitle"                => $prod_metaTitle,
                        "prod_metaDesc"                 => $prod_metaDesc,
                        "prod_keywords"                 => $prod_keywords,
                        "prod_seoUrl"                   => $prod_seoUrl,
                        "prod_avatar"                   => $prod_avatar,
                        "prod_banner"                   => $prod_banner,
                        "prod_video"                    => $prod_video,
                        "prod_currentPrice"             => $prod_currentPrice,
                        "prod_oldPrice"                 => $prod_oldPrice,
                        "prod_model"                    => $prod_model,
                        "prod_amount"                   => $prod_amount,
                        "prod_minimun_amount"           => $prod_minimun_amount,
                        "prod_sku"                      => $prod_sku,
                        "prod_order"                    => $prod_order,
                        "prod_stock_status"             => $prod_stock_status,
                        "prod_deliveryPromo"            => $prod_deliveryPromo,
                        "prod_installment"              => $prod_installment,
                        "prod_installment_rate"         => $prod_installment_rate,
                        "prod_avt_tax"                  => $prod_avt_tax,
                        "prod_liquidation"              => $prod_liquidation,
                        "prod_ties_brand_id"            => $prod_ties_brand_id,
                        "prod_listId_cateProd_ties"     => $prod_listId_cateProd_ties,
                        "prod_listId_newsIntro_ties"    => $prod_listId_newsIntro_ties,
                        "prod_listId_newsTutorial_ties" => $prod_listId_newsTutorial_ties,
                        "prod_listId_recomment"         => $prod_listId_recomment,
                        "prod_updateDate"               => $prod_updateDate,
                        "prod_intro_content"            => $prod_intro_content,
                        "prod_old_content_ties"         => $prod_old_content_ties,
                        "prod_specifications_content"   => $prod_specifications_content,
                        "prod_outstanding_features"     => $prod_outstanding_features,
                        "prod_discout_content"          => $prod_discout_content,
                        "prod_for_agents"               => $prod_for_agents
                    ];
                    $process = $this->ProductModel->updateProdNew($dataProd, $prod_id);
                    if($process) {
                        // handle image desc image
                        $this->ProductModel->deleteTotalProdImageDescByProdId($prod_id);
                        // -----------------------
                        if(!empty($prod_image_desc)) {
                            foreach($prod_image_desc as $image_desc_item) {
                                $dataProdListImg = [
                                    "prod_listImg_ties_order"  => $image_desc_item['sort_order'],
                                    "prod_listImg_ties_src"    => $image_desc_item['image'],
                                    "prod_listImg_prodId_ties" => $prod_id
                                ];
                                $this->ProductModel->addListImgNew($dataProdListImg);
                            }
                        }
                        // handle image desc image
                        $this->ProductModel->deleteTotalProdFlashSaleByProdId($prod_id);
                        // -----------------------
                        if(!empty($prod_listFlashSale)) {
                            foreach($prod_listFlashSale as $prodFlashSaleItem) {
                                $dataProdFlashSale = [
                                    "prod_flashsale_prodId"           => $prod_id,
                                    "prod_flashsale_customer_groupId" => !empty($prodFlashSaleItem['customer_group_id']) ? $prodFlashSaleItem['customer_group_id'] : 1,
                                    "prod_flashsale_order"            => $prodFlashSaleItem['order'],
                                    "prod_flashsale_price"            => $prodFlashSaleItem['price'],
                                    "prod_flashsale_dateStart"        => strtotime($prodFlashSaleItem['date_start']),
                                    "prod_flashsale_dateEnd"          => strtotime($prodFlashSaleItem['date_end']),
                                    "prod_flashsale_createDate"       => time(),
                                    "prod_flashsale_creatorId"        => $helper->infoUser("user_id"),
                                    "prod_flashsale_status"           => $prodFlashSaleItem['status']
                                ];
                                $this->ProductModel->addListFlashSaleNew($dataProdFlashSale);
                            }
                        }

                        $statusActionProd = [
                            "status"    => "success",
                            "notifiTxt" => "Cập nhật sản phẩm thành công"
                        ];
                    } else {
                        $statusActionProd = [
                            "status"    => "success",
                            "notifiTxt" => "Cập nhật sản phẩm không thành công"
                        ];
                    }
            } else {
                $statusActionProd = [
                    "status"    => "error",
                    "notifiTxt" => "Một số thông tin bạn chưa hoàn thành hoặc không đúng kiểu dữ liệu"
                ];
            }
        }

        // if product exists then load data relative
        if(!empty($prodItem)) {
            $listProdImgDesc   = !empty($this->ProductModel->getListImgDescByIdProd($prodItem['prod_id'])) ? $this->ProductModel->getListImgDescByIdProd($prodItem['prod_id']) : null;
            $listProdFlashSale = !empty($this->ProductModel->getListFlashSaleByIdProd($prodItem['prod_id'])) ? $this->ProductModel->getListFlashSaleByIdProd($prodItem['prod_id']) : null;
            if(!empty($prodItem['prod_listId_recomment'])) {
                $listIdProdRecomment = json_decode($prodItem['prod_listId_recomment']);
                $listProdRecomment = [];
                $listAllProd = $this->ProductModel->getListProdByStatus("all");
                foreach($listAllProd as $_prodItem) {
                    if(in_array($_prodItem['prod_id'], $listIdProdRecomment)) {
                        $arr = [
                            "prod_id"   => $_prodItem['prod_id'],
                            "prod_name" => $_prodItem['prod_name']
                        ];
                        $listProdRecomment[] = $arr;
                    }
                }
            }
        }

        $dataView = [
            "title"  => "Cập nhật sản phẩm",
            "layOut" => "UpdateProduct",
            "css"    => ["home","fancybox.min"],
            "data"   => [
                "statusActionProd"  => !empty($statusActionProd) ? $statusActionProd : null,
                "prodItem"          => !empty($prodItem) ? $prodItem : null,
                "listNews"          => !empty($this->NewsModel->getListNewsByStatus("all")) ? $this->NewsModel->getListNewsByStatus("all") : null,
                "listTotalProd"     => !empty($this->ProductModel->getListProdByStatus("all")) ? $this->ProductModel->getListProdByStatus("all") : null,
                "listBrand"         => !empty($this->BrandModel->getListTotalBrandByStatus("all")) ? $this->BrandModel->getListTotalBrandByStatus("all") : null,
                "listProdImgDesc"   => !empty($listProdImgDesc) ? $listProdImgDesc : null,
                "listProdFlashSale" => !empty($listProdFlashSale) ? $listProdFlashSale : null,
                "listProdRecomment" => !empty($listProdRecomment) ? $listProdRecomment : null,
                "listCateProd"      => !empty($this->CateProductModel->getMultiLevelCateProd($this->CateProductModel->getListTotalCateProd())) ? $this->CateProductModel->getMultiLevelCateProd($this->CateProductModel->getListTotalCateProd()) : null,
            ]
        ];
        $this->view("MasterIndex", $dataView);
    }

    public function recommentSearch()
    {
        $vlSearch = $_POST['vlSearch'];
        $result   = $this->ProductModel->searchProdByName($vlSearch);
        $dataAjax = [
            "searchData" => $result
        ];
        echo json_encode($dataAjax);
    }

    public function getListTotalProductByField()
    {
        $dataAjax = [
            "listProd" => $this->ProductModel->getListAllProductByField()
        ];
        echo json_encode($dataAjax);
    }

    public function changeStatus()
    {
        $prod_id  = (int)$_POST['prod_id'];
        $statusChange = Format::validation($_POST['statusChange']);
        $dataProd = [
            "prod_status" => $statusChange
        ];
        $process = $this->ProductModel->updateProd($dataProd, $prod_id);
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
        $prod_id = $_POST['prod_id'];
        $process = $this->ProductModel->deleteProd($prod_id);
        if($process) {
            $this->ProductModel->deleteTotalProdImageDescByProdId($prod_id);
            $this->ProductModel->deleteTotalProdFlashSaleByProdId($prod_id);
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
        $listProdId        = $_POST['listProdId'];
        $ProdIdDeleteError = [];
        foreach($listProdId as $ProdIdItem) {
            $idProd  = (int) $ProdIdItem;
            $process = $this->ProductModel->deleteProd($idProd);
            if(!$process) {
                $ProdIdDeleteError[] = $ProdIdItem;
            } else {
                $this->ProductModel->deleteTotalProdImageDescByProdId($idProd);
                $this->ProductModel->deleteTotalProdImageDescByProdId($idProd);
            }
        }
        if(!empty($ProdIdDeleteError)) {
            $dataAjax = [
                "status"            => "error",
                "listIdCantDeleted" => $ProdIdDeleteError
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
        $listProdId   = $_POST['listProdId'];
        $statusChange = $_POST['statusChange'];
        $ProdIdUpdateError = [];
        foreach($listProdId as $ProdIdItem) {
            $idProd   = (int) $ProdIdItem;
            $dataProd = [
                "Prod_status" => $statusChange
            ];
            $process = $this->ProductModel->updateProd($dataProd, $idProd);
            if(!$process) {
                $ProdIdUpdateError[] = $ProdIdItem;
            }
        }
        if(!empty($ProdIdUpdateError)) {
            $dataAjax = [
                "status"            => "error",
                "ProdIdUpdateError" => $ProdIdUpdateError
            ];
        } else {
            $dataAjax = [
                "status" => "success"
            ];
        }
        echo json_encode($dataAjax);
    }

    public function loadProductByField()
    {
        $fieldName = $_POST['fieldName'];
        $dataAjax = [
            "listData" => $this->ProductModel->loadProductByField__model([$fieldName],"")
        ];
        echo json_encode($dataAjax);
    }

    public function loadProductFieldById(){
        $fieldGet = $_POST['fieldName'];
        $prod_id  = $_POST['prod_id'];

        $prodItem = $this->ProductModel->loadProductByField__model($fieldGet,"`prod_id` = '{$prod_id}'");

        if(!empty($prodItem)) {
            $dataAjax = [
                "status"   => "success",
                "prodItem" => $prodItem
            ];
        } else {
            $dataAjax = [
                "status" => "error"
            ];
        }

        echo json_encode($dataAjax);
    }

    public function searchRecommentByFileAjax()
    {
        $searchValue = Format::validationSearch($_POST['searchValue']);
        $fieldName   = $_POST['fieldName'];
        $dataAjax = [
            "searchData" => $this->ProductModel->searchRecommentFieldByFile($fieldName, $searchValue, ["prod_id","prod_name","prod_avatar"])
        ];
        echo json_encode($dataAjax);
    }

    public function recommentProductByCateProdId()
    {
        $data = $_POST['data'];
        $cateId = (int) $data['cateId'];

        $listProdByIdCate = [];

        $listProdAll = $this->ProductModel->loadProductByField__model(["prod_id","prod_name","prod_listId_cateProd_ties"],"");

        if(!empty($listProdAll)) {
            foreach($listProdAll as $prodItem) {
                $list_cateID = json_decode($prodItem['prod_listId_cateProd_ties']);
                if(in_array($cateId, $list_cateID)) {
                    $listProdByIdCate[] = $prodItem;
                }
            }
        }

        $dataAjax = [
            "dataRecomment" => $listProdByIdCate
        ];

        echo json_encode($dataAjax);

    }

    public function selectToggleProdLiquidation()
    {
        $option_prod_liquidation = $_POST['option_prod_liquidation'];
        $prod_id                 = $_POST['prod_id'];
        $dataProd = [
            "prod_liquidation" => $option_prod_liquidation,
        ];
        $process = $this->ProductModel->updateProd( $dataProd, $prod_id );
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

    public function recommentProductFlashsaleToday()
    {
        $listProd           = $this->ProductModel->getListTotalProdByField(["prod_id","prod_name"]);
        $listFlashsaleToday = $this->FlashSaleModel->getListFlashSaleByTime(time());

        $listProd_flashsale = [];
        if(!empty($listProd) && !empty($listFlashsaleToday)) {
            foreach ( $listProd as $prodItem ) {
                foreach( $listFlashsaleToday as $flashsaleItem ) {
                    if( $flashsaleItem['prod_flashsale_prodId'] == $prodItem['prod_id'] ) {
                        $data = [
                            "prod_id"   => $prodItem['prod_id'],
                            "prod_name" => $prodItem['prod_name']
                        ];
                        $listProd_flashsale[] = $data;
                    }
                }
            }
        } else {
            $listProd_flashsale = [];
        }
        echo json_encode($listProd_flashsale);
    }
}
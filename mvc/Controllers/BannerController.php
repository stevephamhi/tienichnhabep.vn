<?php
class BannerController extends BaseController
{
    private $BannerModel;

    public function __construct()
    {
        $this->BannerModel = $this->model("BannerModel");
    }

    public function bannermain()
    {
        $dateToday = time();
        $listBannerToday = $this->BannerModel->getBannerByToday("main", $dateToday);
        return [
            "listBannerToday" => $listBannerToday,
        ];
    }

    public function bannerright()
    {
        $dateToday = time();
        $listBannerToday = $this->BannerModel->getBannerByToday("right", $dateToday, 6);
        return [
            "listBannerToday" => $listBannerToday,
        ];
    }

    public function bannerbottom()
    {
        $dateToday = time();
        $listBannerToday = $this->BannerModel->getBannerByToday("bottom", $dateToday, 2);
        return [
            "listBannerToday" => $listBannerToday,
        ];
    }

    public function bannerpromo()
    {
        $dateToday = time();
        $listBannerToday = $this->BannerModel->getBannerByToday("promo", $dateToday, 4);
        return [
            "listBannerToday" => $listBannerToday,
        ];
    }
}
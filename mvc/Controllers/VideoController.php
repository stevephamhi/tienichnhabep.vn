<?php

class VideoController extends BaseController
{
    private $VideoModel;
    private $ProductModel;

    public function __construct()
    {
        $this->VideoModel   = $this->model("VideoModel");
        $this->ProductModel = $this->model("ProductModel");
    }

    public function getListVideoGroupInToday()
    {
        $listVideoGroup = $this->VideoModel->getVideoGroupAndVideoRelativeBydate(time());
        if(!empty($listVideoGroup)) {
            foreach($listVideoGroup as &$videoGroupItem) {
                $videoGroupItem['prod_video_1'] = $this->ProductModel->getProdItemById($videoGroupItem['video_prodId_ties_1']);
                $videoGroupItem['prod_video_2'] = $this->ProductModel->getProdItemById($videoGroupItem['video_prodId_ties_2']);
                $videoGroupItem['prod_video_3'] = $this->ProductModel->getProdItemById($videoGroupItem['video_prodId_ties_3']);
                $videoGroupItem['prod_video_4'] = $this->ProductModel->getProdItemById($videoGroupItem['video_prodId_ties_4']);
            }
        }
        return $listVideoGroup;
    }
}
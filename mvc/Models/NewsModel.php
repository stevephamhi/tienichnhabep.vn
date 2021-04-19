<?php

class NewsModel extends Database
{
    const TABLE_NEWS = "tbl_news";


    public function selectListNewsByListIdNews($listIdNews = [])
    {
        if(!empty($listIdNews)) {
            $listNews = $this->selectAll(self::TABLE_NEWS,"`news_status` = 'on'");
            $result = [];
            foreach($listNews as $newsItem) {
                if(in_array($newsItem['news_id'], $listIdNews) ) {
                    $result[] = $newsItem;
                }
            }
            return $result;
        } else {
            return [];
        }
    }
}
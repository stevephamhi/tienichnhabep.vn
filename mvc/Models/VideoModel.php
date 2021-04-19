<?php

class VideoModel extends Database
{
    const TABLE_VIDEO      = "tbl_video";
    const TABLE_VIDEOGROUP = "tbl_videogroup";

    public function getVideoGroupAndVideoRelativeBydate($date)
    {
        $sql = "SELECT `tbl_videogroup`.videoGroup_name as `videoGroup_name`, `tbl_video`.* FROM `tbl_videogroup` JOIN `tbl_video` ON `tbl_video`.video_videoGroupId_ties = `tbl_videogroup`.videoGroup_id WHERE `tbl_videogroup`.videoGroup_status = 'on' AND `tbl_videogroup`.videoGroup_startDate <= '{$date}' AND `tbl_videogroup`.videoGroup_endDate >= '{$date}'";
        return $this->selectByQuery($sql);
    }
}
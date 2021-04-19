<?php
class Pagination
{
    public static function getPagination($self, $totalPage, $page)
    {
        if ($totalPage > '1') {
            $range = 4;
            $range_min = ($range % 2 == 0) ? ($range / 2) - 1 : ($range - 1) / 2;
            $range_max = ($range % 2 == 0) ? $range_min + 1 : $range_min;
            $page_min = $page - $range_min;
            $page_max = $page + $range_max;

            $page_min = ($page_min < 1) ? 1 : $page_min;
            $page_max = ($page_max < ($page_min + $range - 1)) ? $page_min + $range - 1 : $page_max;
            if ($page_max > $totalPage) {
                $page_min = ($page_min > 1) ? $totalPage - $range + 1 : 1;
                $page_max = $totalPage;
            }

            $page_min = ($page_min < 1) ? 1 : $page_min;

            $page_pagination = '';

            if (($page > ($range - $range_min)) && ($totalPage > $range)) {
                $page_pagination .= '<a title="Trang đầu" href="' . $self . '1">Trang đầu</a> ';
            }

            if ($page != 1) {
                $page_pagination .= '<a href="' . $self . '' . ($page - 1) . '"><<</a> ';
            }

            for ($i = $page_min; $i <= $page_max; $i++) {
                if ($i == $page)
                    $page_pagination .= "<span class='current'>" . $i . '</span> ';
                else
                    $page_pagination .= '<a href="' . $self . '' . $i . '">' . $i . '</a> ';
            }

            if ($page < $totalPage) {
                $page_pagination .= ' <a href="' . $self . '' . ($page + 1) . '">>></a>';
            }

            if (($page < ($totalPage - $range_max)) && ($totalPage > $range)) {
                $page_pagination .= ' <a title="Last" href="' . $self . '' . $totalPage . '">Trang cuối</a> ';
            }
            $page_pagination = "<span class='countPage'>Trang " . $page . "/" . $totalPage . "</span>" . $page_pagination;
        }
        return $page_pagination;
    }
}

<?php
class Format {
    public static function validation($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = strip_tags($data);
        return $data;
    }

    public static function create_slug($string) {
        $search = array (
            '#(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)#',
            '#(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)#',
            '#(ì|í|ị|ỉ|ĩ)#',
            '#(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)#',
            '#(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)#',
            '#(ỳ|ý|ỵ|ỷ|ỹ)#',
            '#(đ)#',
            '#(À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ)#',
            '#(È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)#',
            '#(Ì|Í|Ị|Ỉ|Ĩ)#',
            '#(Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ)#',
            '#(Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)#',
            '#(Ỳ|Ý|Ỵ|Ỷ|Ỹ)#',
            '#(Đ)#',
            "/[^a-zA-Z0-9\-\_]/",
            ) ;
        $replace = array ('a', 'e', 'i', 'o', 'u', 'y', 'd', 'A', 'E', 'I', 'O', 'U', 'Y', 'D', '-', ) ;
        $string = preg_replace($search, $replace, $string);
        $string = preg_replace('/(-)+/', '-', $string);
        $string = strtolower($string);
        return $string;
    }

    public static function formatTime($timezone)
    {
        if(!empty($timezone)) {
            $date = getdate($timezone);
            if(strlen($date['mday']) === 1) {
                $date['mday'] = "0".$date['mday'];
            }
            if(strlen($date['mon']) === 1) {
                $date['mon'] = "0".$date['mon'];
            }
            return "{$date['mday']}/{$date['mon']}/{$date['year']}";
        } return null;
    }

    public static function formatFullTime( $timezone )
    {
        if(!empty($timezone)) {
            $date = getdate($timezone);
            if(strlen($date['mday']) === 1) {
                $date['mday'] = "0".$date['mday'];
            }
            if(strlen($date['mon']) === 1) {
                $date['mon'] = "0".$date['mon'];
            }
            if(strlen($date['hours']) === 1) {
                $date['hours'] = "0".$date['hours'];
            }
            if(strlen($date['minutes']) === 1) {
                $date['minutes'] = "0".$date['minutes'];
            }
            if(strlen($date['seconds']) === 1) {
                $date['seconds'] = "0".$date['seconds'];
            }
            return "{$date['hours']}:{$date['minutes']}:{$date['seconds']} Ngày {$date['mday']}/{$date['mon']}/{$date['year']}";
        } return null;
    }

    public static function formatTimeDateInput($timezone)
    {
        if(!empty($timezone)) {
            $date = getdate($timezone);
            if(strlen($date['mday']) === 1) {
                $date['mday'] = "0".$date['mday'];
            }
            if(strlen($date['mon']) === 1) {
                $date['mon'] = "0".$date['mon'];
            }
            return "{$date['year']}-{$date['mon']}-{$date['mday']}";
        } return null;
    }

    public static function formatStatus($statusCode) {
        $statusValue = [
            "1" => "Còn hàng",
            "2" => "Hết hàng",
            "3" => "Đặt trước",
            "4" => "Tin đồn",
            "5" => "Sắp về",
            "6" => "Ngừng kinh doanh"
        ];
        return $statusValue[$statusCode];
    }

    public static function formatStatusOrder( $statusOrder ) {
        $statusValue = [
            "finish"     => "Hoàn thành",
            "refund"     => "Hoàn Tiền",
            "refuse"     => "Từ chối nhận",
            "canceled"   => "Bị hủy bỏ",
            "shipping"   => "Đang vận chuyển",
            "processing" => "Đang xử lý",
            "return"     => "Trả về",
        ];
        return $statusValue[$statusOrder];
    }

    public static function formatCurrency($number, $suffix = 'đ'){
        $number = (int) $number;
        if(!empty($number)) {
            return number_format($number,0,'','.').$suffix;
        } return null;
    }

    public static function showArray($data)
    {
        if(is_array($data)) {
            echo "<pre>";
            print_r($data);
            echo "</pre>";
        }
    }

    public static function validationSearch($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = strip_tags($data);
        $data = addslashes($data);
        $data = str_replace(["'",'"',"''","=","/","\\"], [''], $data);
        return $data;
    }

    public static function formatGender($gender) {
        $data = [
            "male"   => "Anh",
            "female" => "Chị"
        ];
        return $data[$gender];
    }

    public static function formatStatusCustomer($status) {
        $statusArr = [
            'active'  => 'Hoạt động',
            'pending' => 'Chờ duyệt',
            'disable' => 'Vô hiệu'
        ];
        return $statusArr[$status];
    }
}
?>
<?php
class Format
{
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

    public static function promotionalPercent($current_price, $old_price)
    {
        if(!empty($old_price)) {
            $current_price = (int) $current_price;
            $old_price = (int) $old_price;
            return "-". floor(self::num_format((( $old_price - $current_price ) / $old_price) * 100)) . "%";
        } return null;
    }

    public static function num_format($number,$precision=0)
    {
        $precision = ($precision == 0 ? 1 : $precision);
        $pow = pow(10, $precision);
        $value = (int)((trim($number)*$pow))/$pow;
        return number_format($value,$precision);
    }

    public static function formatCurrency($number, $suffix = ' ₫'){
        if( !empty($number) ) {
            return number_format($number,0,'','.').$suffix;
        } return null;
    }

    public static function formatOrder($order_status)
    {
        $orderArr = [
            "finish"     => "Giao hàng thành công",
            "refund"     => "Đơn hàng hoàn tiền",
            "refuse"     => "Từ chối nhận hàng",
            "canceled"   => "Đã hủy",
            "shipping"   => "Đơn hàng đang giao",
            "processing" => "Đã tiếp nhận"
        ];
        return $orderArr[$order_status];
    }

    public static function statusProdStock($idCode)
    {
        switch($idCode) {
            case 2: {
                return "<img width='100' class='het_hang' src='".Config::getBaseUrlClient("public/images/icon/sold_out.png")."'>";
                break;
            }
            case 3: {
                return "<img width='100' class='san_pham_moi' src='".Config::getBaseUrlClient("public/images/icon/new_prod.png")."'>";
                break;
            }
            case 4: {
                return "<span class='tin_don'>Tin Đồn</span>";
                break;
            }
            case 5: {
                return "<span class='sap_ve'>Sắp Về</span>";
                break;
            }
            case 6: {
                return "<span class='ngung_kinh_doanh'>Ngừng Kinh Doanh</span>";
                break;
            }
        }
    }

    public static function AnalyticsInstallment( $prod_currentPrice, $PercentagePrepaid, $numMonth, $prod_instalment_rate ) {
        $prod_currentPrice    = (int) $prod_currentPrice;
        $$PercentagePrepaid   = (int) $PercentagePrepaid;
        $prod_instalment_rate = (int) $prod_instalment_rate;

        $prepaidPrice         = $prod_currentPrice * ( $PercentagePrepaid / 100 );

        $totalPricePayment    = ( ( $prod_currentPrice - $prepaidPrice ) + ( $prod_currentPrice - $prepaidPrice ) * ( $prod_instalment_rate/100 ) );

        $priceOfPaymentMonths = $totalPricePayment / $numMonth;

        $PriceOfDifference    = $totalPricePayment - ( $prod_currentPrice - $prepaidPrice );

        return [
            "prepaidPrice"         => self::formatCurrency($prepaidPrice),
            "priceOfPaymentMonths" => self::formatCurrency($priceOfPaymentMonths),
            "totalPricePayment"    => self::formatCurrency($totalPricePayment),
            "PriceOfDifference"    => !empty(self::formatCurrency($PriceOfDifference)) ? self::formatCurrency($PriceOfDifference) : "0đ"
        ];

    }

    public static function validationData($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = strip_tags($data);
        $data = addslashes($data);
        return $data;
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

    public static function formatPhone($phone) {
        if(strlen($phone) == 11) {
            if(  preg_match( '/^\d(\d{2})(\d{4})(\d{4})$/', $phone,  $matches ) ) {
                $result = '(0' . $matches[1] . ') ' .$matches[2] . ' ' . $matches[3];
                return $result;
            }
        } else {
            if(  preg_match( '/^\d(\d{3})(\d{3})(\d{3})$/', $phone,  $matches ) ) {
                $result = '(0' . $matches[1] . ') ' .$matches[2] . ' ' . $matches[3];
                return $result;
            }
        }
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

    public static function formatTimeOrder( $timezone )
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
            return "Ngày {$date['mday']} Tháng {$date['mon']} Năm {$date['year']} Lúc {$date['hours']}h:{$date['minutes']}p:{$date['seconds']}s";
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
            return "{$date['hours']}:{$date['minutes']} {$date['mday']}/{$date['mon']}";
        } return null;
    }

    public static function formatGender($gender) {
        $data = [
            "male"   => "Anh",
            "female" => "Chị"
        ];
        return $data[$gender];
    }
}
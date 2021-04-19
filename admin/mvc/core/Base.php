<?php

class Base
{

    // public $baseURLClient = "http://localhost/tienichnhabep.vn/";
    // public $baseURLAdmin  = "http://localhost/tienichnhabep.vn/admin/";

    public $baseURLClient = "https://tienichnhabep.vn/";
    public $baseURLAdmin  = "https://tienichnhabep.vn/admin/";



    public function getBaseURLClient($url = null)
    {
        return $this->baseURLClient . $url;
    }

    public function getBaseURLAdmin($url = null)
    {
        return $this->baseURLAdmin . $url;
    }

    public function getLayOut($layOutName, $data = [])
    {
        $base = new Base;
        $path = LAYOUTSPATH . DIRECTORY_SEPARATOR . $layOutName . ".php";
        if (is_array($data)) {
            foreach ($data as $k_data => $v_data) {
                $$k_data = $v_data;
            }
        }
        if (file_exists($path)) {
            require_once $path;
        } else {
            echo "[ERROR: {$path} không tồn tại]";
        }
    }

    public function getCss($arrCss)
    {
        if (is_array($arrCss)) {
            foreach ($arrCss as $fileCssItem) {
                $path = "public/css/style/{$fileCssItem}.css";
                if (file_exists($path)) {
                    echo "<link rel='stylesheet' href='{$this->getBaseURLAdmin()}{$path}'>";
                }
            }
        }
    }
}

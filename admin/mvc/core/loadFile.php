<?php
require_once CONFIGPATH.DIRECTORY_SEPARATOR."autoLoad.php";

if(is_array($autoLoad)) {
    foreach($autoLoad as $file) {
        if(!empty($file)) {
            $path = COREPATH.DIRECTORY_SEPARATOR.$file.".php";
            if(file_exists($path)) {
                require_once $path;
            } else {
                echo "[ERROR: File {$path} không tồn tại]";
            }
        }
    }
}
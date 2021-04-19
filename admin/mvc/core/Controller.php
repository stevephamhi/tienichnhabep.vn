<?php
class Controller
{
    public function model($modelName)
    {
        $modelName = $modelName."Model";
        require_once MODELSPATH.DIRECTORY_SEPARATOR.$modelName.".php";
        return new $modelName;
    }

    public function view($viewName, $data = [])
    {
        $base = new Base;
        if(is_array($data)) {
            foreach($data as $k_data => $v_data) {
                $$k_data = $v_data;
            }
        }
        require_once VIEWSPATH.DIRECTORY_SEPARATOR.$viewName.".php";
    }
}

?>
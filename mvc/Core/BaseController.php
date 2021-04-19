<?php

class BaseController
{
    /**
     * Title: handle load view
     * Description
     *  + Path name: FolderName.fileName
     *  + Get From after folder view
     */
    protected function view($viewPath, array $data = [])
    {
        foreach($data as $key => $value) {
            $$key = $value;
        }
        $filePath = (VIEW_PATH . DIRECTORY_SEPARATOR . str_replace(".", DIRECTORY_SEPARATOR, $viewPath) . ".php");
        if(file_exists($filePath)) {
            require_once $filePath;
        } else {
            echo "file not found";
        }
    }

    /**
     * Title: handle load model
     */
    protected function model($modelPath)
    {
        require_once (MODEL_PATH . DIRECTORY_SEPARATOR . $modelPath . ".php");
        return new $modelPath;
    }
}
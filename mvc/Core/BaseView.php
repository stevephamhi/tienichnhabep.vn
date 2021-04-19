<?php

function view($viewPath, array $data = [])
{
    foreach($data as $key => $value) {
        $$key = $value;
    }
    require (VIEW_PATH . DIRECTORY_SEPARATOR . str_replace(".", DIRECTORY_SEPARATOR, $viewPath) . ".php");
}
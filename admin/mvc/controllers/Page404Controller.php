<?php

class Page404Controller extends Controller
{
    public function error404()
    {
        $this->view("404");
    }
}
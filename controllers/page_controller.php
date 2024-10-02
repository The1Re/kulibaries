<?php

class PageController
{
    public function home()
    {
        require('views/page/home.php');
    }

    public function error()
    {
        require('views/page/error.php');
    }
}
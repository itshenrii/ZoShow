<?php

class SiteController
{
    public function home()
    {
        require_once BASE_PATH . '/config/database.php';
        include BASE_PATH . '/app/Views/site/home.php';
    }
}

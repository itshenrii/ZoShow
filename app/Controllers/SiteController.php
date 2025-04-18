<?php

class SiteController
{
    public function home()
    {
        require_once BASE_PATH . '/config/database.php';
        include BASE_PATH . '/app/Views/site/home.php';
    }

    public function dashboarduser()
    {
        if (session_status() === PHP_SESSION_NONE) session_start();

        if (!isset($_SESSION['usuario'])) {
            header('Location: /public/login');
            exit;
        }

        include BASE_PATH . '/app/Views/user/dashboard.php';
    }
}

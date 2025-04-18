<?php

class Controller
{
    public function view($view, $data = [])
    {
        extract($data);
        require BASE_PATH . "/app/Views/{$view}.php";
    }
}

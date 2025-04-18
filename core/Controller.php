<?php
class Controller {
    public function view($view, $data = []) {
        extract($data);
        require "../app/Views/$view.php";
    }
}
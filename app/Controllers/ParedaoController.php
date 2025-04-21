<?php
class ParedaoController {
    public function index() {
        $this->view("site/paredao", []);
    }

    public function view($view, $data = []) {
        // Load the view file and pass the data to it
        require_once BASE_PATH . "/app/Views/" . $view . ".php";
    }
}
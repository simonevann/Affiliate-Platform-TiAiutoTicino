<?php

class AdminController
{
    public $viewName;
    public $id;

    public function render()
    {
        require_once('views/template/head.php');
        require_once('views/partials/' . $this->viewName . '.php');
        require_once('views/template/footer.php');
    }

    public function __construct($page = 'dashboard', $id = null)
    {
        $this->viewName = $page;
        $this->id = $id;
    }

}   
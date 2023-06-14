<?php
/**
 * Controller base per la gestione delle pagine admin.
 * Da qui partono tutti i controller per le pagine admin.
 */
class AdminController
{
    public $viewName;
    public $id;

    /**
     * Render della struttura base della pagina
     *
     * @return void
     */
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
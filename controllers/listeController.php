<?php
class ListeController extends Controller
{
    public function __construct($name)
    {
        parent::__construct($name);
    }

    public function render()
    {
        $this->view->render("liste/liste");
    }
}
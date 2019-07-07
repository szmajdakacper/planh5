<?php
class BearbeitenController extends Controller
{
    public function __construct($name)
    {
        parent::__construct($name);
    }

    public function render()
    {
        $this->view->render("bearbeiten/bearbeiten");
    }

    public function bearbeiten($nrzim = 0)
    {
        $this->model->bearbeiten($nrzim);
    }
    
    public function aendern()
    {
        $date = $_POST;
        $this->model->aendern($date);
    }
}
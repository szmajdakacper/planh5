<?php
class HinzufuegenController extends Controller
{
    public function __construct($name)
    {
        parent::__construct($name);
    }
    public function render()
    {
        $this->view->render("hinzufuegen/hinzufuegen");
    }
    public function addieren()
    {
        $data = $_POST;
        $this->model->addieren($data);
    }
    public function random_dates()
    {
        $this->model->random_dates();
    }
}
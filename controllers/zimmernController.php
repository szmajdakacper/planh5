<?php
class ZimmernController extends Controller
{
    public function __construct($name)
    {
        parent::__construct($name);
    }

    public function render()
    {
        $this->view->render("zimmern/verfuegen");
    }

    public function zimmerAddieren()
    {
        $data = $_POST;
        $this->model->zimmerAddieren($data);
    }

    public function zimmerLoeschen($nrzim)
    {
        $this->model->zimmerLoeschen($nrzim);
    }

    public function stationAendern($nrzim, $neuStation)
    {
        $this->model->stationAendern($nrzim, $neuStation);
    }
}
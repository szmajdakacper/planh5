<?php
class LoeschenController extends Controller
{
  function __construct($name)
  {
    parent::__construct($name);
  }

  function render()
  {
    $this->view->render("loeschen/loeschen");
  }

  function fragen($nrzim = 0)
  {
    $this->model->fragen($nrzim);
  }

  function loeschen()
  {
    $data = $_POST;
    $this->model->loeschen($data);
  }
}

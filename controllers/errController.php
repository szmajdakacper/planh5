<?php
class Err extends Controller
{

  function __construct($name)
  {
    parent::__construct($name);
  }
  function render()
  {
    $this->view->render("err/err");
  }
}

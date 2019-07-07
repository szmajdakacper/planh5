<?php
class KarteController extends Controller
{
  function __construct($name)
  {
    parent::__construct($name);
  }

  function render()
  {
    $this->view->render("karte/karte");
  }

  function karte($nrzim = 0)
  {
    $this->view->setParam($nrzim);
    $this->view->render("karte/karte");
  }
}

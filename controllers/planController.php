<?php
class PlanController extends Controller
{
  function __construct($name)
  {
    parent::__construct($name);
  }

  function render()
  {
    $this->view->render("plan/plan");
  }

  function planSchaffen($station, $woche)
  {
    $this->model->planSchaffen($station, $woche);
  }


}

<?php
class Controller
{
  public function __construct($name)
  {
    $this->loadModel($name);
    $this->view = new View();
  }

  public function loadModel($name)
  {
    $model = "models/".$name."_model.php";
    if(file_exists($model))
    {
      require $model;
      $modelName = ucfirst($name)."_Model";
      $this->model = new $modelName();
    }
  }
}

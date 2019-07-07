<?php
class Bootstrap
{
    public function __construct()
    {
        if (isset($_GET['url'])) {
            $url = explode("/", (rtrim($_GET['url'], "/")));
        } else {
            $url[0] = "start";
        }

        //load Controller
        $file = "controllers/".$url[0]."Controller.php";
        if (!file_exists($file)) {
            require_once("controllers/errController.php");
            $e = new Err();
            return false;
        }

        require_once($file);
        $class = ucfirst($url[0])."Controller";
        $controller = new $class($url[0]);

        //methods
        if (isset($url[1])) {
            if (!method_exists($controller, $url[1])) {
                $controller->render();
                return false;
            } elseif (isset($url[3])) {
                $controller->{$url[1]}($url[2], $url[3]);
            } elseif (isset($url[2])) {
                $controller->{$url[1]}($url[2]);
            } else {
                $controller->{$url[1]}();
            }
        } else {
            $controller->render();
        }
    }
}
<?php
class StartController extends Controller
{
    public function __construct($name)
    {
        parent::__construct($name);
    }

    public function render()
    {
        $this->view->render("start/logged");
    }

    public function login()
    {
        $data = $_POST;
        $this->model->login($data);
    }

    public function unlogged()
    {
        $this->view->unlogged();
    }

    public function logout()
    {
        session_destroy();
        $this->view->unlogged();
    }

    public function station($nr)
    {
        $_SESSION['station'] = $nr;
        header('Location:'.$_SESSION['returnTo']);
    }
}
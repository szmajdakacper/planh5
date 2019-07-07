<?php
class view
{
    public $param;

    public function setParam($param)
    {
        $this->param = $param;
    }
    public function render($address)
    {
        require("views/header.php");
        require("views/".$address.".php");
        require("views/footer.php");
    }

    public function unlogged()
    {
        require("views/start/start.php");
    }
}
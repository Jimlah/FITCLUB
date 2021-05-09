<?php

require_once(__DIR__ . './../Functions/function.php');

class Controller
{

    protected $paths = [];

    protected static $_instance;

    public function __construct()
    {
        // if (alert("FITSESSID")) {
        //     header("Location: /dashboard/index.php");
        //     exit();
        // }else{
        //     header("Location: /login/index.php");
        //     exit();
        // }
    }

    protected function notPublic($session)
    {
        if (!alert("FITSESSID") ) {
            header("Location: /login/index.php");
            exit();
        }
    }

    protected function notMember($session)
    {
        if (!alert("FITSESSID") ) {
            header("Location: /_404.php");
            exit();
        }
    }

    protected function loggedIn($session)
    {
        if (alert("FITSESSID") ) {
            header("Location: /dashboard/index.php");
            exit();
        }
    }
}

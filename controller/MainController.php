<?php

require_once(__DIR__ . './Controller.php');
require_once(__DIR__ . './../model/ClassModel.php');

class IndexController extends Controller
{

    public function __construct()
    {
        
    }
    
     /**
     * return the current user class
     *
     * @param  mixed $data
     * @return void
     */
    public function index()
    {
        $this->notPublic(alert("FITSESSID"));

        $class = ClassModel::find(alert("FITSESSID")["id"]);

        return $class;
    }
    
    
}

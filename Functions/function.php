<?php

function dd($data, $die = true)
{
    echo "<pre>";
    var_dump($data);
    echo "</pre>";

    if ($die == true) {
        die();
    }
    return;
}


function filterInputs($variable, $filterType)
{
    return filter_var($variable, filter_id($filterType));
}

function register_session($name, $message)
{
    $_SESSION[$name] = $message;
}

function flash($name, $message){
    register_session($name, $message);
}

function alert($name)
{
    $msg = $_SESSION[$name] ?? "";
    return $msg;
}

function remove_session($name){
    
    unset($_SESSION[$name]);
}
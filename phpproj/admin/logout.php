<?php
    session_start();
    foreach($_SESSION as $var) //unset all ses variables 
    {
        unset($var);
    }
    session_destroy();
    header("location:/phpproj/admin"); 
?>
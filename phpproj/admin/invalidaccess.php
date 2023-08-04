<?php
if(!isset($_SESSION['adminname']))
{
    $_SESSION['error'] =  "Please Login to View Your Admin Screen.";
    header("location: /phpproj/admin");
}
?>
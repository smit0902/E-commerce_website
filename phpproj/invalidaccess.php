<?php
if(!isset($_SESSION['username']))
{
    $_SESSION['error'] =  "Please Login to View Your Screen.";
    header("location: /phpproj/");
}
?>
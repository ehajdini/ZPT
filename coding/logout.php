<?php
/**
 * Created by PhpStorm.
 * User: Planet
 * Date: 7/14/2016
 * Time: 12:06 PM
 */
session_start();
if(session_destroy()) // Destroying All Sessions
{
    header("location: index.php"); // Redirecting To Home Page
}
?>
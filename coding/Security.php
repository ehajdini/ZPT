<?php
/**
 * Created by PhpStorm.
 * User: Planet
 * Date: 12/23/2016
 * Time: 11:15 AM
 */



abstract class Security
{
    public function filter_html($string){
        return htmlspecialchars($string);
    }
    public function escape($string){
        return mysqli_real_escape_string($string);
    }
}
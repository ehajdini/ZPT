<?php
/**
 * Created by PhpStorm.
 * User: Planet
 * Date: 12/23/2016
 * Time: 11:10 AM
 */




interface CRUD
{
    public function create($object);
    public function read();
    public function delete($id);
    public function update($object);

}
<?php

/**
 * Created by PhpStorm.
 * User: german
 * Date: 17-06-10
 * Time: 9.07.PD
 */
require_once ("CRUD.php");
require_once ("DB.php");
require_once ("validate_class.php");
require_once ("assistance.php.php");
class crud_assistance implements CRUD
{

    private $db;
    private $connection;
    private $validate;
    private $error;

    public function __construct()
    {
        $this->db=new DB();
        $this->connection=$this->db->establishConnection();
    }

    public function create($object)
    {
        // TODO: Implement create() method.
    }

    public function read()
    {
        // TODO: Implement read() method.
    }

    public function delete($id)
    {
        // TODO: Implement delete() method.
    }

    public function update($object)
    {
        // TODO: Implement update() method.
    }
}
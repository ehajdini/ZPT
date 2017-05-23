<?php

/**
 * Created by PhpStorm.
 * User: german
 * Date: 17-05-22
 * Time: 7.59.MD
 */
require_once ("CRUD.php");
require_once ("DB.php");
class crud_class implements CRUD
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
        $query="SELECT * FROM staff ";
        $result = $this->connection->query($query);
        return $result;
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
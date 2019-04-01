<?php

/**
 * Created by PhpStorm.
 * User: german
 * Date: 17-06-11
 * Time: 12.55.MD
 */
class crud_business implements CRUD
{

    public function __construct()
    {
        $this->db=new DB();
        $this->connection=$this->db->establishConnection();
    }

    /**
     * @return mixed
     */
    public function getError()
    {
        return $this->error;
    }

    public function create($object)
    {
        // TODO: Implement create() method.
    }

    public function read()
    {

        $query="SELECT * FROM business";
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
<?php
/**
 * Created by PhpStorm.
 * User: Anisa Oshafi
 */
class Business{
    private $nipt;
    private $name;
    private $username;
    private $nr_of_workers;
    private $nr_of_vacant_pos;

    /**
     * Business constructor.
     * @param $nipt
     * @param $name
     * @param $username
     * @param $nr_of_workers
     * @param $nr_of_vacant_pos
     */
    public function __construct($nipt, $name, $username, $nr_of_workers, $nr_of_vacant_pos)
    {
        $this->nipt = $nipt;
        $this->name = $name;
        $this->username = $username;
        $this->nr_of_workers = $nr_of_workers;
        $this->nr_of_vacant_pos = $nr_of_vacant_pos;
    }


    public function getNipt()
    {
        return $this->nipt;
    }


    public function setNipt($nipt)
    {
        $this->nipt = $nipt;
    }


    public function getName()
    {
        return $this->name;
    }


    public function setName($name)
    {
        $this->name = $name;
    }


    public function getUsername()
    {
        return $this->username;
    }


    public function setUsername($username)
    {
        $this->username = $username;
    }


    public function getNrOfWorkers()
    {
        return $this->nr_of_workers;
    }


    public function setNrOfWorkers($nr_of_workers)
    {
        $this->nr_of_workers = $nr_of_workers;
    }


    public function getNrOfVacantPos()
    {
        return $this->nr_of_vacant_pos;
    }


    public function setNrOfVacantPos($nr_of_vacant_pos)
    {
        $this->nr_of_vacant_pos = $nr_of_vacant_pos;
    }



}
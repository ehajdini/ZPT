<?php

/**
 * Created by PhpStorm.
 * User: german
 * Date: 17-06-11
 * Time: 12.55.MD
 */
class business
{

    private $nipt;
    private $name;
    private $num_of_workers;
    private $about;
    private $email;
    private $phone;

    /**
     * business constructor.
     * @param $nipt
     * @param $name
     * @param $num_of_workers
     * @param $about
     * @param $email
     * @param $phone
     */
    public function __construct($nipt, $name, $num_of_workers, $about, $email, $phone)
    {
        $this->nipt = $nipt;
        $this->name = $name;
        $this->num_of_workers = $num_of_workers;
        $this->about = $about;
        $this->email = $email;
        $this->phone = $phone;
    }

    /**
     * @return mixed
     */
    public function getNipt()
    {
        return $this->nipt;
    }

    /**
     * @param mixed $nipt
     */
    public function setNipt($nipt)
    {
        $this->nipt = $nipt;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getNumOfWorkers()
    {
        return $this->num_of_workers;
    }

    /**
     * @param mixed $num_of_workers
     */
    public function setNumOfWorkers($num_of_workers)
    {
        $this->num_of_workers = $num_of_workers;
    }

    /**
     * @return mixed
     */
    public function getAbout()
    {
        return $this->about;
    }

    /**
     * @param mixed $about
     */
    public function setAbout($about)
    {
        $this->about = $about;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @param mixed $phone
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
    }


}
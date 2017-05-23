<?php

/**
 * Created by PhpStorm.
 * User: german
 * Date: 17-05-22
 * Time: 7.48.MD
 */
class validate_class
{
    private $id;
    private $password;

    private $pregid="/^[a-zA-Z0-9_.-]*$/";
    private $pregpassword="/^(?=.*\d)(?=.*[a-z])(?=.*[A-z]).{5,16}$/";

    /**
     * validate_class constructor.
     * @param $id
     * @param $password
     */
    public function __construct($id, $password)
    {
        $this->id = $id;
        $this->password = $password;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }



    public function validate_id(){
        $this->id=htmlspecialchars($this->id);
        $this->id=@mysqli_real_escape_string($this->id);
        if (!preg_match($this->pregid,$this->id)){
            $this->error="Personal ID must meet the requirements";
            return false;
        }
        return true;
    }

    public function validatepassword(){

        $this->password=htmlspecialchars($this->password);
        $this->password=@mysqli_real_escape_string($this->password);
        if(!preg_match($this->pregpassword,$this->password)){
            $this->error="Password must meet the requirements";
            return false;
        }
        return true;
    }
}
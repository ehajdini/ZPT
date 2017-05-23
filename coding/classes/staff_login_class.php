<?php

/**
 * Created by PhpStorm.
 * User: german
 * Date: 17-05-22
 * Time: 7.08.MD
 */
require_once ("crud_class.php");
class staff_login_class
{
    private $crud;
    private $id;
    private $directory;
    private $password;
    private $name;
    private $surname;

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
    public function getDirectory()
    {
        return $this->directory;
    }

    /**
     * @param mixed $directory
     */
    public function setDirectory($directory)
    {
        $this->directory = $directory;
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
    public function getSurname()
    {
        return $this->surname;
    }

    /**
     * @param mixed $surname
     */
    public function setSurname($surname)
    {
        $this->surname = $surname;
    }



    /**
     * staff_login_class constructor.
     * @param $id
     * @param $directory
     * @param $password
     */
    public function __construct($id,$directory,$password)
    {
        $this->id = $id;
        $this->directory = $directory;
        $this->password = md5($password);
        $this->crud=new crud_class();
    }

    public function login(){
        $result=$this->crud->read();
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                if($row["id"]==$this->id && $row["password"]==$this->password && $row["directory"]==$this->directory) {
                   echo "Success";
                    return true;
                }

//                echo "id: " . $row["id"]. " - Name: " . $row["username"]. " " . $row["password"]. $this->username." ".$this->password."<br>";
            }
        }
        return false;
    }

}
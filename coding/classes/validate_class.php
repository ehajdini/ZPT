<?php
/**
 * Created by PhpStorm.
 * User: Planet
 * Date: 12/23/2016
 * Time: 11:21 AM
 */


class validate_class
{
    private $pregpassword="/^(?=.*\d)(?=.*[a-z])(?=.*[A-z]).{8,16}$/";
    private $pregphone="/^(\(?\+?[0-9]*\)?)?[0-9_\- \(\)]*$/";
    private $pregid="/^[A-Z]{1}[0-9]{8}[A-Z]{1}$/";
    private $pregoffice="/^[A-Z]{1}[0-9]{3}$/";

    private $name;
    private $surname;
    private $password;
    private $id;
    private $position;
    private $email;
    private $phone;
    private $error="";
    private $office="";

    /**
     * validate_class constructor.
     * @param $username
     * @param $password
     * @param $email
     * @param $phone
     */

    public function __construct($name,$surname,$id,$email,$phone,$position)
    {
        $this->name = $name;
        $this->surname = $surname;
        $this->id=$id;
        $this->email = $email;
        $this->phone = $phone;
        $this->position = $position;
//        $this->office=$office;
    }

    public function validatepassword(){

        $this->password=htmlspecialchars($this->password);
        if(!preg_match($this->pregpassword,$this->password)){
            $this->error="<div class=\"style-msg errormsg\">
							<div class=\"sb-msg\"><i class=\"icon-remove\"></i><strong>Oh snap!</strong>Password must meet the requirements</div>
						</div>";
            return false;
        }
        return true;
    }
    public function validateoffice(){

        if(!preg_match($this->pregoffice,$this->office)){
            $this->error="<div class=\"style-msg errormsg\">
							<div class=\"sb-msg\"><i class=\"icon-remove\"></i><strong>Oh snap!</strong>Wrong office number</div>
						</div>";
            return false;
        }
        return true;
    }

    public function validateid(){

        $this->id=htmlspecialchars($this->id);
        if(!preg_match($this->pregid,$this->id)){
            $this->error="<div class=\"style-msg errormsg\">
							<div class=\"sb-msg\"><i class=\"icon-remove\"></i><strong>Oh snap!</strong>ID must be in the following format the J12345678K</div>
						</div>";
            return false;
        }
        return true;
    }

    public function validatephonenumber(){
        $this->phone=htmlspecialchars($this->phone);
        if(! preg_match($this->pregphone,$this->phone)){
            $this->error= "<div class=\"style-msg errormsg\">
							<div class=\"sb-msg\"><i class=\"icon-remove\"></i><strong>Oh snap!</strong>Phone number must meet the requirements</div>
						</div>";
            return false;
        }
        return true;
    }

    public function validate(){
        if($this->validateid() && $this->validatephonenumber() && filter_var($this->email, FILTER_VALIDATE_EMAIL)
            && ctype_alpha($this->name)&& ctype_alpha($this->surname)&& ctype_alpha($this->position))return true;
//        echo $this->username." ".$this->password." ".$this->email." ".$this->name." ".$this->phone." ";

        return false;
    }
    public function getError(){
        return $this->error;
    }
}
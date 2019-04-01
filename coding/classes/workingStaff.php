<?php

/**
 * Created by PhpStorm.
 * User: german
 * Date: 17-06-03
 * Time: 8.49.PD
 */
class workingStaff
{
    private $id;
    private $name;
    private $surname;
    private $email;
    private $phone;
    private $position;
    private $startingDay;
    private $workingDays;
    private $salary;
    private $office;
    private $gender;

    /**
     * workingStaff constructor.
     * @param $id
     * @param $name
     * @param $surname
     * @param $email
     * @param $phone
     * @param $position
     * @param $startingDay
     * @param $workingDays
     * @param $salary
     */
    public function __construct($id, $name, $surname, $email, $phone, $position, $startingDay, $workingDays, $salary,$office,$gender)
    {
        $this->id = $id;
        $this->name = $name;
        $this->surname = $surname;
        $this->email = $email;
        $this->phone = $phone;
        $this->position = $position;
        $this->startingDay = $startingDay;
        $this->workingDays = $workingDays;
        $this->salary = $salary;
        $this->office = $office;
        $this->gender = $gender;
    }

    /**
     * @return mixed
     */
    public function getOffice()
    {
        return $this->office;
    }

    /**
     * @param mixed $office
     */
    public function setOffice($office)
    {
        $this->office = $office;
    }

    /**
     * @return mixed
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * @param mixed $gender
     */
    public function setGender($gender)
    {
        $this->gender = $gender;
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

    /**
     * @return mixed
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * @param mixed $position
     */
    public function setPosition($position)
    {
        $this->position = $position;
    }

    /**
     * @return mixed
     */
    public function getStartingDay()
    {
        return $this->startingDay;
    }

    /**
     * @param mixed $startingDay
     */
    public function setStartingDay($startingDay)
    {
        $this->startingDay = $startingDay;
    }

    /**
     * @return mixed
     */
    public function getWorkingDays()
    {
        return $this->workingDays;
    }

    /**
     * @param mixed $workingDays
     */
    public function setWorkingDays($workingDays)
    {
        $this->workingDays = $workingDays;
    }

    /**
     * @return mixed
     */
    public function getSalary()
    {
        return $this->salary;
    }

    /**
     * @param mixed $salary
     */
    public function setSalary($salary)
    {
        $this->salary = $salary;
    }

    public function loadContent($conn){
        $sql="SELECT * from staff";
        $result = $conn->query($sql);
        return $result;
    }
    public function insertWorker($conn){
        $name = mysqli_real_escape_string($conn, $this->getName());
        $surname = mysqli_real_escape_string($conn, $this->getSurname());
        $id = mysqli_real_escape_string($conn, $this->getId());
        $phone = mysqli_real_escape_string($conn, $this->getPhone());
        $email = mysqli_real_escape_string($conn, $this->getEmail());
        $position= mysqli_real_escape_string($conn, $this->getPosition());
        $startDate = mysqli_real_escape_string($conn, $this->getStartingDay());
        $workingDays = mysqli_real_escape_string($conn, $this->getWorkingDays());
        $salary= mysqli_real_escape_string($conn, $this->getSalary());
        $sql="INSERT INTO staff(id,name,surname,email,phone,position,startingdays,workingdays,salary)VALUES 
('$id', '$name','$surname','$email','$phone','$position','$startDate','$workingDays','$salary')";


        if (mysqli_query($conn, $sql)) {
            echo "<div class=\"style-msg successmsg\">
							<div class=\"sb-msg\"><i class=\"icon-thumbs-up\"></i><strong>Well done!</strong> Your records are added successfully.</div>
						</div>";
        } else {
            echo "<div class=\"style-msg errormsg\">
							<div class=\"sb-msg\"><i class=\"icon-remove\"></i><strong>Oh snap!</strong> Change a few things up and try submitting again.</div>
						</div>";
        }
    }

}
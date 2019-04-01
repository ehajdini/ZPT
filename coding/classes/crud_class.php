<?php

/**
 * Created by PhpStorm.
 * User: german
 * Date: 17-05-22
 * Time: 7.59.MD
 */
require_once ("CRUD.php");
require_once ("DB.php");
require_once ("validate_class.php");
require_once ("workingStaff.php");
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
        $name= $object->getName();
        $surname = $object->getSurname();
        $id = $object->getId();
        $phone = $object->getPhone();
        $email = $object->getEmail();
        $position=$object->getPosition();
        $startDate = $object->getStartingDay();
        $workingDays = $object->getWorkingDays();
        $salary= $object->getSalary();
        $gender= $object->getGender();
        $office= $object->getOffice();


        $this->validate=new validate_class($name,$surname,$id,$email,$phone,$position);
        if($this->validate->validate()) {
            $name=mysqli_real_escape_string($this->connection,$name);
            $surname=mysqli_real_escape_string($this->connection,$surname);
            $id=mysqli_real_escape_string($this->connection,$id);
            $phone=mysqli_real_escape_string($this->connection,$phone);
            $email=mysqli_real_escape_string($this->connection,$email);
            $position=mysqli_real_escape_string($this->connection,$position);
            $startDate=mysqli_real_escape_string($this->connection,$startDate);
            $workingDays=mysqli_real_escape_string($this->connection,$workingDays);
            $salary=mysqli_real_escape_string($this->connection,$salary);
            $gender=mysqli_real_escape_string($this->connection,$gender);
            $office=mysqli_real_escape_string($this->connection,$office);

            $sql = "INSERT INTO staff(id,name,surname,email,phone,position,startingdate,workingdays,salary,gender,office)
VALUES('$id','$name','$surname','$email','$phone','$position','$startDate','$workingDays','$salary','$gender','$office')";
            $q= "INSERT INTO salary(pid,base) VALUES ('$id','0')";

            if (mysqli_query($this->connection, $sql) && mysqli_query($this->connection, $q)) {
                $this->error= "<div class=\"style-msg successmsg\">
							<div class=\"sb-msg\"><i class=\"icon-thumbs-up\"></i><strong>Well done!</strong> Your records are added successfully.</div>
						</div>";
            } else {
                $this->error= "<div class=\"style-msg errormsg\">
							<div class=\"sb-msg\"><i class=\"icon-remove\"></i><strong>Oh snap!</strong> Change a few things and try again.</div>
						</div>";
            }
        }
        else $this->error= $this->validate->getError();
    }

    /**
     * @return mixed
     */
    public function getError()
    {
        return $this->error;
    }


    public function assignDirectory($id,$directory){
        $id=mysqli_real_escape_string($this->connection,$id);
        $directory=mysqli_real_escape_string($this->connection,$directory);
        $pass=$this->randomPassword();
        $p=$pass;
        $password=md5($pass);
        $squery="UPDATE staff set directory='$directory', password='$password' where id='$id'";
        if (mysqli_query($this->connection, $squery)) {
            $this->error= "<div class=\"style-msg successmsg\">
							<div class=\"sb-msg\"><i class=\"icon-thumbs-up\"></i><strong><?php echo $p?>Well done!</strong>Directory assigned succesfully.
							Random generated password is:<b></b></div>
						</div>";
        } else {
            $this->error= "<div class=\"style-msg errormsg\">
							<div class=\"sb-msg\"><i class=\"icon-remove\"></i><strong>Oh snap!</strong>Try again.</div>
						</div>";
        }

    }

    public function read()
    {
        $query="SELECT * FROM staff ";
        $result = $this->connection->query($query);
        return $result;
    }

    function randomPassword() {
        $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
        $pass = array(); //remember to declare $pass as an array
        $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
        for ($i = 0; $i < 8; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        return implode($pass); //turn the array into a string
    }

    public function getDirectory()
    {
        $query="SELECT * FROM staff where directory IS NULL";
        $result = $this->connection->query($query);
        return $result;
    }

    public function attendance($id){
        $id=mysqli_real_escape_string($this->connection,$id);
        $query="SELECT * FROM staff where id='$id'";
        $result = $this->connection->query($query);
        $row = $result->fetch_assoc();
        $day=$row['workingdays'];
        $day=$day+1;
        $sqlquery="UPDATE staff SET workingdays='$day' WHERE id='$id'";
        if (mysqli_query($this->connection, $sqlquery)) {
            $this->error= "<div class=\"style-msg successmsg\">
							<div class=\"sb-msg\"><i class=\"icon-thumbs-up\"></i><strong>Well done!</strong> Your attendance is updated.</div>
						</div>";
        } else {
            $this->error= "<div class=\"style-msg errormsg\">
							<div class=\"sb-msg\"><i class=\"icon-remove\"></i><strong>Oh snap!</strong>Try again.</div>
						</div>";
        }
    }
    public function calculateSalary(){
        $query="UPDATE staff,salary set staff.salary=(salary.base/22)*staff.previouswdays WHERE staff.previouswdays>0 AND staff.previouswdays<=22 AND staff.id=salary.pid AND staff.confirmation=1";
        $squery="UPDATE staff,salary set staff.salary=salary.base WHERE staff.previouswdays>22 AND staff.id=salary.pid AND staff.confirmation=1";
        if (mysqli_query($this->connection, $query)&& mysqli_query($this->connection, $squery)) {
            $this->error= "<div class=\"style-msg successmsg\">
							<div class=\"sb-msg\"><i class=\"icon-thumbs-up\"></i><strong>Well done!</strong> Your have calculated the salaries.</div>
						</div>";
        } else {
            $this->error= "<div class=\"style-msg errormsg\">
							<div class=\"sb-msg\"><i class=\"icon-remove\"></i><strong>Oh snap!</strong>Try again.</div>
						</div>";
        }
    }

    public function insertSalary($base,$id){
        $id=mysqli_real_escape_string($this->connection,$id);
        $base=mysqli_real_escape_string($this->connection,$base);
        $squery="UPDATE salary set base='$base' where pid='$id'";
        if (mysqli_query($this->connection, $squery)) {
            $this->error= "<div class=\"style-msg successmsg\">
							<div class=\"sb-msg\"><i class=\"icon-thumbs-up\"></i><strong>Well done!</strong>The base salary for selected employee is inserted correctly</div>
						</div>";
        } else {
            $this->error= "<div class=\"style-msg errormsg\">
							<div class=\"sb-msg\"><i class=\"icon-remove\"></i><strong>Oh snap!</strong>Try again.</div>
						</div>";
        }

    }

    public function resetmonth(){
        $query="UPDATE staff set previouswdays=workingdays,workingdays=0,confirmation=1";
        if (mysqli_query($this->connection, $query)) {
            $this->error= "<div class=\"style-msg successmsg\">
							<div class=\"sb-msg\"><i class=\"icon-thumbs-up\"></i><strong>Well done!</strong>The working days are updated</div>
						</div>";
        } else {
            $this->error= "<div class=\"style-msg errormsg\">
							<div class=\"sb-msg\"><i class=\"icon-remove\"></i><strong>Oh snap!</strong>Try again.</div>
						</div>";
        }

    }

    public function confirmSalary(){
        $query="UPDATE staff set confirmation=0";
        if (mysqli_query($this->connection, $query)) {
            $this->error= "<div class=\"style-msg successmsg\">
							<div class=\"sb-msg\"><i class=\"icon-thumbs-up\"></i><strong>Well done!</strong>Salaries are confirmed from Drejtoria e Financave</div>
						</div>";
        } else {
            $this->error= "<div class=\"style-msg errormsg\">
							<div class=\"sb-msg\"><i class=\"icon-remove\"></i><strong>Oh snap!</strong>Try again.</div>
						</div>";
        }

    }
    public function updatePassword($id,$password){
        $password=md5($password);
        $password=mysqli_real_escape_string($this->connection,$password);
        $query="UPDATE staff set password='$password' where id='$id'";
        if (mysqli_query($this->connection, $query)) {
            $this->error= "<div class=\"style-msg successmsg\">
							<div class=\"sb-msg\"><i class=\"icon-thumbs-up\"></i><strong>Password</strong> changed.Log in again</div>
						</div>";
        } else {
            $this->error= "<div class=\"style-msg errormsg\">
							<div class=\"sb-msg\"><i class=\"icon-remove\"></i><strong>Oh snap!</strong>Try again.</div>
						</div>";
        }

    }

    public function delete($id)
    {
        $id = mysqli_real_escape_string($this->connection, $id);
        $query = "DELETE FROM staff where id='$id'";
        if (mysqli_query($this->connection, $query)) {
            $this->error = "<div class=\"style-msg successmsg\">
							<div class=\"sb-msg\"><i class=\"icon-thumbs-up\"></i><strong>Well done!</strong> Records are deleted successfully.</div>
						</div>";
        } else {
            $this->error = "<div class=\"style-msg errormsg\">
							<div class=\"sb-msg\"><i class=\"icon-remove\"></i><strong>Oh snap!</strong> Change a few things and try again.</div>
						</div>";
        }
    }

    public function update($object)
    {
        // TODO: Implement update() method.
    }
}
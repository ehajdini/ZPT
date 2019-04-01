<?php

/**
 * Created by PhpStorm.
 * User: german
 * Date: 17-06-10
 * Time: 9.14.PD
 */

require_once ("CRUD.php");
require_once ("DB.php");
require_once ("validate_class.php");
require_once ("jobseeker.php");
class crud_jobseekers implements CRUD
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

    /**
     * @return mixed
     */
    public function getError()
    {
        return $this->error;
    }

    public function confirmAssistance($id){
        $id=mysqli_real_escape_string($this->connection,$id);
        $query="UPDATE assistance SET assistance_confirmation='1' WHERE jobseeker_id='$id'";
        if (mysqli_query($this->connection, $query)) {
            $this->error= "<div class=\"style-msg successmsg\">
							<div class=\"sb-msg\"><i class=\"icon-thumbs-up\"></i><strong>Well done!</strong>Records updated succesfully</div>
						</div>";
        } else {
            $this->error= "<div class=\"style-msg errormsg\">
							<div class=\"sb-msg\"><i class=\"icon-remove\"></i><strong>Oh snap!</strong>Try again.</div>
						</div>";
        }
    }
    public function confirmAppointment($id){
        $id=mysqli_real_escape_string($this->connection,$id);
        $query="UPDATE consulence SET consulence_confirmation='1' WHERE jobseeker_id='$id'";
        if (mysqli_query($this->connection, $query)) {
            $this->error= "<div class=\"style-msg successmsg\">
							<div class=\"sb-msg\"><i class=\"icon-thumbs-up\"></i><strong>Well done!</strong>Records updated succesfully</div>
						</div>";
        } else {
            $this->error= "<div class=\"style-msg errormsg\">
							<div class=\"sb-msg\"><i class=\"icon-remove\"></i><strong>Oh snap!</strong>Try again.</div>
						</div>";
        }
    }

    public function calculateAssistance($id){
        $id=mysqli_real_escape_string($this->connection,$id);
        $query="UPDATE assistance SET money='7000' WHERE jobseeker_id='$id'";
        if (mysqli_query($this->connection, $query)) {
            $this->error= "<div class=\"style-msg successmsg\">
							<div class=\"sb-msg\"><i class=\"icon-thumbs-up\"></i><strong>Well done!</strong>Assistance Calculated</div>
						</div>";
        } else {
            $this->error= "<div class=\"style-msg errormsg\">
							<div class=\"sb-msg\"><i class=\"icon-remove\"></i><strong>Oh snap!</strong>Try again.</div>
						</div>";
        }
    }

    public function refuseAssistance($id){
        $id=mysqli_real_escape_string($this->connection,$id);
        $query="UPDATE assistance SET assistance_request='0' WHERE jobseeker_id='$id'";
        if (mysqli_query($this->connection, $query)) {
            $this->error= "<div class=\"style-msg successmsg\">
							<div class=\"sb-msg\"><i class=\"icon-thumbs-up\"></i><strong>Well done!</strong>Records updated succesfully</div>
						</div>";
        } else {
            $this->error= "<div class=\"style-msg errormsg\">
							<div class=\"sb-msg\"><i class=\"icon-remove\"></i><strong>Oh snap!</strong>Try again.</div>
						</div>";
        }
    }

    public function refuseAppointment($id){
        $id=mysqli_real_escape_string($this->connection,$id);
        $query="UPDATE consulence SET consulence_request='0' WHERE jobseeker_id='$id'";
        if (mysqli_query($this->connection, $query)) {
            $this->error= "<div class=\"style-msg successmsg\">
							<div class=\"sb-msg\"><i class=\"icon-thumbs-up\"></i><strong>Well done!</strong>Records updated succesfully</div>
						</div>";
        } else {
            $this->error= "<div class=\"style-msg errormsg\">
							<div class=\"sb-msg\"><i class=\"icon-remove\"></i><strong>Oh snap!</strong>Try again.</div>
						</div>";
        }
    }


    public function assistance($id){
        $id=mysqli_real_escape_string($this->connection,$id);
        $query="UPDATE assistance SET assistance_request='1' WHERE jobseeker_id='$id'";
        if (mysqli_query($this->connection, $query)) {
            $this->error= "<div class=\"style-msg successmsg\">
							<div class=\"sb-msg\"><i class=\"icon-thumbs-up\"></i><strong>Well done!</strong>Request sent succesfully</div>
						</div>";
        } else {
            $this->error= "<div class=\"style-msg errormsg\">
							<div class=\"sb-msg\"><i class=\"icon-remove\"></i><strong>Oh snap!</strong>Try again.</div>
						</div>";
        }
    }

    public function appointment($id){
        $id=mysqli_real_escape_string($this->connection,$id);
        $query="UPDATE consulence SET consulence_request='1' WHERE jobseeker_id='$id'";
        if (mysqli_query($this->connection, $query)) {
            $this->error= "<div class=\"style-msg successmsg\">
							<div class=\"sb-msg\"><i class=\"icon-thumbs-up\"></i><strong>Well done!</strong>Request sent succesfully</div>
						</div>";
        } else {
            $this->error= "<div class=\"style-msg errormsg\">
							<div class=\"sb-msg\"><i class=\"icon-remove\"></i><strong>Oh snap!</strong>Try again.</div>
						</div>";
        }
    }
    public function create($object)
    {
        $name= $object->getName();
        $surname = $object->getSurname();
        $id = $object->getId();
        $phone = $object->getPhone();
        $email = $object->getEmail();
        $profession=$object->getProfession();
        $gender = $object->getGender();


        $this->validate=new validate_class($name,$surname,$id,$email,$phone,$profession);
        if($this->validate->validate()) {
            $name = mysqli_real_escape_string($this->connection, $name);
            $surname = mysqli_real_escape_string($this->connection, $surname);
            $id = mysqli_real_escape_string($this->connection, $id);
            $phone = mysqli_real_escape_string($this->connection, $phone);
            $email = mysqli_real_escape_string($this->connection, $email);
            $profession = mysqli_real_escape_string($this->connection, $profession);
            $gender = mysqli_real_escape_string($this->connection, $gender);
            $Date=date('d-m-Y');

            $sql = "INSERT INTO jobseeker(ID,Name,Surname,Email,Number,Profession,Registerdate,Gender)
VALUES('$id','$name','$surname','$email','$phone','$profession','$Date','$gender')";

            $q="INSERT INTO assistance(jobseeker_id,assistance_request,assistance_confirmation,money)VALUES('$id','0','0','0')";
            if (mysqli_query($this->connection, $sql)&& mysqli_query($this->connection, $q)) {
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

    public function read()
    {
        $query="SELECT * FROM jobseeker";
        $result = $this->connection->query($query);
        return $result;
    }
    public function requestAssistance()
    {
        $query="SELECT * FROM assistance,jobseeker WHERE assistance.assistance_request=0 AND assistance.jobseeker_id=jobseeker.id";
        $result = $this->connection->query($query);
        return $result;
    }
    public function requestAppointment()
    {
        $query="SELECT * FROM consulence,jobseeker WHERE consulence.consulence_request=0 AND consulence.jobseeker_id=jobseeker.id";
        $result = $this->connection->query($query);
        return $result;
    }
    public function jobseekersSeekingAssistance()
    {
        $query="SELECT * FROM assistance,jobseeker WHERE assistance.assistance_request=1 AND assistance.assistance_confirmation=0 AND assistance.jobseeker_id=jobseeker.id";
        $result = $this->connection->query($query);
        return $result;
    }

    public function jobseekersSeekingLegalAdvice()
    {
        $query="SELECT * FROM consulence,jobseeker WHERE consulence.consulence_request=1 AND consulence.consulence_confirmation=0 AND consulence.jobseeker_id=jobseeker.id";
        $result = $this->connection->query($query);
        return $result;
    }

    public function jobseekersConfirmedLegalAdvice()
    {
        $query="SELECT * FROM consulence,jobseeker WHERE consulence.consulence_confirmation=1 AND consulence.jobseeker_id=jobseeker.id";
        $result = $this->connection->query($query);
        return $result;
    }
    public function jobseekersFinancialAssistance()
    {
        $query="SELECT * FROM assistance,jobseeker WHERE assistance.assistance_confirmation=1 AND assistance.money>0 AND assistance.jobseeker_id=jobseeker.id";
        $result = $this->connection->query($query);
        return $result;
    }
    public function jobseekersconfirmedAssistance()
    {
        $query="SELECT * FROM assistance,jobseeker WHERE assistance.assistance_confirmation=1 AND assistance.money=0 AND assistance.jobseeker_id=jobseeker.id";
        $result = $this->connection->query($query);
        return $result;
    }


    public function delete($id)
    {
        $query="DELETE FROM assistance where jobseeker_id='$id'";
        $q="DELETE FROM jobseeker where ID='$id'";
        if (mysqli_query($this->connection, $query)&& mysqli_query($this->connection, $q)) {
            $this->error= "<div class=\"style-msg successmsg\">
							<div class=\"sb-msg\"><i class=\"icon-thumbs-up\"></i><strong>Well done!</strong> Records are deleted successfully.</div>
						</div>";
        } else {
            $this->error= "<div class=\"style-msg errormsg\">
							<div class=\"sb-msg\"><i class=\"icon-remove\"></i><strong>Oh snap!</strong> Change a few things and try again.</div>
						</div>";
        }
    }

    public function update($object)
    {
        // TODO: Implement update() method.
    }
}
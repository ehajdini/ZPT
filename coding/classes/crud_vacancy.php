<?php

/**
 * Created by PhpStorm.
 * User: german
 * Date: 17-06-11
 * Time: 12.06.PD
 */
require_once ("CRUD.php");
require_once ("DB.php");
require_once ("validate_class.php");
require_once ("vacancy.php");
class crud_vacancy implements CRUD
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

    public function getBusiness(){
        $query="SELECT * FROM business";
        $result = $this->connection->query($query);
        return $result;
    }

    public function mediate(){
        $query="SELECT * FROM jobseeker,business,vacancy,mediation where vacancy.position=jobseeker.Profession AND vacancy.nipt=business.nipt AND mediation.pid!=jobseeker.ID";
        $result = $this->connection->query($query);
        return $result;
    }

    public function mediation($id,$nipt){
        $query="INSERT INTO mediation(pid,nipt,confirmation)VALUES('$id','$nipt','1')";
        if (mysqli_query($this->connection, $query)) {
            $this->error= "<div class=\"style-msg successmsg\">
							<div class=\"sb-msg\"><i class=\"icon-thumbs-up\"></i><strong>Well done!</strong>Mediation done successfully.</div>
						</div>";
        } else {
            $this->error= "<div class=\"style-msg errormsg\">
							<div class=\"sb-msg\"><i class=\"icon-remove\"></i><strong>Oh snap!</strong> Change a few things and try again.</div>
						</div>";
        }
    }


    public function create($object)
    {
        $nipt=$object->getNipt();
        $places=$object->getPlaces();
        $position=$object->getPosition();
        $announced_date=$object->getAnnouncedDate();

        $nipt= mysqli_real_escape_string($this->connection, $nipt);
        $places= mysqli_real_escape_string($this->connection, $places);
        $position= mysqli_real_escape_string($this->connection, $position);
        $announced_date= mysqli_real_escape_string($this->connection, $announced_date);


        $sql = "INSERT INTO vacancy(nipt,places,position,announced_date)VALUES('$nipt','$places','$position','$announced_date')";

        if (mysqli_query($this->connection, $sql)) {
            $this->error= "<div class=\"style-msg successmsg\">
							<div class=\"sb-msg\"><i class=\"icon-thumbs-up\"></i><strong>Well done!</strong> Your records are added successfully.</div>
						</div>";
        } else {
            $this->error= "<div class=\"style-msg errormsg\">
							<div class=\"sb-msg\"><i class=\"icon-remove\"></i><strong>Oh snap!</strong> Change a few things and try again.</div>
						</div>";
        }
    }

    public function read()
    {
        $query="SELECT * FROM vacancy";
        $result = $this->connection->query($query);
        return $result;
    }

    public function delete($id)
    {
        $query="DELETE FROM vacancy where id='$id'";
        if (mysqli_query($this->connection, $query)) {
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
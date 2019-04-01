<?php

/**
 * Created by PhpStorm.
 * User: german
 * Date: 17-06-10
 * Time: 8.56.MD
 */
require_once ("CRUD.php");
require_once ("DB.php");
require_once ("validate_class.php");
require_once ("trainings.php");
class crud_trainings implements CRUD
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

    public function create($object)
    {
            $title=$object->getTitle();
            $places=$object->getPlaces();
            $start=$object->getStart();
            $end=$object->getEnd();
            $description=$object->getDescription();

            $title= mysqli_real_escape_string($this->connection, $title);
            $places= mysqli_real_escape_string($this->connection, $places);
            $start= mysqli_real_escape_string($this->connection, $start);
            $end= mysqli_real_escape_string($this->connection, $end);
            $description= mysqli_real_escape_string($this->connection, $description);


        $sql = "INSERT INTO trainings(title,places,start,end,description)VALUES('$title','$places','$start','$end','$description')";

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
        $query="SELECT * FROM trainings";
        $result = $this->connection->query($query);
        return $result;
    }

    public function delete($id)
    {
        $query="DELETE FROM trainings where id='$id'";
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
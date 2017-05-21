<?php
/**
 * Created by PhpStorm.
 * User: Planet
 * Date: 12/23/2016
 * Time: 10:54 AM
 */

define("DB_HOST", "localhost");
define("DB_NAME", "web16_ehajdini14");
define("DB_USER", "ehajdini14");
define("DB_PASS", "myadmin");

class DB
{

    private $hostname;
    private $dbname;
    private $dbuser;
    private $dbpass;
    private $connection;

    /**
     * DB constructor.
     * @param $dbpass
     * @param $dbname
     * @param $dbuser
     * @param $hostname
     */
    public function __construct()
    {

        $this->hostname = DB_HOST;
        $this->dbname = DB_NAME;
        $this->dbuser = DB_USER;
        $this->dbpass = DB_PASS;
    }


     function establishConnection()
    {
        $this->connection = mysqli_connect($this->hostname, $this->dbuser, $this->dbpass,$this->dbname);
        /* check connection */
        if (mysqli_connect_errno()) {
            printf("Connect failed: %s\n", mysqli_connect_error());
            exit();
        }

        return $this->connection;
    }


    function runQuery($sql) {
        $conn = new mysqli($this->hostname,$this->dbuser,$this->dbpass,$this->dbname);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $resultset[] = $row;
            }
        }
        $conn->close();
        if(!empty($resultset))
            return $resultset;
    }


    public function __destruct()
    {
        if(is_resource($this->connection)){
            mysqli_close($this->connection);
        }
        unset($this->connection);
    }



}
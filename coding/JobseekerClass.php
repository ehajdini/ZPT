<?php

/**
 * Created by PhpStorm.
 * User: Borisi
 * Date: 5/21/2017
 * Time: 8:16 PM
 */
class JobseekerClass
{

    private $ID;
    private $Name;
    private $Surname;
    private $Password;
    private $BirthDate;
    private $Email;
    private $Number;


    function __construct($ID, $Password, $Surname, $Name,$BirthDate,$Email,$Number)
    {
        $this->ID = $ID;
        $this->Password = $Password;
        $this->Name = $Name;
        $this->Surname = $Surname;
        $this->BirthDate = $BirthDate;
        $this->Email = $Email;
        $this->Number = $Number;
    }
	//ID
		public function getID(){
        return $this->ID;
		}

		public function set($ID){
        $this->ID = $ID;
		}


	//Password
		public function getPassword(){
        return $this->password;
		}

		public function setPassword($password){
        $this->password = $password;
		}


	//Name
		public function getName(){
        return $this->Name;
		}
		
		public function setName($Name) {
        $this->Name = $Name;
		}

		
	//Surname
		public function getSurname() {
        return $this->Surname;
		}

		public function setSurname($Surname){
        $this->Surnamame = $Surname;
		}

    //Profession
    public function getProfession() {
        return $this->Profession;
    }

    public function setProfession($Profession){
        $this->Profession= $Profession;
    }



	//Date	
		public function getBirthDate(){
        return $this->BirthDate;
		}

		public function setBirthDate($Date){
        $this->BirthDate = $Date;
		}

		
	//Email	
		public function getEmail(){
			return $this->Email;
			}

		public function setEmail($Email){
        $this->Email = $Email;
			}

    //Number
    public function getNumber(){
        return $this->Number;
    }

    public function setNumber($Number){
        $this->Number = $Number;
    }

}

<?php

require_once(__DIR__."/../core/ValidationException.php");

class User {

    private $id;
    private $user;
    private $name;
    private $surname;
    private $email;
    private $phone;
    private $birthdate;
    private $city;
    private $photo;
    private $delete_date;
    /**
     * type
     * false: user
     * true: admin
     */
    private $type;
    /**
     * private
     * false: public
     * true: private
     */
    private $private;
    private $password;



    public function __construct($id=NULL, $user=NULL, $name=NULL, $surname=NULL, $email=NULL, $phone=NULL,
                                $birthdate=NULL, $city=NULL, $photo=NULL, $delete_date=NULL, $type=NULL,
                                $private=NULL, $password=NULL)
    {
     $this->id = $id;
     $this->user = $user;
     $this->name = $name;
     $this->surname = $surname;
     $this->email = $email;
     $this->phone = $phone;
     $this->birthdate = $birthdate;
     $this->city = $city;
     $this->photo = $photo;
     $this->delete_date = $delete_date;
     $this->type = $type;
     $this->private = $private;
     $this->password = $password;
    }

    public function getID() {
        return $this->id;
    }

    public function setID($id) {
        $this->id = $id;
    }

    public function getUser() {
        return $this->user;
    }

    public function setUser($user) {
        $this->user = $user;
    }

    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function getSurname() {
        return $this->surname;
    }

    public function setSurname($surname) {
        $this->surname = $surname;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function getPhone() {
        return $this->phone;
    }

    public function setPhone($phone) {
        $this->phone = $phone;
    }

    public function getBirthdate() {
        return $this->birthdate;
    }

    public function setBirthdate($birthdate) {
        $this->birthdate = $birthdate;
    }

    public function getCity() {
        return $this->city;
    }

    public function setCity($city) {
        $this->city = $city;
    }

    public function getPhoto() {
        return $this->photo;
    }

    public function setPhoto($photo) {
        $this->photo = $photo;
    }

    public function getDeleteDate() {
        return $this->delete_date;
    }

    public function setDeleteDate($delete_date) {
        $this->delete_date = $delete_date;
    }

    public function getType() {
        return $this->type;
    }

    public function setType($type) {
        $this->type = $type;
    }

    public function getPrivate() {
        return $this->private;
    }

    public function setPrivate($private) {
        $this->private = $private;
    }

    public function getPassword() {
        return $this->password;
    }

    public function setPassword($password) {
        $this->password = $password;
    }

    public function checkIsValidForCreate() {
        $errors = array();
        if (strlen($this->user < 4)) {
            $errors["username"] = "Username must be at least 5 characters length";

        }
            
        if (sizeof($errors)>0){
            throw new ValidationException($errors, "user is not valid");
        }
    }
}

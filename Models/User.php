<?php

require_once(__DIR__."/../core/ValidationException.php");

class User {

    private $id;
    private $user;
    private $name;
    private $surname;
    private $email;
    private $phone;
    private $birthday;
    private $address;
    private $status;
    private $photo;
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
                                $birthday=NULL, $address=NULL, $status=NULL, $photo=NULL, $type=NULL,
                                $private=NULL, $password=NULL)
    {
     $this->id = $id;
     $this->user = $user;
     $this->name = $name;
     $this->surname = $surname;
     $this->email = $email;
     $this->phone = $phone;
     $this->birthday = $birthday;
     $this->address = $address;
     $this->photo = $photo;
     $this->status = $status;
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

    public function getBirthday() {
        return $this->birthday;
    }

    public function setBirthday($birthday) {
        $this->birthday = $birthday;
    }

    public function getAddress() {
        return $this->address;
    }

    public function setAddress($address) {
        $this->address = $address;
    }

    public function getPhoto() {
        return $this->photo;
    }

    public function setPhoto($photo) {
        $this->photo = $photo;
    }

    public function getStatus() {
        return $this->status;
    }

    public function setStatus($status) {
        $this->status = $status;
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

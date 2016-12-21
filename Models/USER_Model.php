<?php

require_once(__DIR__."/../core/PDOConnection.php");

class USER_Model {
       
    private $db;

    public function __construct() {
        $this->db = PDOConnection::getInstance();
    }

    public function showall($activo = 1){
        $sql = $this->db->prepare("SELECT * FROM user ORDER BY username");
        $sql->execute();
        $users_db = $sql->fetchAll(PDO::FETCH_ASSOC);

        $users = array();

        foreach ($users_db as $user) {
            array_push($users, new User($user["id"], $user["user"], $user["name"], $user["surname"], $user["email"],
                                        $user["phone"],$user["birthdate"],$user["city"],$user["photo"],
                                        $user["delete_date"],$user["type"], $user["private"]));
        }

        return $users;
    }

    public function showcurrent($userID){
        $sql = $this->db->prepare("SELECT * FROM user WHERE id=?");
        $sql->execute(array($userID));
        $user = $sql->fetch(PDO::FETCH_ASSOC);

        if($user != NULL) {
            return new User($user["id"], $user["user"], $user["name"], $user["surname"], $user["email"],
                            $user["phone"],$user["birthdate"],$user["city"],$user["photo"],
                            $user["delete_date"],$user["type"], $user["private"]);
        } else {
            return NULL;
        }
    }

    public function show_by_username($user){
        $sql = $this->db->prepare("SELECT * FROM user WHERE user=?");
        $sql->execute(array($user));
        $user = $sql->fetch(PDO::FETCH_ASSOC);

        if($user != NULL) {
            return new User($user["id"], $user["user"], $user["name"], $user["surname"], $user["email"],
                            $user["phone"],$user["birthdate"],$user["city"],$user["photo"],
                            $user["delete_date"],$user["type"], $user["private"]);
        } else {
            return NULL;
        }
    }

    public function add(User $user) {
        $sql = $this->db->prepare("INSERT INTO user(user,name,surname,email,phone,birthdate,city,photo,deletedate,type,private,password) values (?,?,?,?,?,?,?,?,?,?,?,?)");
        $sql->execute(array($user->getUser(), $user->getName(), $user->getSurname(), $user->getEmail(),
                            $user->getPhone(), $user->getBirthdate(), $user->getCity(), $user->getPhoto(), $user->getDeleteDate(),
                            $user->Type(), $user->getPrivate(), $user->getPassword()));
    }

    public function edit(User $user){
        if ($user->getPassword()) {
            $sql = $this->db->prepare("UPDATE user SET user=?, name=?, surname=?, email=?, phone=?, birthdate=?,
                                                       city=?, photo=?, deletedate=?, type=?, private=?, password=? where id=?");
            $sql->execute(array($user->getUser(), $user->getName(), $user->getSurname(), $user->getEmail(),
                                $user->getPhone(), $user->getBirthdate(), $user->getCity(), $user->getPhoto(), $user->getDeleteDate(),
                                $user->Type(), $user->getPrivate(), $user->getPassword(), $user->getID()));
        }
        else {
            $sql = $this->db->prepare("UPDATE user SET user=?, name=?, surname=?, email=?, phone=?, birthdate=?,
                                                       city=?, photo=?, deletedate=?, type=?, private=? where id=?");
            $sql->execute(array($user->getUser(), $user->getName(), $user->getSurname(), $user->getEmail(),
                                $user->getPhone(), $user->getBirthdate(), $user->getCity(), $user->getPhoto(), $user->getDeleteDate(),
                                $user->Type(), $user->getPrivate(), $user->getID()));
        }
    }

    public function delete(User $user){
        $sql = $this->db->prepare("DELETE FROM user where id=?");
        $sql->execute(array($user->getID()));
    }

    public function userExists($user) {
        $sql = $this->db->prepare("SELECT count(user) FROM user where user=?");
        $sql->execute(array($username));

        if ($sql->fetchColumn() > 0) {
            return true;
        }
    }

    public function emailExists($email) {
        $sql = $this->db->prepare("SELECT count(email) FROM user where email=?");
        $sql->execute(array($email));

        if ($sql->fetchColumn() > 0) {
            return true;
        }
    }

    public function isValidUser($user, $passwd) {

        if (empty($passwd)){
            return false;
        }

        $sql = $this->db->prepare("SELECT count(user) FROM user where user=? and password=?");
        $sql->execute(array($username, $passwd));

        if ($sql->fetchColumn() > 0) {
            return true;
        }
    }
    
}
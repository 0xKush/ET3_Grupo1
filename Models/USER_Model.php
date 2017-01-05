<?php

require_once(__DIR__."/../core/PDOConnection.php");

class USER_Model {
       
    private $db;

    public function __construct()
    {
        $this->db = PDOConnection::getInstance();
    }

    public function showall($status = 1)
    {
        $sql = $this->db->prepare("SELECT * FROM user where status=? ORDER BY username");
        $sql->execute(array($status));
        $users_db = $sql->fetchAll(PDO::FETCH_ASSOC);

        $users = array();

        foreach ($users_db as $user) {
            array_push($users, new User($user["id"], $user["user"], $user["name"], $user["surname"], $user["email"],
                                        $user["phone"], $user["birthday"], $user["address"], $user["status"],
                                        $user["photo"], $user["type"], $user["private"]));
        }

        return $users;
    }

    public function showcurrent($userID)
    {
        $sql = $this->db->prepare("SELECT * FROM user WHERE id=?");
        $sql->execute(array($userID));
        $user = $sql->fetch(PDO::FETCH_ASSOC);

        if($user != NULL) {
            return new User($user["id"], $user["user"], $user["name"], $user["surname"], $user["email"],
                                        $user["phone"], $user["birthday"], $user["address"], $user["status"],
                                        $user["photo"], $user["type"], $user["private"]);
        } else {
            return NULL;
        }
    }

    public function show_by_username($user)
    {
        $sql = $this->db->prepare("SELECT * FROM user WHERE user=?");
        $sql->execute(array($user));
        $user = $sql->fetch(PDO::FETCH_ASSOC);

        if($user != NULL) {
            return new User($user["id"], $user["user"], $user["name"], $user["surname"], $user["email"],
                                        $user["phone"], $user["birthday"], $user["address"], $user["status"],
                                        $user["photo"], $user["type"], $user["private"]);
        } else {
            return NULL;
        }
    }

    public function add(User $user) {
        $sql = $this->db->prepare("INSERT INTO user(user,name,surname,email,phone,birthday,address,status,photo,type,private,password) values (?,?,?,?,?,?,?,?,?,?,?,?)");
        $sql->execute(array($user->getUser(), $user->getName(), $user->getSurname(), $user->getEmail(),
                            $user->getPhone(), $user->getBirthday(), $user->getAddress(), $user->getStatus(), $user->getPhoto(),
                            $user->Type(), $user->getPrivate(), $user->getPassword()));
    }

    public function edit(User $user)
    {
        if ($user->getPassword()) {
            $sql = $this->db->prepare("UPDATE user SET user=?, name=?, surname=?, email=?, phone=?, birthday=?,
                                                       address=?, status=?, photo=?, deletedate=?, type=?, private=?, password=? where id=?");
            $sql->execute(array($user->getUser(), $user->getName(), $user->getSurname(), $user->getEmail(),
                                $user->getPhone(), $user->getBirthday(), $user->getAddress(), $user->getStatus(), $user->getPhoto(),
                                $user->Type(), $user->getPrivate(), $user->getPassword(), $user->getID()));
        }
        else {
            $sql = $this->db->prepare("UPDATE user SET user=?, name=?, surname=?, email=?, phone=?, birthday=?,
                                                       address=?, status=?, photo=?, deletedate=?, type=?, private=? where id=?");
            $sql->execute(array($user->getUser(), $user->getName(), $user->getSurname(), $user->getEmail(),
                                $user->getPhone(), $user->getBirthday(), $user->getAddress(), $user->getStatus(), $user->getPhoto(),
                                $user->Type(), $user->getPrivate(), $user->getID()));
        }
    }

    public function delete(User $user)
    {
        $user->setStatus(FALSE);
        $this->update($user);
    }

    public function register(User $user)
    {
        $sql = $this->db->prepare("INSERT INTO user(user,email,status,password,type,private) values (?,?,?,?,?,?)");
        $sql->execute(array($user->getUser(), $user->getEmail(), $user->getStatus(), $user->getPassword(), $user->getType(), $user->getPrivate()));
    }

    public function userExists($user)
    {
        $sql = $this->db->prepare("SELECT count(user) FROM user where user=?");
        $sql->execute(array($username));

        if ($sql->fetchColumn() > 0) {
            return true;
        }
    }

    public function emailExists($email)
    {
        $sql = $this->db->prepare("SELECT count(email) FROM user where email=?");
        $sql->execute(array($email));

        if ($sql->fetchColumn() > 0) {
            return true;
        }
    }

    public function isValidUser($user, $password)
    {

        if (empty($password)){
            return false;
        }

        $sql = $this->db->prepare("SELECT count(user) FROM user where user=? and password=?");
        $sql->execute(array($user, $password));

        if ($sql->fetchColumn() > 0) {
            return true;
        }
    }
    
}
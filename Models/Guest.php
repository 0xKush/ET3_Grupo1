<?php

require_once(__DIR__."/../core/ValidationException.php");

class Guest {

    private $id;
    private $event;
    private $member;
    private $secondarymember;
    private $status;



    public function __construct($id=NULL, $event=NULL, $member=NULL, $secondarymember=NULL, $status=0)
    {
     $this->id = $id;
     $this->event = $event;
     $this->member = $member;
     $this->secondarymember = $secondarymember;
     $this->status = $status;
    }

    public function getID() {
        return $this->id;
    }

    public function setID($id) {
        $this->id = $id;
    }

    public function getEvent() {
        return $this->event;
    }

    public function setEvent($event) {
        $this->event = $event;
    }

    public function getMember() {
        return $this->member;
    }

    public function setMember($member) {
        $this->member = $member;
    }

    public function getSecondaryMember() {
        return $this->secondarymember;
    }

    public function setSecondaryMember($secondarymember) {
        $this->secondarymember = $secondarymember;
    }

    public function getStatus() {
        return $this->status;
    }

    public function setStatus($status) {
        $this->status = $status;
    }
}

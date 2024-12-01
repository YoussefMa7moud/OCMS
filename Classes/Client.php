<?php

include'./Classes/DB_Connection.php';

class Client {
    private $clientid;
    private $name;
    private $phoneNumber;
    private $age;
    private $currentWeight;
    private $height;
    private $membershipType;
    private $membershipStartDate;
    private $membershipDuration;
    private $driveHistory;
    private $currentWorkout;
    private $currentDiet;
    private $coachID;

    
    public function __construct($clientid, $name, $phoneNumber, $age, $currentWeight, $height, 
                                $membershipType, $membershipStartDate, $membershipDuration, 
                                $driveHistory, $currentWorkout, $currentDiet, $coachID) {
        $this->clientid = $clientid;
        $this->name = $name;
        $this->phoneNumber = $phoneNumber;
        $this->age = $age;
        $this->currentWeight = $currentWeight;
        $this->height = $height;
        $this->membershipType = $membershipType;
        $this->membershipStartDate = $membershipStartDate;
        $this->membershipDuration = $membershipDuration;
        $this->driveHistory = $driveHistory;
        $this->currentWorkout = $currentWorkout;
        $this->currentDiet = $currentDiet;
        $this->coachID = $coachID;
    }

    public function calculateBMI() {
        if ($this->height > 0) {
            $heightInMeters = $this->height / 100; // converting cm to meters
            return $this->currentWeight / ($heightInMeters * $heightInMeters);
        } else {
            return 0; // Invalid height
        }
    }

    public function getNotes() {
  
        return "SELECT * FROM NOTES WHERE clientid = " . $this->clientid;
    }

    // Function to get CoachID
    public function getCoachID() {
        return $this->coachID;
    }


    public function getClientid() { return $this->clientid; }
    public function getName() { return $this->name; }
    public function getPhoneNumber() { return $this->phoneNumber; }
    public function getAge() { return $this->age; }
    public function getCurrentWeight() { return $this->currentWeight; }
    public function getHeight() { return $this->height; }
    public function getMembershipType() { return $this->membershipType; }
    public function getMembershipStartDate() { return $this->membershipStartDate; }
    public function getMembershipDuration() { return $this->membershipDuration; }
    public function getDriveHistory() { return $this->driveHistory; }
    public function getCurrentWorkout() { return $this->currentWorkout; }
    public function getCurrentDiet() { return $this->currentDiet; }
    public function getCoachID() { return $this->coachID; }


}
?>

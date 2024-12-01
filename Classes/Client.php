<?php

include './Classes/DB_Connection.php';

class Client {
    private $name;
    private $email;
    private $phoneNumber;
    private $age;
    private $currentWeight;
    private $height;
    private $membershipType;
    public $membershipStartDate;
    public $membershipDuration;

    public function __construct($name, $email, $phoneNumber, $age, $currentWeight, $height, $membershipType) {
        $this->name = $name;
        $this->email = $email;
        $this->phoneNumber = $phoneNumber;
        $this->age = $age;
        $this->currentWeight = $currentWeight;
        $this->height = $height;
        $this->membershipType = $membershipType;
    }

    public function addClientToDB($db) {
        $query = "INSERT INTO client (name , email, phoneNumber, age, currentWeight, height, membershipType, 
                    membershipStartDate, membershipDuration) 
                  VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = $db->prepare($query);
        if (!$stmt) {
            return "Error preparing statement: " . $db->error;
        }

        // Bind parameters to the statement
        $stmt->bind_param(
            "sssiddssi", 
            $this->name, 
            $this->email, 
            $this->phoneNumber, 
            $this->age, 
            $this->currentWeight, 
            $this->height, 
            $this->membershipType, 
            $this->membershipStartDate, 
            $this->membershipDuration
        );

        // Execute the statement
        if ($stmt->execute()) {
            $stmt->close();
            return "Client successfully added to the database!";
        } else {
            $stmt->close();
            return "Error executing query: " . $stmt->error;
        }
    }

    public function calculateBMI() {
        if ($this->height > 0) {
            $heightInMeters = $this->height / 100; // converting cm to meters
            return $this->currentWeight / ($heightInMeters * $heightInMeters);
        } else {
            return 0; // Invalid height
        }
    }
}






?>

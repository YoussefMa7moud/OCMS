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

    // Constructor with optional parameters
    public function __construct($name = '', $email = '', $phoneNumber = '', $age = 0, $currentWeight = 0, $height = 0, $membershipType = '', $membershipStartDate = null, $membershipDuration = null) {
        $this->name = $name;
        $this->email = $email;
        $this->phoneNumber = $phoneNumber;
        $this->age = $age;
        $this->currentWeight = $currentWeight;
        $this->height = $height;
        $this->membershipType = $membershipType;
        $this->membershipStartDate = $membershipStartDate;  // Set membership start date
        $this->membershipDuration = $membershipDuration;    // Set membership duration
    }










    // Add client to DB
    public function addClientToDB($db) {
        $query = "INSERT INTO client (name , email, phoneNumber, age, currentWeight, height, membershipType, 
                    membershipStartDate, membershipDuration) 
                  VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = $db->prepare($query);
        if (!$stmt) {
            return "Error preparing statement: " . $db->error;
        }

        // Bind parameters
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
        if ($stmt->execute()) {
            $stmt->close();
            session_start();
        $_SESSION['form_submitted'] = true;
        header("Location: Add-Client.php");
        exit;
        } else {
            $stmt->close();
            return "Error executing query: " . $stmt->error;
        }
    }













    // Calculate BMI (To be Implemented)
    public function calculateBMI() {
        if ($this->height > 0) {
            $heightInMeters = $this->height / 100; // Convert cm to meters
            return $this->currentWeight / ($heightInMeters * $heightInMeters);
        } else {
            return 0; // Invalid height
        }
    }













    // Fetch clients waiting for a workout plan
    public function WaitingForPlan($db) {
        $query = "SELECT * FROM client WHERE CurrentWorkout IS NULL"; // Ensure column exists

        $stmt = $db->prepare($query);
        if (!$stmt) {
            return "Error preparing statement: " . $db->error;
        }

        if ($stmt->execute()) {
            $result = $stmt->get_result();
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            return "Error executing query: " . $stmt->error;
        }
    }










    // Fetch clients for today based on their next check-in date
    public function fetchClientsForToday($db) {
        $query = "SELECT * FROM client WHERE NextCheckIn = CURDATE()"; // Ensure CNextCheckIn column exists

        $stmt = $db->prepare($query);
        if (!$stmt) {
            return "Error preparing statement: " . $db->error;
        }

        if ($stmt->execute()) {
            $result = $stmt->get_result();
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            return "Error executing query: " . $stmt->error;
        }
    }












    public function fetchClientsWithUpcomingMembershipEnd($db) {
        $query = "SELECT *, DATEDIFF(MembershipEndDate, CURDATE()) AS days_left FROM client WHERE DATEDIFF(MembershipEndDate, CURDATE()) BETWEEN 0 AND 5";
        
        $stmt = $db->prepare($query);
        if (!$stmt) {
            return "Error preparing statement: " . $db->error;
        }
    
        if ($stmt->execute()) {
            $result = $stmt->get_result();
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            return "Error executing query: " . $stmt->error;
        }
    }
    











}

?>

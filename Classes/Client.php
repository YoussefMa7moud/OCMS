<?php

include './Classes/DB_Connection.php';

class Client {
    private $conn;
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
    public function __construct($db,$name = '', $email = '', $phoneNumber = '', $age = 0, $currentWeight = 0, $height = 0, $membershipType = '', $membershipStartDate = null, $membershipDuration = null) {
        $this->conn = $db;
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
    



    






    public function searchClients($query) {
        $query = trim($query);
    
        if ($query === '') {
            return [];
        }
    
        // Use prepared statements for security
        $sql = "SELECT clientid, name AS Name, PhoneNumber AS PhoneNumber, MembershipType 
                FROM client 
                WHERE LOWER(name) LIKE ? 
                   OR PhoneNumber LIKE ? 
                   OR CAST(clientid AS CHAR) LIKE ?";
    
        // Use $this->conn instead of undefined $this->conn
        if ($this->conn === null) {
            die('Database connection is not established.');
        }
    
        $stmt = $this->conn->prepare($sql);
        if ($stmt === false) {
            die('Error preparing the statement: ' . $this->conn->error);
        }
    
        $param = '%' . strtolower($query) . '%';
        $stmt->bind_param("sss", $param, $param, $param);
    
        if (!$stmt->execute()) {
            die('Execute failed: ' . $stmt->error);
        }
    
        $result = $stmt->get_result();
    
        $clients = [];
        while ($row = $result->fetch_assoc()) {
            $clients[] = $row;
        }
    
        return $clients;
    }
    





    public function getClientById($db, $clientId) {
        // Ensure the clientId is valid
        if (empty($clientId) || !is_numeric($clientId)) {
            return "Invalid client ID.";
        }
    
        // Query to fetch client by ID
        $query = "SELECT * FROM client WHERE clientid = ?"; 
    
        // Prepare the statement
        $stmt = $db->prepare($query);
        if (!$stmt) {
            return "Error preparing statement: " . $db->error;
        }
    
        // Bind the client ID to the statement
        $stmt->bind_param("i", $clientId);
    
        // Execute the statement
        if ($stmt->execute()) {
            $result = $stmt->get_result();
            
            // Check if the client exists
            if ($result->num_rows > 0) {
                // Fetch and return the client data as an associative array
                return $result->fetch_assoc();
            } else {
                // If no client is found, return a specific message
                return "No client found with the given ID.";
            }
        } else {
            return "Error executing query: " . $stmt->error;
        }
    }
    







}

?>

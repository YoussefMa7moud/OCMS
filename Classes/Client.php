<?php

include './Classes/DB_Connection.php';

class Client {
    private $conn;
    private $name;
    private $email;
    private $phone_number;
    private $age;
    private $current_weight;
    private $height;
    private $membership_type;
    public $membership_start_date;
    public $membership_duration;

    // Constructor with optional parameters
    public function __construct($db, $name = '', $email = '', $phone_number = '', $age = 0, $current_weight = 0, $height = 0, $membership_type = '', $membership_start_date = null, $membership_duration = null) {
        $this->conn = $db;
        $this->name = $name;
        $this->email = $email;
        $this->phone_number = $phone_number;
        $this->age = $age;
        $this->current_weight = $current_weight;
        $this->height = $height;
        $this->membership_type = $membership_type;
        $this->membership_start_date = $membership_start_date;
        $this->membership_duration = $membership_duration;
    }

    // Add client to DB
    public function addClientToDB($db) {
        $query = "INSERT INTO client (name, email, phone_number, age, current_weight, height, membership_type, 
                    membership_start_date, membership_duration) 
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
            $this->phone_number, 
            $this->age, 
            $this->current_weight, 
            $this->height, 
            $this->membership_type, 
            $this->membership_start_date, 
            $this->membership_duration
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

    // Calculate BMI
    public function calculateBMI() {
        if ($this->height > 0) {
            $height_in_meters = $this->height / 100; // Convert cm to meters
            return $this->current_weight / ($height_in_meters * $height_in_meters);
        } else {
            return 0; // Invalid height
        }
    }

    // Fetch clients waiting for a workout plan
    public function WaitingForPlan($db) {
        $query = "SELECT * FROM client WHERE current_workout IS NULL"; // Ensure column exists

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
        $query = "SELECT * FROM client WHERE next_check_in = CURDATE()";

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

    // Fetch clients with upcoming membership end dates
    public function fetchClientsWithUpcomingMembershipEnd($db) {
        $query = "SELECT *, DATEDIFF(membership_end_date, CURDATE()) AS days_left FROM client WHERE DATEDIFF(membership_end_date, CURDATE()) BETWEEN 0 AND 5";
        
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

    // Search clients
    public function searchClients($query) {
        $query = trim($query);
    
        if ($query === '') {
            return [];
        }
    
        $sql = "SELECT id, name AS Name, phone_number AS PhoneNumber, membership_type 
                FROM client 
                WHERE LOWER(name) LIKE ? 
                   OR phone_number LIKE ? 
                   OR CAST(id AS CHAR) LIKE ?";
    
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

    // Get client by ID
    public function getClientById($db, $clientId) {
        if (empty($clientId) || !is_numeric($clientId)) {
            return "Invalid client ID.";
        }
    
        $query = "SELECT * FROM client WHERE id = ?";
    
        $stmt = $db->prepare($query);
        if (!$stmt) {
            return "Error preparing statement: " . $db->error;
        }
    
        $stmt->bind_param("i", $clientId);
    
        if ($stmt->execute()) {
            $result = $stmt->get_result();
            if ($result->num_rows > 0) {
                return $result->fetch_assoc();
            } else {
                return "No client found with the given ID.";
            }
        } else {
            return "Error executing query: " . $stmt->error;
        }
    }
}

?>

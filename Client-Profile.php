<?php
include './Classes/DB_Connection.php';  // Make sure this path is correct
include './Classes/Client.php';  // Include the Client class
$db = $conn;
// Instantiate the Client class
$client = new Client($db);  // Create an instance of the Client class

// Check if clientId is set and valid
if (isset($_GET['clientId']) && is_numeric($_GET['clientId'])) {
    $clientId = $_GET['clientId'];

    // Assuming $db is your database connection
    $clientData = $client->getClientById($db, $clientId);

    // Check if client data was retrieved successfully
    if (is_array($clientData)) {
        // Extract individual client details
        $name = $clientData['Name'];
        $age = $clientData['Age'];
        $height = $clientData['Height'];
        $weight = $clientData['CurrentWeight'];
        $membershipType = $clientData['MembershipType'];
        $expiryDate = $clientData['MembershipEndDate'];
        $nextCheckIn = $clientData['NextCheckIn'];
        $email = $clientData['email'];
        $phoneNumber = $clientData['PhoneNumber'];
    } else {
        // If it's not an array, it's an error message
        echo "<p>Error: " . htmlspecialchars($clientData) . "</p>";
    }
} else {
    echo "<p>Invalid client ID.</p>";
}
?>


<!-- HTML Code -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Member Profile - FitTrack Gym Management</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --bg-color: #121212;
            --surface-color: #1e1e1e;
            --primary-color: #ff4757;
            --secondary-color: #5352ed;
            --accent-color: #ffa502;
            --on-bg-color: #ffffff;
            --on-surface-color: #e0e0e0;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Roboto', sans-serif;
            list-style-type: none;
        }
        
        body {
            background-color: var(--bg-color);
            color: var(--on-bg-color);
            display: flex;
            min-height: 100vh;
        }
        
        
        .main-content {
            flex-grow: 1;
            padding: 20px;
            overflow-y: auto;
            margin-left: 250px; /* Adjust this value to match the sidebar width */
    padding: 20px;
        }
        
        .section {
            background-color: var(--surface-color);
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        
        .section h2 {
            margin-bottom: 15px;
            color: var(--primary-color);
            display: flex;
            align-items: center;
        }
        
        .section h2 i {
            margin-right: 10px;
        }
        
        .profile-header {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }
        
        .profile-picture {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            background-color: var(--accent-color);
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 48px;
            margin-right: 20px;
        }
        
        .profile-name {
            font-size: 24px;
            font-weight: bold;
        }
        
        .profile-info {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
        }
        
        .info-item {
            background-color: rgba(255, 255, 255, 0.05);
            border-radius: 5px;
            padding: 15px;
        }
        
        .info-item h3 {
            font-size: 16px;
            margin-bottom: 5px;
            color: var(--accent-color);
        }
        
        .workout-plan, .diet-plan {
            margin-top: 20px;
            list-style-type: none;
        }
        
        .plan-item {
            background-color: rgba(255, 255, 255, 0.05);
            border-radius: 5px;
            padding: 15px;
            margin-bottom: 10px;
            list-style-type: none;


        }
   
        .notes {
            margin-top: 20px;
        }
        
        .note {
            background-color: rgba(255, 255, 255, 0.05);
            border-radius: 5px;
            padding: 15px;
            margin-bottom: 10px;
        }
        
        .note-date {
            font-size: 12px;
            color: var(--accent-color);
            margin-bottom: 5px;
        }


        #BtPlane{
            background-color: var(--secondary-color);
            color: var(--on-bg-color);
            border: none;
            padding: 8px 12px;
            border-radius: 3px;
            cursor: pointer;
            transition: background-color 0.3s;
            margin-right: 10px;
            text-decoration: none;
        }


        #BtPlane:hover{
            background-color: var(--primary-color);
        }

        
        button {
            background-color: var(--secondary-color);
            color: var(--on-bg-color);
            border: none;
            padding: 8px 12px;
            border-radius: 3px;
            cursor: pointer;
            transition: background-color 0.3s;
            margin-right: 10px;
        }
        
        button:hover {
            background-color: var(--primary-color);
        }
        
        @media (max-width: 768px) {
            body {
                flex-direction: column;
                padding-top:40px;
            }

            .main-content {
        margin-left: 0;
    }
            
            .sidebar {
                width: 100%;
                height: auto;
            }
            
            .sidebar-menu {
                display: flex;
                justify-content: space-around;
            }
            
            .sidebar-menu li {
                margin-bottom: 0;
            }
            
            .sidebar-menu a {
                flex-direction: column;
                align-items: center;
                text-align: center;
                padding: 5px;
            }
            
            .sidebar-menu a i {
                margin-right: 0;
                margin-bottom: 5px;
            }
            
            .sidebar-menu a span {
                font-size: 12px;
            }
            
            .profile-header {
                flex-direction: column;
                text-align: center;
            }
            
            .profile-picture {
                margin-right: 0;
                margin-bottom: 10px;
            }
        }
        </style>
</head>
<body>
<?php include('./Components/Nav.php'); ?>

    <div class="main-content">
        <div class="section">
            <h2><i class="fas fa-user"></i> Member Profile</h2>
            <div class="profile-header">
                <!-- Profile Picture Placeholder, replace "JD" with the actual name or image -->
                <div class="profile-picture"><?php echo strtoupper(substr($name, 0, 2)); ?></div>
                <div class="profile-name"><?php echo $name; ?></div>
            </div>
            <div class="profile-info">
                <div class="info-item">
                    <h3>Age</h3>
                    <p><?php echo $age; ?> years</p>
                </div>
                <div class="info-item">
                    <h3>Height</h3>
                    <p><?php echo $height; ?> cm</p>
                </div>
                <div class="info-item">
                    <h3>Weight</h3>
                    <p><?php echo $weight; ?> kg</p>
                </div>
                <div class="info-item">
                    <h3>BMI</h3>
                    <p><?php echo "Function TBI"; ?></p>
                </div>
                <div class="info-item">
                    <h3>Membership</h3>
                    <p><?php echo $membershipType; ?></p>
                </div>
                <div class="info-item">
                    <h3>Expiry Date</h3>
                    <p><?php echo $expiryDate; ?></p>
                </div>
                <div class="info-item">
                    <h3>Next Check In</h3>
                    <p><?php echo $nextCheckIn; ?></p>
                </div>
                <div class="info-item">
                    <h3>Email</h3>
                    <p><?php echo $email; ?></p>
                </div>
                <div class="info-item">
                    <h3>Phone Number</h3>
                    <p><?php echo $phoneNumber; ?></p>
                </div>

                <div class="info-item">
                    <h3>Google Drive (History)</h3>
                    <button>Google Drive</button>
                </div>

                <div class="info-item">
                    <h3>Contact Now</h3>
                    <button>Whatsapp</button>
                </div>

                <div class="info-item">
                    <h3>Renew Membership</h3>
                    <select id="months" name="months">
                        <option value="1">1 Month</option>
                        <option value="3">3 Months</option>
                        <option value="6">6 Months</option>
                        <option value="12">12 Months</option>
                    </select>
                    <button>Renew Now</button>
                </div>
            </div>

            <div class="workout-plan">
                <h3>Current Workout Plan</h3>
                <?php foreach ($workoutPlan as $workout): ?>
                    <div class="plan-item">
                        <h4><?php echo $workout['day']; ?></h4>
                        <p><?php echo $workout['description']; ?></p>
                        <ul>
                            <?php
                                $exercises = json_decode($workout['exercises'], true); // Assuming exercises are stored as JSON
                                foreach ($exercises as $exercise) {
                                    echo "<li>$exercise</li>";
                                }
                            ?>
                        </ul>
                    </div>
                <?php endforeach; ?>
            </div>

            <div class="diet-plan">
                <h3>Current Diet Plan</h3>
                <?php foreach ($dietPlan as $diet): ?>
                    <div class="plan-item">
                        <h4><?php echo $diet['meal']; ?></h4>
                        <p><?php echo $diet['description']; ?></p>
                    </div>
                <?php endforeach; ?>
            </div>

            <div class="notes">
                <h3>Trainer Notes</h3>
                <div class="note">
                    <div class="note-date">2023-05-15</div>
                    <p>John has shown great progress in his chest workouts. Increased bench press weight by 10 lbs.</p>
                </div>
                <div class="note">
                    <div class="note-date">2023-05-08</div>
                    <p>Discussed nutrition plan. John needs to increase protein intake.</p>
                </div>
            </div>

            <div style="margin-top: 20px;">
                <button>Edit Profile</button>
                <a id="BtPlane" href="plan.php">Update Plan</a>
                <a id="BtPlane">Add Note</a>
            </div>
        </div>
    </div>
</body>
</html>
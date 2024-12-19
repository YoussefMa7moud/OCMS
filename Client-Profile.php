<?php
include './Classes/DB_Connection.php';  // Make sure this path is correct
include './Classes/Client.php';       // Include the Client class

// Initialize database connection
$db = $conn;

// Instantiate the Client class
$client = new Client($db);

// Initialize variables
$name = $age = $height = $weight = $membershipType = $expiryDate = $nextCheckIn = $email = $phoneNumber = '';
$workoutPlan = $dietPlan = [];

// Check if clientId is set and valid
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $clientId = $_GET['id'];

   
    $clientData = $client->getClientById($clientId);

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

        // Fetch workout and diet plans
        $workoutPlan = $client->getWorkoutPlan($clientId); // Adjust function name as per your code
        $dietPlan = $client->getDietPlan($clientId);       // Adjust function name as per your code
    } else {
        echo "<p>Error: " . htmlspecialchars($clientData) . "</p>";
    }
} else {
    echo "<p>Invalid client ID.</p>";
}
?>

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
            margin-left: 250px;
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
    </style>
</head>
<body>
<?php include('./Components/Nav.php'); ?>

<div class="main-content">
    <div class="section">
        <h2><i class="fas fa-user"></i> Member Profile</h2>
        <div class="profile-header">
            <div class="profile-picture"><?php echo strtoupper(substr($name, 0, 2)); ?></div>
            <div class="profile-name"> <?php echo htmlspecialchars($name); ?> </div>
        </div>

        <div class="profile-info">
            <div class="info-item">
                <h3>Age</h3>
                <p><?php echo htmlspecialchars($age); ?> years</p>
            </div>
            <div class="info-item">
                <h3>Height</h3>
                <p><?php echo htmlspecialchars($height); ?> cm</p>
            </div>
            <div class="info-item">
                <h3>Weight</h3>
                <p><?php echo htmlspecialchars($weight); ?> kg</p>
            </div>
            <div class="info-item">
                <h3>BMI</h3>
                <p><?php echo number_format($weight / pow($height / 100, 2), 2); ?></p>
            </div>
            <div class="info-item">
                <h3>Membership</h3>
                <p><?php echo htmlspecialchars($membershipType); ?></p>
            </div>
            <div class="info-item">
                <h3>Expiry Date</h3>
                <p><?php echo htmlspecialchars($expiryDate); ?></p>
            </div>
            <div class="info-item">
                <h3>Next Check In</h3>
                <p><?php echo htmlspecialchars($nextCheckIn); ?></p>
            </div>
            <div class="info-item">
                <h3>Email</h3>
                <p><?php echo htmlspecialchars($email); ?></p>
            </div>
            <div class="info-item">
                <h3>Phone Number</h3>
                <p><?php echo htmlspecialchars($phoneNumber); ?></p>
            </div>
        </div>

        <div class="workout-plan">
            <h3>Current Workout Plan</h3>
            <?php foreach ($workoutPlan as $workout): ?>
                <div class="plan-item">
                    <h4><?php echo htmlspecialchars($workout['day']); ?></h4>
                    <ul>
                        <?php foreach (json_decode($workout['exercises'], true) as $exercise): ?>
                            <li><?php echo htmlspecialchars($exercise); ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="diet-plan">
            <h3>Current Diet Plan</h3>
            <?php foreach ($dietPlan as $diet): ?>
                <div class="plan-item">
                    <h4><?php echo htmlspecialchars($diet['meal']); ?></h4>
                    <p><?php echo htmlspecialchars($diet['description']); ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
</body>
</html>

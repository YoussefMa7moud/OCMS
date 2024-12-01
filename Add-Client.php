<?php

include './Classes/DB_Connection.php';
include './Classes/Client.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['clientName'];
    $email = $_POST['clientEmail'];
    $phoneNumber = $_POST['clientPhone'];
    $age = $_POST['clientAge'];
    $currentWeight = $_POST['clientWeight'];
    $height = $_POST['clientHeight'];
    $membershipType = $_POST['membershipType'];
    $membershipStartDate = $_POST['membershipStart'];
    $membershipDuration = $_POST['membershipDuration'];

    $client = new Client($name, $email, $phoneNumber, $age, $currentWeight, $height, $membershipType);
    $client->membershipStartDate = $membershipStartDate;
    $client->membershipDuration = $membershipDuration;

    $result = $client->addClientToDB($conn);


}

mysqli_close($conn);

?>
 

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Member - FitTrack Gym Management</title>
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
        
        form {
            display: grid;
            gap: 15px;
        }
        
        label {
            color: var(--on-surface-color);
        }
        
        input[type="text"],
        input[type="tel"],
        input[type="number"],
        input[type="date"],
        select {
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            border: none;
            background-color: rgba(255, 255, 255, 0.1);
            color: var(--on-surface-color);
        }
        
        button {
            background-color: var(--secondary-color);
            color: var(--on-bg-color);
            border: none;
            padding: 10px 15px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        
        button:hover {
            background-color: var(--primary-color);
        }
        
        @media (max-width: 768px) {
            body {
                flex-direction: column;
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
        }
    </style>
</head>
<body>
<?php include('./Components/Nav.php'); ?>

    <div class="main-content">
        <div class="section">
            <h2><i class="fas fa-user-plus"></i> Add New Member</h2>
            <form id="addClientForm" method="post">
                <label for="clientName">Name:</label>
                <input type="text" id="clientName" name="clientName" required>

                <label for="clientEmail">Email:</label>
                <input type="text" id="clientEmail" name="clientEmail" required>
                
                <label for="clientPhone">Phone Number:</label>
                <input type="tel" id="clientPhone" name="clientPhone" required>
                
                <label for="clientAge">Age:</label>
                <input type="number" id="clientAge" name="clientAge" required>
                
                <label for="clientWeight">Current Weight (kg):</label>
                <input type="number" id="clientWeight" name="clientWeight" step="0.1" required>
                
                <label for="clientHeight">Height (cm):</label>
                <input type="number" id="clientHeight" name="clientHeight" required>
                
                <label for="membershipType">Membership Type:</label>
                <select id="membershipType" name="membershipType" required>
                    <option value="">Select Membership</option>
                    <option value="basic">Email</option>
                    <option value="silver">Whatsapp</option>
                    <option value="gold">Personal</option>
                </select>
                
                <label for="membershipStart">Membership Start Date:</label>
                <input type="date" id="membershipStart" name="membershipStart" required>
                
                <label for="membershipDuration">Membership Duration (months):</label>
                <input type="number" id="membershipDuration" name="membershipDuration" required>
                
                <button type="submit">Add Member</button>
            </form>
        </div>
    </div>

    <script>
        // document.getElementById('addClientForm').addEventListener('submit', function(e) {
        //     e.preventDefault();
     
        //     alert('Member added successfully!');
        //     this.reset();
        // });
    </script>
</body>
</html>


<?php
include './Classes/DB_Connection.php';  // Include the DB connection
include './Classes/Client.php';         // Include the Client class

header('Content-Type: text/html');

// Initialize the results and query variables
$results = [];
$query = '';

// Check if the query parameter exists and is not empty
if (isset($_GET['query']) && !empty($_GET['query'])) {
    $query = $_GET['query'];  // Get the query parameter from the URL

    // Pass the $conn variable to the Client class
    $Client = new Client($conn);  // Now passing the $conn to the Client constructor
    $results = $Client->searchClients($query);  // Perform the search
}

// If the request is made by AJAX (AJAX request)
if (isset($_GET['query'])) {
    // Output only the search results HTML, not the full page
    if (empty($results)) {
        echo '<p>No results found for "' . htmlspecialchars($query) . '".</p>';
    } else {
        foreach ($results as $client) {
            echo '<div class="client-result">
                    <h3>' . htmlspecialchars($client['Name']) . '</h3>
                    <p>Phone: ' . htmlspecialchars($client['PhoneNumber']) . '</p>
                    <p>Membership: ' . htmlspecialchars($client['MembershipType']) . '</p>
                    <button onclick="viewProfile(' . $client['clientid'] . ')">View Profile</button>
                  </div>';
        }
    }
    exit; // Stop further processing after AJAX
}

// If it's not an AJAX request, return the full page
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Members - FitTrack Gym Management</title>
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
        
        input[type="text"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
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
        
        #searchResults {
            margin-top: 20px;
        }
        
        .client-result {
            background-color: rgba(255, 255, 255, 0.05);
            border-radius: 5px;
            padding: 15px;
            margin-bottom: 10px;
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
        }
    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        // AJAX to dynamically fetch search results
        function searchClients(query) {
            if (query.length >= 1) {
                $.ajax({
                    url: 'search.php',  
                    type: 'GET',
                    data: { query: query },  // Pass query as GET parameter
                    success: function(data) {
                        $('#searchResults').html(data);  // Update search results div with the new data
                    }
                });
            } else {
                $('#searchResults').html('<p></p>');  // Show default message if no query
            }
        }
    </script>
</head>
<body>
<?php include('./Components/Nav.php'); ?>

<div class="main-content">
    <div class="section">
        <h2><i class="fas fa-search"></i> Search Members</h2>
        <form method="GET" action="search.php" onsubmit="event.preventDefault();">  <!-- Prevent default form submit -->
            <input type="text" name="query" oninput="searchClients(this.value)" placeholder="Enter member name, phone, or ID" value="<?php echo htmlspecialchars($query); ?>">
        </form>

        <div id="searchResults">
            <?php if (empty($results)): ?>
                <?php if ($query): ?>
                    <p>No results found for "<?php echo htmlspecialchars($query); ?>".</p>
                <?php else: ?>
                    <p></p>
                <?php endif; ?>
            <?php else: ?>
                <?php foreach ($results as $client): ?>
                    <div class="client-result">
                        <h3><?php echo htmlspecialchars($client['Name']); ?></h3>
                        <p>Phone: <?php echo htmlspecialchars($client['PhoneNumber']); ?></p>
                        <p>Membership: <?php echo htmlspecialchars($client['MembershipType']); ?></p>
                        <button onclick="viewProfile('<?php echo $client['clientid']; ?>')">View Profile</button>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</div>
</body>
</html>
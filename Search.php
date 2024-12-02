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
</head>
<body>
<?php include('./Components/Nav.php'); ?>

    <div class="main-content">
        <div class="section">
            <h2><i class="fas fa-search"></i> Search Members</h2>
            <input type="text" id="searchInput" placeholder="Enter member name or phone number">
            <button onclick="searchClients()">Search</button>
            <div id="searchResults"></div>
        </div>
    </div>

    <script>
        function searchClients() {
            const searchInput = document.getElementById('searchInput').value;
            const searchResults = document.getElementById('searchResults');
            
            // Mock search results (replace with actual search logic)
            const mockResults = [
                { name: 'John Doe', phone: '123-456-7890', membership: 'Gold' },
                { name: 'Jane Smith', phone: '987-654-3210', membership: 'Silver' }
            ];
            
            searchResults.innerHTML = '';
            
            mockResults.forEach(client => {
                const resultDiv = document.createElement('div');
                resultDiv.className = 'client-result';
                resultDiv.innerHTML = `
                    <h3>${client.name}</h3>
                    <p>Phone: ${client.phone}</p>
                    <p>Membership: ${client.membership}</p>
                    <button onclick="viewProfile('${client.name}')">View Profile</button>
                    <button onclick="openWorkoutPlan('${client.name}')">Workout Plan</button>
                `;
                searchResults.appendChild(resultDiv);
            });
        }
    </script>
</body>
</html>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Expiring Memberships - FitTrack Gym Management</title>
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
        
        .membership-box {
            background-color: rgba(255, 255, 255, 0.05);
            border-radius: 5px;
            padding: 15px;
            margin-bottom: 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        button {
            background-color: var(--secondary-color);
            color: var(--on-bg-color);
            border: none;
            padding: 8px 12px;
            border-radius: 3px;
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
            <h2><i class="fas fa-calendar-times"></i> Expiring Memberships</h2>
            <div class="membership-box">
                <span>John Doe - Gold Membership expires in 3 days</span>
                <div>
                    <button onclick="viewProfile('John Doe')">View Profile</button>
                    <button onclick="renewMembership('John Doe')">Renew Membership</button>
                </div>
            </div>
            <div class="membership-box">
                <span>Jane Smith - Silver Membership expires in 5 days</span>
                <div>
                    <button onclick="viewProfile('Jane Smith')">View Profile</button>
                    <button onclick="renewMembership('Jane Smith')">Renew Membership</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        function viewProfile(name) {
            alert(`Viewing profile of ${name}`);
        }

        function renewMembership(name) {
            alert(`Renewing membership for ${name}`);
        }
    </script>
</body>
</html>


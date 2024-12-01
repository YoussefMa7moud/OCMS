<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Left Menu</title>
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
        
        .sidebar {
            width: 250px;
            height: 100vh;
            background-color: var(--surface-color);
            color: var(--on-surface-color);
            position: fixed;
            left: 0;
            top: 0;
            display: flex;
            flex-direction: column;
            transition: transform 0.3s ease;
        }
        
        .sidebar-menu {
            list-style-type: none;
            padding: 20px 0;
            flex-grow: 1;
            overflow-y: auto;
        }
        
        .sidebar-menu li {
            margin-bottom: 10px;
        }
        
        .sidebar-menu a {
            color: var(--on-surface-color);
            text-decoration: none;
            display: flex;
            align-items: center;
            padding: 10px 20px;
            transition: background-color 0.3s, color 0.3s;
        }
        
        .sidebar-menu a:hover, .sidebar-menu a.active {
            background-color: var(--primary-color);
            color: var(--bg-color);
        }
        
        .sidebar-menu a i {
            margin-right: 10px;
            width: 20px;
            text-align: center;
        }
        
        .sidebar-footer {
            padding: 20px;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        .counter {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
        }
        
        .counter-label {
            font-size: 14px;
        }
        
        .counter-value {
            font-weight: bold;
            color: var(--accent-color);
        }
        
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
                z-index: 1000;
            }
            
            .sidebar.active {
                transform: translateX(0);
            }
            
            .menu-toggle {
                display: block;
                position: fixed;
                top: 10px;
                left: 10px;
                z-index: 1001;
                background-color: var(--primary-color);
                color: var(--bg-color);
                border: none;
                padding: 10px;
                border-radius: 5px;
                cursor: pointer;
            }
        }
    </style>
</head>
<body>
    <button class="menu-toggle" onclick="toggleMenu()">
        <i class="fas fa-bars"></i>
    </button>
    <nav class="sidebar" id="sidebar">
        <ul class="sidebar-menu">
            <li><a href="index.php" id="menu-dashboard"><i class="fas fa-dumbbell"></i>Dashboard</a></li>
            <li><a href="search.php" id="menu-search"><i class="fas fa-search"></i>Search Members</a></li>
            <li><a href="Add-Client.php" id="menu-add-client"><i class="fas fa-user-plus"></i>Add New Member</a></li>
            <li><a href="expiring-subscriptions.php" id="menu-expiring"><i class="fas fa-calendar-times"></i>Expiring Memberships</a></li>
        </ul>
        <div class="sidebar-footer">
            <div class="counter">
                <span class="counter-label">Total Clients:</span>
                <span class="counter-value" id="total-clients">0</span>
            </div>
            <div class="counter">
                <span class="counter-label">Active Clients:</span>
                <span class="counter-value" id="active-clients">0</span>
            </div>
            <div class="counter">
                <span class="counter-label">Total Revenue:</span>
                <span class="counter-value" id="total-revenue">$0</span>
            </div>
        </div>
    </nav>

    <script>
        function toggleMenu() {
            const sidebar = document.getElementById('sidebar');
            sidebar.classList.toggle('active');
        }

        // Function to set the active menu item
        function setActiveMenuItem() {
            const currentPage = window.location.pathname.split('/').pop();
            const menuItems = document.querySelectorAll('.sidebar-menu a');
            
            menuItems.forEach(item => {
                item.classList.remove('active');
                if (item.getAttribute('href') === currentPage) {
                    item.classList.add('active');
                }
            });
        }

        // Call setActiveMenuItem when the page loads
        window.addEventListener('load', setActiveMenuItem);

        // Example function to update counters (replace with actual data fetching)
        function updateCounters() {
            document.getElementById('total-clients').textContent = '150';
            document.getElementById('active-clients').textContent = '120';
            document.getElementById('total-revenue').textContent = '$15,000';
        }

        // Call updateCounters when the page loads
        window.addEventListener('load', updateCounters);
    </script>
</body>
</html>


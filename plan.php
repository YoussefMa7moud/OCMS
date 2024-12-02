<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Workout and Meal Plan - Gym Management Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            display: flex;
            background-color: #1a1a1a;
            color: #ffffff;
            min-height: 100vh;
        }

        .sidebar {
            width: 250px;
            background-color: #212121;
            padding: 20px 0;
            display: flex;
            flex-direction: column;
            position: fixed;
            height: 100vh;
        }

        .menu-item {
            padding: 15px 20px;
            color: #ffffff;
            text-decoration: none;
            display: flex;
            align-items: center;
            transition: background-color 0.3s;
        }

        .menu-item:hover, .menu-item.active {
            background-color: #ff4757;
        }

        .menu-item i {
            margin-right: 10px;
            width: 20px;
            text-align: center;
        }

        .stats {
            margin-top: auto;
            padding: 20px;
            border-top: 1px solid #333;
        }

        .stat-item {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
            color: #ffa502;
        }

        .main-content {
            margin-left: 250px;
            padding: 20px;
            flex-grow: 1;
        }

        .date {
            color: #ffa502;
            font-size: 24px;
            margin-bottom: 30px;
        }

        .section {
            background-color: #212121;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 20px;
        }

        .section-title {
            color: #ff4757;
            font-size: 18px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
        }

        .section-title i {
            margin-right: 10px;
        }

        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
        }

        .box {
            background-color: #2a2a2a;
            border-radius: 5px;
            padding: 15px;
        }

        .box-title {
            font-weight: bold;
            margin-bottom: 10px;
            color: #5c5cff;
        }

        .box-content {
            min-height: 100px;
            background-color: #333;
            border-radius: 5px;
            padding: 10px;
            margin-bottom: 10px;
        }

        .calorie-input {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .calorie-input input {
            width: 80px;
            padding: 5px;
            border: none;
            border-radius: 3px;
            background-color: #333;
            color: #ffffff;
        }

        [contenteditable="true"]:empty:before {
            content: attr(data-placeholder);
            color: #666;
        }

        @media (max-width: 768px) {
            
            body {
                flex-direction: column;
                padding-top:40px;
            }

            .stats {
                margin-top: 20px;
            }
        }
    </style>
</head>
<body>
    



  <?php include('./Components/Nav.php'); ?>

    <div class="main-content">
        <div class="date">Monday, December 2, 2024</div>

        <div class="section">
            <div class="section-title">
                <i class="fas fa-dumbbell"></i>
                Workout Plan
            </div>
            <div class="grid">
                <div class="box" id="workout-1">
                    <div class="box-title" contenteditable="true" data-placeholder="Enter workout title..."></div>
                    <div class="box-content" contenteditable="true" data-placeholder="Enter workout details..."></div>
                </div>
                <div class="box" id="workout-2">
                    <div class="box-title" contenteditable="true" data-placeholder="Enter workout title..."></div>
                    <div class="box-content" contenteditable="true" data-placeholder="Enter workout details..."></div>
                </div>
                <div class="box" id="workout-3">
                    <div class="box-title" contenteditable="true" data-placeholder="Enter workout title..."></div>
                    <div class="box-content" contenteditable="true" data-placeholder="Enter workout details..."></div>
                </div>
                <div class="box" id="workout-4">
                    <div class="box-title" contenteditable="true" data-placeholder="Enter workout title..."></div>
                    <div class="box-content" contenteditable="true" data-placeholder="Enter workout details..."></div>
                </div>
                <div class="box" id="workout-5">
                    <div class="box-title" contenteditable="true" data-placeholder="Enter workout title..."></div>
                    <div class="box-content" contenteditable="true" data-placeholder="Enter workout details..."></div>
                </div>
                <div class="box" id="workout-6">
                    <div class="box-title" contenteditable="true" data-placeholder="Enter workout title..."></div>
                    <div class="box-content" contenteditable="true" data-placeholder="Enter workout details..."></div>
                </div>
            </div>
        </div>

        <div class="section">
            <div class="section-title">
                <i class="fas fa-utensils"></i>
                Meal Plan
            </div>
            <div class="grid">
                <div class="box" id="meal-1">
                    <div class="box-title">Breakfast</div>
                    <div class="box-content" contenteditable="true" data-placeholder="Enter meal details..."></div>
                    <div class="calorie-input">
                        <label for="calories-1">Calories:</label>
                        <input type="number" id="calories-1" placeholder="0">
                    </div>
                </div>
                <div class="box" id="meal-2">
                    <div class="box-title">Morning Snack</div>
                    <div class="box-content" contenteditable="true" data-placeholder="Enter meal details..."></div>
                    <div class="calorie-input">
                        <label for="calories-2">Calories:</label>
                        <input type="number" id="calories-2" placeholder="0">
                    </div>
                </div>
                <div class="box" id="meal-3">
                    <div class="box-title">Lunch</div>
                    <div class="box-content" contenteditable="true" data-placeholder="Enter meal details..."></div>
                    <div class="calorie-input">
                        <label for="calories-3">Calories:</label>
                        <input type="number" id="calories-3" placeholder="0">
                    </div>
                </div>
                <div class="box" id="meal-4">
                    <div class="box-title">Afternoon Snack</div>
                    <div class="box-content" contenteditable="true" data-placeholder="Enter meal details..."></div>
                    <div class="calorie-input">
                        <label for="calories-4">Calories:</label>
                        <input type="number" id="calories-4" placeholder="0">
                    </div>
                </div>
                <div class="box" id="meal-5">
                    <div class="box-title">Dinner</div>
                    <div class="box-content" contenteditable="true" data-placeholder="Enter meal details..."></div>
                    <div class="calorie-input">
                        <label for="calories-5">Calories:</label>
                        <input type="number" id="calories-5" placeholder="0">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function updateDate() {
            const dateElement = document.querySelector('.date');
            const now = new Date();
            const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
            dateElement.textContent = now.toLocaleDateString('en-US', options);
        }
        updateDate();
    </script>
</body>
</html>


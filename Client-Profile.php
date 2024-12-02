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
                <div class="profile-picture">JD</div>
                <div class="profile-name">John Doe</div>
            </div>
            <div class="profile-info">
                <div class="info-item">
                    <h3>Age</h3>
                    <p>28 years</p>
                </div>
                <div class="info-item">
                    <h3>Height</h3>
                    <p>180 cm</p>
                </div>
                <div class="info-item">
                    <h3>Weight</h3>
                    <p>75 kg</p>
                </div>
                <div class="info-item">
                    <h3>BMI</h3>
                    <p>23.1 (Normal)</p>
                </div>
                <div class="info-item">
                    <h3>Membership</h3>
                    <p>Gold</p>
                </div>
                <div class="info-item">
                    <h3>Expiry Date</h3>
                    <p>2023-12-31</p>
                </div>

                <div class="info-item">
                    <h3>Next Check In</h3>
                    <p>2023-12-31</p>
                </div>

                <div class="info-item">
                    <h3>Email</h3>
                    <p>test@test.com</p>
                </div>

                <div class="info-item">
                    <h3>Phone Number</h3>
                    <p>1010112212</p>
                </div>

                <div class="info-item">
                    <h3>ID</h3>
                    <p>X127dsa</p>
                </div>

                <div class="info-item">
                <h3>Google Drive (History)</h3>
                    <Button>Google Drive</button>
                </div>

                <div class="info-item">
                <h3>Contact Now</h3>
                    <button>Whatsapp</button>
                    
                </div>

                <div class="info-item">
                <h3>Structured Message</h3>
                    <Button>Extract Message (current Plan)</button>
                   
                </div>

                <div class="info-item">
                <h3>Renew Membership</h3>
                 <select id="months" name="months">
                <option value="1">1 Month</option>
                <option value="3">3 Months</option>
                <option value="6">6 Months</option>
                <option value="12">12 Months</option>
                </select>

                <Button>Renwe Now</button>
                </div>
            </div>
            <div class="workout-plan">
                <h3>Current Workout Plan</h3>
                <div class="plan-item">
                    <h4>Monday & Thursday</h4>
                    <p>Chest and Triceps</p>
                    <ul>
                        <li>Bench Press: 4 sets x 8-10 reps</li>
                        <li>Incline Dumbbell Press: 3 sets x 10-12 reps</li>
                        <li>Tricep Pushdowns: 3 sets x 12-15 reps</li>
                    </ul>
                </div>
                <div class="plan-item">
                    <h4>Tuesday & Friday</h4>
                    <p>Back and Biceps</p>
                    <ul>
                        <li>Deadlifts: 4 sets x 6-8 reps</li>
                        <li>Pull-ups: 3 sets x 8-10 reps</li>
                        <li>Barbell Curls: 3 sets x 10-12 reps</li>
                    </ul>
                </div>
                <div class="plan-item">
                    <h4>Wednesday & Saturday</h4>
                    <p>Legs and Shoulders</p>
                    <ul>
                        <li>Squats: 4 sets x 8-10 reps</li>
                        <li>Leg Press: 3 sets x 10-12 reps</li>
                        <li>Military Press: 3 sets x 8-10 reps</li>
                    </ul>
                </div>
            </div>
            <div class="diet-plan">
                <h3>Current Diet Plan</h3>
                <div class="plan-item">
                    <h4>Breakfast</h4>
                    <p>Oatmeal with berries and a protein shake</p>
                </div>
                <div class="plan-item">
                    <h4>Lunch</h4>
                    <p>Grilled chicken breast with brown rice and vegetables</p>
                </div>
                <div class="plan-item">
                    <h4>Dinner</h4>
                    <p>Salmon with sweet potato and green salad</p>
                </div>
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
                <button >Edit Profile</button>
                <a id="BtPlane" href="plan.php" >Update Plan</a>
                <a  id="BtPlane">Add Note</a>
            </div>
        </div>
    </div>

    
</body>
</html>


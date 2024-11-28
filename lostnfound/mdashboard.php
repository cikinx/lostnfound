<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <style>
        /* Basic Page Styling */
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f1f3f5; /* Light gray background for a professional admin look */
            margin: 0;
            position: relative; /* Enable positioning for the logout button */
        }
        
        /* Container Styling */
        .container {
            width: 80%;
            max-width: 900px;
            padding: 40px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        h1 {
            font-size: 32px;
            color: #2c3e50;
            margin-bottom: 40px;
        }

        /* Dashboard Styling */
        .dashboard {
            display: flex;
            justify-content: space-around;
            flex-wrap: wrap;
            gap: 20px;
        }

        /* Button Styling */
        .dashboard a {
            text-decoration: none;
            color: white;
            background-color: #34495e; /* Dark blue-gray color for a unified admin theme */
            padding: 20px;
            border-radius: 10px;
            font-size: 18px;
            font-weight: bold;
            transition: background-color 0.3s ease, transform 0.2s ease;
            text-align: center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            flex-basis: calc(33% - 20px); /* Adjust width for three buttons per row */
        }

        /* Hover and Active States */
        .dashboard a:hover {
            background-color: #2c3e50;
            transform: translateY(-3px);
        }
        
        .dashboard a:active {
            background-color: #2c3e50;
            transform: translateY(0);
        }

        /* Logout Button Styling */
        .logout-btn {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background-color: #007BFF;
            border: none;
            border-radius: 50%;
            width: 50px;
            height: 50px;
            display: flex;
            justify-content: center;
            align-items: center;
            cursor: pointer;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: background 0.3s ease;
        }

        .logout-btn:hover {
            background-color: #0056b3;
        }

        .logout-btn i {
            color: white;
            font-size: 20px;
        }

        /* Responsive Design */
        @media (max-width: 600px) {
            .dashboard a {
                flex-basis: calc(100% - 20px); /* Full width for smaller screens */
            }
        }
    </style>
    <!-- Add FontAwesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha384-k6RqeWeci5ZR/Lv4MR0sA0FfDOMxC63V6VbHs3Ea0Yd5jwZGRFf3CZ1LAnLq5v1I" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
</head>
<body>
    
    <div class="container">
        <h1>Admin Dashboard</h1>
        <div class="dashboard">
            <a href="maddnew.php">Add Admin</a>
            <a href="view_admin.php">View Admin</a>
            <a href="view_user.php">View Users</a>
            <a href="mview.php">View Lost Items</a>
        </div>
    </div>

    <!-- Logout Button -->
    <button class="logout-btn" onclick="location.href='mlogout.php'">
        <i class="fas fa-sign-out-alt"></i>
    </button>

</body>
</html>

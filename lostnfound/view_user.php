<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User List</title>
    <style>
         /* General Styling */
         body {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f1f3f5;
            margin: 0;
        }

        h2 {
            font-size: 28px;
            color: #2c3e50;
            margin-bottom: 20px;
        }

        /* Table Styling */
        table {
            width: 90%;
            border-collapse: collapse;
            margin-bottom: 40px;
            background-color: #f1f3f5;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
        }

        th, td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #2c3e50;
            color: #ecf0f1;
        }

        th {
            background-color: #2c3e50;
            font-weight: bold;
        }

        td {
            background-color: #3b4a57;
        }

        /* Links Styling */
        a {
            text-decoration: none;
            color: #ecf0f1;
            font-weight: bold;
            margin-bottom: 20px;
            transition: color 0.3s ease;
        }

        a:hover {
            color: #e74c3c;
        }

        /* Search Box Styling */
        .search-container {
            margin-bottom: 20px;
            display: flex;
            gap: 10px;
        }

        input[type="text"] {
            padding: 10px;
            font-size: 16px;
            border: 2px solid #2c3e50;
            border-radius: 5px;
            width: 300px;
            background-color: #ecf0f1;
            color: #34495e;
            outline: none;
        }

        input[type="submit"] {
            padding: 10px 20px;
            font-size: 16px;
            background-color: #2c3e50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        input[type="submit"]:hover {
            background-color: #34495e;
        }

        /* Delete Button Styling */
        .btn-delete {
            background-color: #e74c3c;
            color: white;
            padding: 8px 12px;
            border-radius: 5px;
            text-decoration: none;
            font-size: 14px;
            transition: background-color 0.3s ease;
        }

        .btn-delete:hover {
            background-color: #c0392b;
        }
        /* Update Button Styling */
        .btn-update {
            background-color: #9EDF9C;
            color: white;
            padding: 8px 12px;
            border-radius: 5px;
            text-decoration: none;
            font-size: 14px;
            transition: background-color 0.3s ease;
        }

        .btn-update:hover {
            background-color: #C2FFC7;
        }
        .back-button {
            display: inline-block;
            text-decoration: none;
            background-color: #8000ff; /* Button background color */
            color: white; /* Text color */
            padding: 10px 20px; /* Padding for better size */
            border-radius: 5px; /* Rounded corners */
            font-size: 1rem; /* Adjust font size */
            font-weight: bold; /* Bold text */
            box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.2); /* Slight shadow for depth */
            transition: background-color 0.3s ease, transform 0.2s ease; /* Smooth hover effects */
        }

        .back-button:hover {
            background-color: #5f00cc; /* Darker background on hover */
            transform: scale(1.05); /* Slight zoom effect */
        }

        .back-button:active {
            background-color: #4b009e; /* Even darker when clicked */
            transform: scale(0.95); /* Shrink slightly on click */
        }

        /* Responsive Table for Small Screens */
        @media (max-width: 768px) {
            table, th, td {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <h2>User List</h2>

    <div class="search-container">
        <form method="GET" action="view_user.php">
            <input type="text" name="search" placeholder="Search Users" value="<?= isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '' ?>">
            <input type="submit" value="Search">
        </form>
    </div>

    <table>
        <thead>
        <a href="mdashboard.php" class="back-button">&#8592; Back to Dashboard</a>
            <tr>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>

        <?php
        include 'connect.php';

        // If there's a search query, filter the results
        $search = isset($_GET['search']) ? mysqli_real_escape_string($conn, $_GET['search']) : '';
        $sql = !empty($search) ?
            "SELECT * FROM users WHERE firstName LIKE '%$search%' OR lastName LIKE '%$search%' ORDER BY Id DESC" :
            "SELECT * FROM users ORDER BY Id DESC";

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) { ?>
                <tr>
                    <td><?= htmlspecialchars($row['firstName']) ?></td>
                    <td><?= htmlspecialchars($row['lastName']) ?></td>
                    <td><?= htmlspecialchars($row['email']) ?></td>
                    <td>
                        <a href="delete_user.php?Id=<?= $row['Id'] ?>" class="btn-delete">Delete</a>
                        &nbsp;
                        <a href="update_user.php?Id=<?= $row['Id'] ?>" class="btn-update">Update</a>
                    </td>
                </tr>
            <?php }
        } else { ?>
            <tr>
                <td colspan="4" style="text-align: center;">No users found.</td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</body>
</html>

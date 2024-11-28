<?php include "db_conn.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Lost Items</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">

    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #EEEEEE;
        }
        h2 {
            font-size: 28px;
            color: #133E87;
            margin-bottom: 20px;
        }
        .search-container {
            margin-bottom: 20px;
            display: flex;
            gap: 10px;
        }
        input[type="text"] {
            padding: 10px;
            font-size: 16px;
            border: 2px solid #608BC1;
            border-radius: 5px;
            width: 300px;
            background-color: #ffffff;
            color: #495057;
            outline: none;
        }
        input[type="submit"] {
            padding: 10px 20px;
            font-size: 16px;
            background-color: #608BC1;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        input[type="submit"]:hover {
            background-color: #486A94;
        }
        table {
            width: 80%;
            border-collapse: collapse;
            margin-bottom: 40px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 8px 8px rgba(0, 0, 0, 0.1);
        }
        th, td {
            padding: 15px;
            font-size: 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #608BC1;
            color: white;
        }
        td {
            color: #495057;
        }
        img {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border-radius: 8px;
        }
        a {
            text-decoration: none;
            color: #007bff;
            font-weight: bold;
            margin-bottom: 20px;
        }
        a:hover {
            text-decoration: underline;
        }
        /* Homepage Button Styling */
        .home-button {
            position: fixed;
            bottom: 20px;
            right: 20px;
            width: 50px;
            height: 50px;
            background-color: #8000ff; /* Matching the theme color */
            color: #ffffff;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.2);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            z-index: 1000;
            text-decoration: none;
        }

        .home-button:hover {
            transform: scale(1.1);
            box-shadow: 0px 6px 10px rgba(0, 0, 0, 0.3);
            background-color: #5a00cc;
        }

    </style>
</head>
<body>
    <a href="upload.html">&#8592; Back to Upload</a>
    <h2>Lost and Found Items</h2>

    <!-- Search form -->
    <div class="search-container">
        <form method="GET" action="">
            <input type="text" name="search" placeholder="Search by item type or place found" value="<?= isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '' ?>">
            <input type="submit" value="Search">
        </form>
    </div>

    <table>
        <thead>
            <tr>
                <th>Item Type</th>
                <th>Place Found</th>
                <th>Security Question</th>
                <th>Contact Info</th>
                <th>Image</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            // Check if there's a search query
            if (isset($_GET['search']) && !empty($_GET['search'])) {
                $search = mysqli_real_escape_string($conn, $_GET['search']);
                $sql = "SELECT * FROM lost_items WHERE item_type LIKE '%$search%' OR place_found LIKE '%$search%' ORDER BY id DESC";
            } else {
                $sql = "SELECT * FROM lost_items ORDER BY id DESC";
            }

            $res = mysqli_query($conn, $sql);

            if (mysqli_num_rows($res) > 0) {
                while ($row = mysqli_fetch_assoc($res)) { ?>
                    <tr>
                        <td><?= htmlspecialchars($row['item_type']) ?></td>
                        <td><?= htmlspecialchars($row['place_found']) ?></td>
                        <td><?= htmlspecialchars($row['security_question']) ?></td>
                        <td><?= substr(htmlspecialchars($row['contact_info']), 0, 3) . '*******' ?></td>
                        <td><img src="uploads/<?= htmlspecialchars($row['image_url']) ?>" alt="Lost item image"></td>
                        <td><?= $row['is_claimed'] ? 'Claimed' : 'Available' ?></td>
                    </tr>
                <?php } 
            } else { ?>
                <tr>
                    <td colspan="7" style="text-align: center;">No lost items found.</td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    <a href="index.html" class="home-button">
    <i class="fas fa-home"></i>
    </a>
</body>
</html>

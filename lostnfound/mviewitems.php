<?php include "mconnect.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Lost and Found Items</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa; 
        }
        h2 {
            font-size: 28px;
            color: #007bff;
            margin-bottom: 20px;
        }
        table {
            width: 80%;
            border-collapse: collapse;
            margin-bottom: 40px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        th, td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #007bff;
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
        .actions a {
            text-decoration: none;
            color: #007bff;
            margin-right: 10px;
        }
        .actions a:hover {
            text-decoration: underline;
        }
        a.add-item {
            text-decoration: none;
            color: white;
            background-color: #007bff;
            padding: 10px 20px;
            border-radius: 5px;
            margin-bottom: 20px;
            display: inline-block;
        }
    </style>
</head>
<body>
    <h2>Lost and Found Items</h2>
    <a href="upload.html" class="add-item"> Add New Item</a> <!-- Add item link -->
    <table>
        <thead>
            <tr>
                <th>Item Type</th>
                <th>Place Found</th>
                <th>Security Question</th>
                <th>Contact Info</th>
                <th>Image</th>
                <th>Actions</th> <!-- Column for Edit/Delete actions -->
            </tr>
        </thead>
        <tbody>
            <?php 
            $sql = "SELECT * FROM lost_items ORDER BY id DESC";
            $res = mysqli_query($conn, $sql);

            if (mysqli_num_rows($res) > 0) {
                while ($row = mysqli_fetch_assoc($res)) { ?>
                    <tr>
                        <td><?= htmlspecialchars($row['item_type']) ?></td>
                        <td><?= htmlspecialchars($row['place_found']) ?></td>
                        <td><?= htmlspecialchars($row['security_question']) ?></td>
                        <td><?= htmlspecialchars($row['contact_info']) ?></td>
                        <td><img src="uploads/<?= htmlspecialchars($row['image_url']) ?>" alt="Lost item image"></td>
                        <td class="actions">
                            <a href="edit_item.php?id=<?= $row['id'] ?>">Edit</a> <!-- Edit item link -->
                            <a href="delete_item.php?id=<?= $row['id'] ?>" onclick="return confirm('Are you sure you want to delete this item?');">Delete</a> <!-- Delete item link -->
                        </td>
                    </tr>
                <?php } 
            } else { ?>
                <tr>
                    <td colspan="6" style="text-align: center;">No lost items found.</td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</body>
</html>

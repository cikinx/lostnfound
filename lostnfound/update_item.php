<?php
include 'db_conn.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM lost_items WHERE id = $id";
    $result = $conn->query($sql);
    $item = $result->fetch_assoc();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $item_type = $_POST['item_type'];
    $place_found = $_POST['place_found'];
    $security_question = $_POST['security_question'];
    $contact_info = $_POST['contact_info'];

    $update_sql = "UPDATE lost_items SET item_type='$item_type', place_found='$place_found', security_question='$security_question', contact_info='$contact_info' WHERE id = $id";
    $conn->query($update_sql);

    header('Location: mview.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Item</title>
    <link rel="stylesheet" href="update.css">
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900&display=swap" rel="stylesheet">
</head>
<body>
    <form method="POST">
    <h2>Update Lost Item</h2>
        <label>Item Type:</label><input type="text" name="item_type" value="<?= htmlspecialchars($item['item_type']) ?>" required><br>
        <label>Place Found:</label><input type="text" name="place_found" value="<?= htmlspecialchars($item['place_found']) ?>" required><br>
        <label>Security Question:</label><input type="text" name="security_question" value="<?= htmlspecialchars($item['security_question']) ?>" required><br>
        <label>Contact Info:</label><input type="text" name="contact_info" value="<?= htmlspecialchars($item['contact_info']) ?>" required><br>
        <input type="submit" value="Update">
    </form>
</body>
</html>

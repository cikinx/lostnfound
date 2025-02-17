<?php
include 'db_conn.php';

if (isset($_GET['Id'])) {
    $id = $_GET['Id'];
    $sql = "SELECT * FROM musers WHERE Id = $id";
    $result = $conn->query($sql);
    $admin = $result->fetch_assoc();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];

    $update_sql = "UPDATE musers SET firstName='$firstName', lastName='$lastName', email='$email' WHERE Id = $id";
    $conn->query($update_sql);

    header('Location: view_admin.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Admin</title>
    <link rel="stylesheet" href="update.css">
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900&display=swap" rel="stylesheet">
</head>
<body>
    <form method="POST">
    <h2>Update Admin</h2>
        <label>First Name:</label><input type="text" name="firstName" value="<?= htmlspecialchars($admin['firstName']) ?>" required><br>
        <label>Last Name:</label><input type="text" name="lastName" value="<?= htmlspecialchars($admin['lastName']) ?>" required><br>
        <label>Email:</label><input type="email" name="email" value="<?= htmlspecialchars($admin['email']) ?>" required><br>
        <input type="submit" value="Update">
    </form>
</body>
</html>

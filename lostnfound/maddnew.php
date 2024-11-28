<?php
include 'mconnect.php';

if(isset($_POST['addAdmin'])){
    $firstName = $_POST['fName'];
    $lastName = $_POST['lName'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $hashedPassword = md5($password); // Hash the password

    // Check if email already exists
    $checkEmail = "SELECT * FROM musers WHERE email = '$email'";
    $result = $conn->query($checkEmail);

    if($result->num_rows > 0){
        $message = "Email Address Already Exists!";
    } else {
        // Insert new admin
        $insertQuery = "INSERT INTO musers (firstName, lastName, email, password) VALUES ('$firstName', '$lastName', '$email', '$hashedPassword')";
        if($conn->query($insertQuery) === TRUE){
            $message = "Admin added successfully!";
        } else {
            $message = "Error: " . $conn->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Admin</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <link rel="stylesheet" href="maddnew.css">
</head>

<body>
    
<a href="mdashboard.php">&#8592; Back to Dashboard</a>
    <div class="container" id="addAdminContainer">
        <h1 class="form-title">Add New Admin</h1>
        <?php if(isset($message)) { echo "<p>$message</p>"; } ?>
        <form method="post" action="">
            <div class="input-group">
                <i class="fas fa-user"></i>
                <input type="text" name="fName" id="fName" placeholder="First Name" required>
                <label for="fName">First Name</label>
            </div>
            <div class="input-group">
                <i class="fas fa-user"></i>
                <input type="text" name="lName" id="lName" placeholder="Last Name" required>
                <label for="lName">Last Name</label>
            </div>
            <div class="input-group">
                <i class="fas fa-envelope"></i>
                <input type="email" name="email" id="email" placeholder="Email" required>
                <label for="email">Email</label>
            </div>
            <div class="input-group">
                <i class="fas fa-lock"></i>
                <input type="password" name="password" id="password" placeholder="Password" required>
                <label for="password">Password</label>
            </div>
            <input type="submit" class="btn" value="Add Admin" name="addAdmin">
        </form>
    </div>
</body>
</html>

<?php 
include 'mconnect.php';

if(isset($_POST['signUp'])){
   $firstName = $_POST['fName'];
   $lastName = $_POST['lName'];
   $email = trim($_POST['email']);
   $password = trim($_POST['password']);
   $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

   // Check if email already exists
   $checkEmail = "SELECT * FROM musers WHERE email = '$email'";
   $result = $conn->query($checkEmail);
   
   if($result->num_rows > 0){
       echo "Email Address Already Exists!";
   } else {
       $insertQuery = "INSERT INTO musers (firstName, lastName, email, password) VALUES ('$firstName', '$lastName', '$email', '$hashedPassword')";
       if($conn->query($insertQuery) === TRUE){
           header("Location: mlogin.php");
           exit();
       } else {
           echo "Error: " . $conn->error;
       }
   }
}

if(isset($_POST['signIn'])){
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    // Validate user credentials
    $sql = "SELECT * FROM musers WHERE email = '$email'";
    $result = $conn->query($sql);

    if($result->num_rows > 0){
        $row = $result->fetch_assoc();
        $dbHashedPassword = $row['password'];
        
        // Debugging output
        echo "Password entered: $password <br>";
        echo "Hashed password in DB: $dbHashedPassword <br>";

        if(password_verify($password, $dbHashedPassword)){
            session_start();
            $_SESSION['email'] = $row['email'];
            header("Location: mdashboard.php");
            exit();
        } else {
            echo "Incorrect Password!";
        }
    } else {
        echo "Email not found!";
    }
}
?>

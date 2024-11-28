<?php
// Include your database connection file
include 'mconnect.php';

// Set PHP timezone
date_default_timezone_set('Asia/Kuala_Lumpur');

// Initialize variables
$error = '';
$success = '';

// Check if the token is present in the URL
if (isset($_GET['token'])) {
    $token = $_GET['token'];

    // Validate the token
    $stmt = $conn->prepare("SELECT * FROM musers WHERE reset_token = ? AND token_expiry > NOW()");
    $stmt->bind_param('s', $token);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Token is valid; fetch the user record
        $user = $result->fetch_assoc();

        // Process password reset when the form is submitted
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $newPassword = $_POST['newPassword'];
            $confirmPassword = $_POST['confirmPassword'];

            // Validate passwords
            if (empty($newPassword) || empty($confirmPassword)) {
                $error = "Both password fields are required.";
            } elseif ($newPassword !== $confirmPassword) {
                $error = "Passwords do not match.";
            } elseif (strlen($newPassword) < 6) {
                $error = "Password must be at least 6 characters.";
            } else {
                // Hash the new password
                $hashedPassword = password_hash($newPassword, PASSWORD_BCRYPT);

                // Update the password in the database and clear the token
                $updateStmt = $conn->prepare("UPDATE musers SET password = ?, reset_token = NULL, token_expiry = NULL WHERE reset_token = ?");
                $updateStmt->bind_param('ss', $hashedPassword, $token);

                if ($updateStmt->execute()) {
                    $success = "Your password has been reset successfully. You can now <a href='mlogin.php'>log in</a>.";
                } else {
                    $error = "Failed to reset your password. Please try again.";
                }
            }
        }
    } else {
        $error = "Invalid or expired token.";
    }
} else {
    $error = "No token provided.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900&display=swap" rel="stylesheet">
    <title>Reset Password</title>
    <style>
        /* General styling */
        body {
            font-family: "Poppins", sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f9fa;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        /* Form container */
        .form-container {
            background: #ffffff;
            padding: 25px 30px;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            max-width: 450px;
            width: 100%;
            text-align: center;
        }

        .form-container h2 {
            font-size: 24px;
            color: #343a40;
            margin-bottom: 20px;
        }

        /* Input fields */
        .form-container input {
            font-family: "Poppins", sans-serif;
            width: 90%;
            padding: 12px 15px;
            margin: 12px 0;
            border: 1px solid #ced4da;
            border-radius: 8px;
            font-size: 14px;
            outline: none;
            transition: 0.3s ease;
        }

        .form-container input:focus {
            border-color: #007bff;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.3);
        }

        /* Button */
        .form-container button {
            font-family: "Poppins", sans-serif;
            width: 100%;
            padding: 12px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
            transition: 0.3s ease;
        }

        .form-container button:hover {
            background-color: #0056b3;
        }

        /* Message styles */
        .message {
            margin-top: 20px;
            font-size: 14px;
        }

        .error {
            color: #e3342f;
        }

        .success {
            color: #38c172;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>Reset Password</h2>
        <?php if ($error): ?>
            <p class="error"><?php echo $error; ?></p>
        <?php endif; ?>
        <?php if ($success): ?>
            <p class="success"><?php echo $success; ?></p>
        <?php else: ?>
            <form method="POST">
                <input type="password" name="newPassword" placeholder="New Password" required>
                <input type="password" name="confirmPassword" placeholder="Confirm Password" required>
                <br><br>
                <button type="submit">Reset Password</button>
            </form>
        <?php endif; ?>
    </div>
</body>
</html>

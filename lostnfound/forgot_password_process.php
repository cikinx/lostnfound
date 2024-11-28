<?php
// Set the correct timezone for PHP
date_default_timezone_set('Asia/Kuala_Lumpur'); // Replace with your correct timezone

// Include PHPMailer
require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Database connection
include 'connect.php'; // Assuming this connects to the correct database

$message = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];

    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message = "Invalid email format.";
    } else {
        // Check if the email exists in the database
        $query = "SELECT * FROM users WHERE email = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // Generate a unique reset token
            $token = bin2hex(random_bytes(50));
            $expiryDate = date("Y-m-d H:i:s", strtotime("+30 minutes"));

            // Save token and expiry date in the database
            $updateQuery = "UPDATE users SET reset_token = ?, token_expiry = ? WHERE email = ?";
            $stmt = $conn->prepare($updateQuery);
            $stmt->bind_param('sss', $token, $expiryDate, $email);
            $stmt->execute();

            // Send the reset email using PHPMailer
            $mail = new PHPMailer(true);

            try {
                // SMTP Configuration
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'nrashikinyusri21@gmail.com'; // Your email
                $mail->Password = 'cvvz vioh nkpd dcuv';        // Your App Password
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port = 587;

                // Disable SSL certificate verification (for development purposes only)
                $mail->SMTPOptions = array(
                    'ssl' => array(
                        'verify_peer' => false,
                        'verify_peer_name' => false,
                        'allow_self_signed' => true,
                    ),
                );

                // Email settings
                $mail->setFrom('nrashikinyusri21@gmail.com', 'ReclaimUPTM');
                $mail->addAddress($email); // Recipient's email
                $mail->Subject = 'Password Reset Request';

                // Dynamically generate the reset link with the current host and port
                $host = $_SERVER['HTTP_HOST']; // Gets "localhost"
                $resetLink = "http://$host/lostnfound/reset_password.php?token=$token";
                $mail->Body = "Hi,<br><br>Click the link below to reset your password:<br><a href='$resetLink'>$resetLink</a>";
                $mail->isHTML(true);

                $mail->send();
                $message = "A password reset link has been sent to your email.";
            } catch (Exception $e) {
                $message = "Failed to send email. Mailer Error: {$mail->ErrorInfo}";
            }
        } else {
            $message = "No account found with that email.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900&display=swap" rel="stylesheet">
    <title>Forgot Password</title>
</head>
<body>
    <div class="form-container">
        <h2>Forgot Password</h2>
        <!-- Message container -->
        <?php if (!empty($message)): ?>
            <div class="message <?php echo (strpos($message, 'Invalid') !== false || strpos($message, 'Failed') !== false || strpos($message, 'No account') !== false) ? 'error' : ''; ?>">
                <?php echo $message; ?>
            </div>
        <?php endif; ?>
        
        <!-- Form -->
        <form method="POST">
            <input type="email" name="email" placeholder="Enter your registered email" required><br>
            <button type="submit" class="btn submit-btn">Send Reset Link</button>
        </form>
    </div>

    <style>
        /* Add this CSS styling */
        body {
            font-family: "Poppins", sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .form-container {
            font-family: "Poppins", sans-serif;
            background-color: #ffffff;
            padding: 20px 30px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
            text-align: center;
        }

        h2 {
            font-family: "Poppins", sans-serif;
            margin-bottom: 20px;
            font-size: 24px;
            color: #333333;
        }

        form {
            font-family: "Poppins", sans-serif;
            display: flex;
            flex-direction: column;
        }

        input[type="email"] {
            font-family: "Poppins", sans-serif;
            padding: 10px 15px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 14px;
        }

        input[type="email"]:focus {
            outline: none;
            border-color: #007BFF;
            box-shadow: 0 0 3px rgba(0, 123, 255, 0.5);
        }

        button {
            padding: 10px 15px;
            background-color: #007BFF;
            color: #ffffff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            font-weight: bold;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #0056b3;
        }

        button:focus {
            outline: none;
            box-shadow: 0 0 4px rgba(0, 123, 255, 0.7);
        }

        .message {
            font-family: "Poppins", sans-serif;
            background-color: #eafaf1;
            color: #2c7c31;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #c3e6cb;
            border-radius: 4px;
        }

        .message.error {
            background-color: #f8d7da;
            color: #721c24;
            border-color: #f5c6cb;
        }

        @media screen and (max-width: 768px) {
            .form-container {
                padding: 15px 20px;
            }

            h2 {
                font-size: 20px;
            }

            button {
                font-size: 14px;
            }
        }
    </style>
</body>
</html>

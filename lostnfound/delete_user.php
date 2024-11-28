<?php
include 'connect.php';

if (isset($_GET['Id'])) {
    $Id = $_GET['Id'];

    // SQL query to delete the user
    $sql = "DELETE FROM users WHERE Id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $Id);

    if ($stmt->execute()) {
        // Redirect back to the user list after deletion
        header("Location: view_user.php");
        exit;
    } else {
        echo "Error deleting user: " . $conn->error;
    }

    $stmt->close();
} else {
    echo "No user ID specified.";
}

$conn->close();
?>

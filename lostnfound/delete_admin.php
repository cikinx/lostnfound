<?php
session_start();
include 'db_conn.php';

// Check if the user ID is provided in the URL
if (isset($_GET['Id'])) {
    $Id = intval($_GET['Id']); // Sanitize the ID

    // Delete the user from the database
    $sql = "DELETE FROM musers WHERE Id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $Id);

    if ($stmt->execute()) {
        // Redirect back to the admin list page with a success message
        header("Location: view_admins.php");
        exit;
    } else {
        echo "Error deleting admin: " . $conn->error;
    }

    $stmt->close();
} else {
    echo "No admin ID specified.";
}
$conn->close();
?>

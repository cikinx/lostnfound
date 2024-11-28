<?php
session_start();
include 'db_conn.php';

// Check if the user ID is provided in the URL
if (isset($_GET['id'])) {
    $id = intval($_GET['id']); // Sanitize the ID

    // Delete the user from the database
    $sql = "DELETE FROM lost_items WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        // Redirect back to the admin list page with a success message
        header("Location: mview.php");
        exit;
    } else {
        echo "Error deleting item: " . $conn->error;
    }

    $stmt->close();
} else {
    echo "No item ID specified.";
}
$conn->close();
?>

<?php
include 'db_conn.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    // Update the is_claimed status to 1 (claimed)
    $sql = "UPDATE lost_items SET is_claimed = 1 WHERE id = $id";
    if (mysqli_query($conn, $sql)) {
        header("Location: mview.php?success=Item claimed successfully");
    } else {
        header("Location: mview.php?error=Failed to claim item");
    }
} else {
    header("Location: mview.php");
}
?>

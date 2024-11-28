<?php

if (isset($_POST['submit']) && isset($_FILES['my_image'])) {
    include "connect.php";

    // Collect and sanitize additional form data
    $item_type = mysqli_real_escape_string($conn, $_POST['item_type']);
    $place_found = mysqli_real_escape_string($conn, $_POST['place_found']);
    $security_question = mysqli_real_escape_string($conn, $_POST['security_question']);
    $answer = mysqli_real_escape_string($conn, $_POST['answer']);
    $contact_info = mysqli_real_escape_string($conn, $_POST['contact_info']);

    // Retrieve image data
    $img_name = $_FILES['my_image']['name'];
    $img_size = $_FILES['my_image']['size'];
    $tmp_name = $_FILES['my_image']['tmp_name'];
    $error = $_FILES['my_image']['error'];

    if ($error === 0) {
        // Check image size
        if ($img_size > 125000) {
            $em = "Sorry, the file is too large";
            header("Location: upload.html?error=$em");
        } else {
            // Get image extension
            $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
            $img_ex_ic = strtolower($img_ex);

            // Allowed image extensions
            $allowed_exs = array("jpg", "jpeg", "png");

            // Check if the extension is valid
            if (in_array($img_ex_ic, $allowed_exs)) {
                // Generate a unique image name
                $new_img_name = uniqid("IMG-", true) . '.' . $img_ex_ic;
                $img_upload_path = 'uploads/' . $new_img_name;

                // Move uploaded image to the specified folder
                move_uploaded_file($tmp_name, $img_upload_path);

                // Insert into the database
                $sql = "INSERT INTO lost_items (item_type, place_found, security_question, answer, contact_info, image_url) 
                        VALUES ('$item_type', '$place_found', '$security_question', '$answer', '$contact_info', '$new_img_name')";

                // Execute the query
                if (mysqli_query($conn, $sql)) {
                    // Redirect to view page or success message
                    header("Location: view.php");
                } else {
                    $em = "Error inserting data into the database";
                    header("Location: upload.html?error=$em");
                }
            } else {
                $em = "You can't upload files of this type";
                header("Location: upload.html?error=$em");
            }
        }
    } else {
        $em = "Unknown error occurred";
        header("Location: upload.html?error=$em");
    }
} else {
    header("Location: upload.html");
}

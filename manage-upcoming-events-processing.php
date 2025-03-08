<?php
session_start();
include 'includes.php';
ini_set('display_errors', 1);
error_reporting(E_ALL);

if (isset($_POST['submit'])) {
    // Check if the database connection is successful
    if (!$connection) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Validate and sanitize form data
    $event_title = mysqli_real_escape_string($connection, $_POST['event_title']);
    $place = mysqli_real_escape_string($connection, $_POST['place']);
    $date = mysqli_real_escape_string($connection, $_POST['datee']);
    $time = mysqli_real_escape_string($connection, $_POST['timee']);

    // Check if a file was uploaded
    if (isset($_FILES['photo'])) {
        $photo = $_FILES['photo'];

        // Validate file
        $allowed_types = array('jpg', 'jpeg', 'png', 'gif');
        $max_size = 5 * 1024 * 1024; // 5MB
        $filename = $photo['name'];
        $file_ext = pathinfo($filename, PATHINFO_EXTENSION);

        if (!in_array(strtolower($file_ext), $allowed_types)) {
            $_SESSION['file_error'] = 'Invalid file type. Only JPG, JPEG, PNG, and GIF files are allowed.';
            header("location: manage-upcoming-events.php");
            die();
        }

        if ($photo['size'] > $max_size) {
            $_SESSION['file_error'] = 'Maximum file size is 5MB.';
            header("location: manage-upcoming-events.php");
            die();
        }

        // Save file
        $filename = uniqid() . '.' . $file_ext;
        $destination = 'uploads/' . $filename;

        if (!move_uploaded_file($photo['tmp_name'], $destination)) {
            $_SESSION['file_error'] = 'Failed to upload file.';
            header("location: manage-upcoming-events.php");
            die();
        }
    } else {
        $_SESSION['file_error'] = 'No file uploaded.';
        header("location: manage-upcoming-events.php");
        die();
    }

    // Prepare and execute the SQL statement using a prepared statement
    $sql = "INSERT INTO upcomin_events (event_title, place, datee, timee, photo) VALUES (?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($connection, $sql);

if ($stmt == false) {
    die("Error: " . mysqli_error($connection)); // Display the detailed error message
}


        if (mysqli_stmt_execute($stmt)) {
            $_SESSION['file_success_upload'] = 'Event uploaded successfully.';
            header("location: manage-upcoming-events.php");
        } else {
            $_SESSION['file_error'] = 'Failed to upload data to the database.';
            header("location: manage-upcoming-events.php");
        }

        mysqli_stmt_close($stmt);
    } else {
        $_SESSION['file_error'] = 'Failed to prepare the SQL statement.';
        header("location: manage-upcoming-events.php");
    }

    mysqli_close($connection);

?>

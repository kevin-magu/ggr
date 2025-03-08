<?php
session_start();
ini_set('display_errors', 1);

include 'includes.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    $blog_title = $_POST['blog_title'];
    $paragraph1 = $_POST['paragraph1'];
    $paragraph2 = $_POST['paragraph2'];
    $paragraph3 = $_POST['paragraph3'];
    $author = $_POST['author'];
    $photo1 = $_FILES['photo1'];

    $allowed_types = array('jpg', 'jpeg', 'png', 'gif');
    $max_size = 2 * 1024 * 1024; // 2MB

    $filename_1 = $photo1['name'];
    $file_ext_1 = pathinfo($filename_1, PATHINFO_EXTENSION);

    if (!in_array(strtolower($file_ext_1), $allowed_types)) {
        $_SESSION['file_type'] = 'Invalid file type. Only JPG, JPEG, PNG, and GIF files are allowed.';
        header("Location: manage-blogs.php");
        exit();
    }

    if ($photo1['size'] > $max_size) {
        $_SESSION['file_size'] = 'File size should be below 2MB.';
        header("Location: manage-blogs.php");
        exit();
    }

    // Save file
    $filename_1 = uniqid() . '.' . $file_ext_1;
    $destination = 'uploads/' . $filename_1;

    if (!move_uploaded_file($photo1['tmp_name'], $destination)) {
        $_SESSION['file_error'] = 'There was a problem uploading the file.';
        header("Location: manage-blogs.php");
        exit();
    }

    // Sanitize user inputs to avoid SQL injection
    $blog_title = mysqli_real_escape_string($connection, $blog_title);
    $paragraph1 = mysqli_real_escape_string($connection, $paragraph1);
    $paragraph2 = mysqli_real_escape_string($connection, $paragraph2);
    $paragraph3 = mysqli_real_escape_string($connection, $paragraph3);
    $author = mysqli_real_escape_string($connection, $author);

    // Insert data into the database using prepared statement
    $query = "INSERT INTO blogs(blog_title, paragraph1, paragraph2, paragraph3, photo1, author) 
              VALUES('$blog_title', '$paragraph1', '$paragraph2', '$paragraph3', '$filename_1', '$author')";
    
    $stmt = mysqli_prepare($connection, $query);
    if ($stmt) {
        if (mysqli_stmt_execute($stmt)) {
            $_SESSION['file_success_upload'] = 'Blog uploaded successfully.';
            header("Location: manage-blogs.php");
            exit();
        } else {
            echo "Error executing the query: " . mysqli_error($connection);
        }
        mysqli_stmt_close($stmt);
    } else {
        echo "Error in preparing the statement: " . mysqli_error($connection);
    }
} else {
    echo "Please submit the form on the add blog page.";
}

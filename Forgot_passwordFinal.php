<?php
session_start();
include 'connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $answer1 = $_POST['secure1'];
    $answer2 = $_POST['secure2'];

    // Check if the email exists in the database
    $stmt = $conn->prepare("SELECT * FROM user WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 0) {
        // No email found in the database
        echo "<script>alert('Email not found. Please check your email and try again.');</script>";
        echo "<script>window.location = 'Forgot_password.php';</script>";
        exit();
    }

    // Validate security answers if email is found
    $stmt = $conn->prepare("SELECT * FROM user WHERE email = ? AND SecurityAnswer1 = ? AND SecurityAnswer2 = ?");
    $stmt->bind_param("sss", $email, $answer1, $answer2);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Security answers are correct
        $_SESSION['verified_user'] = $email; // Store email in session for password reset
        echo "<script>alert('You have been verified. Please proceed to reset your password.');</script>";
        echo "<script>window.location = 'reset_password.php';</script>"; // Redirect after alert
        exit();
    } else {
        echo "<script>alert('Incorrect Answer for Security Question. Please try again');</script>";
        echo "<script>window.location = 'Forgot_password.php';</script>"; // Redirect after alert
    }
}
?>

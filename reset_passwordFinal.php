<?php
session_start();
include 'connect.php';

if (!isset($_SESSION['verified_user'])) {
    // If no verified user, redirect to security question page
    header("Location: Forgot_password.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_SESSION['verified_user'];
    $new_password = $_POST['new_password'];
    $confirm_new_password = $_POST['cnew_password'];

    // Validate that the new password and confirm password match
    if ($new_password !== $confirm_new_password) {
        $error = "The new password and confirm password do not match.";
    } else {
        // Hash the new password
        // $hashed_password = password_hash($new_password, PASSWORD_BCRYPT);

        // Update the password in the database
        $hashedPassword = password_hash($new_password, PASSWORD_DEFAULT);
        $stmt = $conn->prepare("UPDATE user SET password = ? WHERE email = ?");
        $stmt->bind_param("ss", $hashedPassword, $email);

        if ($stmt->execute()) {
            echo "<script>alert('Password reset successfully. Please log in with your new password.');</script>";
            echo "<meta http-equiv='refresh' content='2;URL=loginform.php'>";
            session_destroy(); // Clear session
            exit();
        } else {
            $error = "Failed to reset password. Please try again later.";
        }
    }
}
?>
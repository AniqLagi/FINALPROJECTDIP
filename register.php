<?php
include('connect.php');

$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$username = $_POST['username'];
$password = $_POST['password'];
$security1 = $_POST['secure1'];
$security2 = $_POST['secure2'];

// Generate userID
$userid = "userid" . uniqid();

// User type
$usertype = "user";

// Check if email or username already exists
$checkemail = "SELECT * FROM user WHERE email='$email' OR username='$username'";
$result = $conn->query($checkemail);

if ($result->num_rows > 0) {
    echo "<script>alert('Email Address or Username Already Exists');</script>";
    echo "<meta http-equiv=\"refresh\" content=\"2;URL=registerform.php\">";
} else {
    // Hash the password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Insert the user into the database
    $sql = "INSERT INTO user (userid, name, username, password, phone, email, usertype, SecurityAnswer1, SecurityAnswer2)
            VALUES ('$userid', '$name', '$username', '$hashedPassword', '$phone', '$email', '$usertype', '$security1', '$security2')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('User Registered Successfully!');</script>";
        echo "<meta http-equiv=\"refresh\" content=\"2;URL=loginform.php\">";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close the database connection
$conn->close();
?>

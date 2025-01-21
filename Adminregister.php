<?php
include('connect.php');

$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$username = $_POST['username'];
$password = $_POST['password']; 
$password2 = $_POST['repeat_password'];
$userid = $_POST['usertype'];
$secure1 = $_POST['secure1'];
$secure2 = $_POST['secure2'];
// usertype
$usertype = $_POST['usertype'];
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

//Check if the password and confirm password is true
if($password != $password2){
    echo "<script>alert('Password and Confirm Password do not match!');</script>";
    echo "<meta http-equiv=\"refresh\" content=\"2;URL=adminadduser.php\">";
    exit();
}

$checkemail = "SELECT * FROM user WHERE email='$email' OR username='$username'";
$result=$conn->query($checkemail);
if ($result->num_rows > 0) {
    echo "<script>alert('Username or email already exists!');</script>";
    echo "<meta http-equiv=\"refresh\" content=\"2;URL=adminadduser.php\">";
}
else {
$sql = "INSERT INTO user (userid, name, username, password, phone, email, usertype, SecurityAnswer1, SecurityAnswer2)
VALUES ('$userid','$name', '$username','$hashedPassword', '$phone', '$email', '$usertype', '$secure1', '$secure2')" or die("Error inserting data into table");

if($conn->query($sql) === TRUE) {
    echo "<script>alert('User added successfully!');</script>";
    echo "<meta http-equiv=\"refresh\" content=\"2;URL=adminadduser.php\">";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
}

//Closes specified connection
$conn->close();
?>

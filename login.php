<?php
session_start();

if (isset($_SESSION['username'])) {
    session_unset(); 
    session_destroy(); 
}

// Set new session variables after login
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $_SESSION['username'] = $_POST['username'];
    $_SESSION['password'] = $_POST['password']; 
}

include 'connect.php';

$sql = "SELECT * FROM user WHERE username='".$_SESSION['username']."'";
$result = $conn->query($sql);

if (!$result) {
    echo "Debug: Query Error = " . $conn->error . "<br>"; 
}

$row = mysqli_fetch_array($result);


if ($row) {
    // Check if the hashed password matches the one in the database
    if (password_verify($_SESSION['password'], $row['Password'])) {
        // Password is correct, set session variables
        $_SESSION['username'] = $row['Username'];
        $_SESSION['UserID'] = $row['UserID']; 
        $_SESSION['usertype'] = $row['usertype'];

        // Redirect based on user type
        if ($row['usertype'] == 'user') {
            header("Location: vehicleselect.php");
            exit();
        } elseif ($row['usertype'] == 'admin') {
            header("Location: admin.php");
            exit();
        }
    } else {
        // Password is incorrect
        echo "<script>alert('Wrong Password!');</script>";
        echo "<meta http-equiv=\"refresh\" content=\"3;URL=loginform.php\">";
    }
} else {
    // No user found
    echo "<script>alert('There is no account under the username: " . $_SESSION['username'] . "');</script>";
    echo "<meta http-equiv=\"refresh\" content=\"3;URL=loginform.php\">";
}
?>

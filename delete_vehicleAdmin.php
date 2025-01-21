<?php
session_start();
include 'connect.php';

// Validate session variables
if (!isset($_SESSION['username']) || !isset($_SESSION['password'])) {
    echo "Access denied. Please log in.";
    exit();
}

$username = $_SESSION['username'];
$password = $_SESSION['password'];

// Authenticate user
$sql = "SELECT * FROM user WHERE username=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows <= 0) {
    echo "Invalid username or password";
    exit();
}

// Get VehicleID from the query string
if (!isset($_REQUEST['vehicleID'])) {
    echo "No vehicle ID provided.";
    exit();
}
$deleteID = $_REQUEST['vehicleID'];

// Delete related records in the `user_vehicle` table
$sql_user_vehicle = "DELETE FROM user_vehicle WHERE VehicleID=?";
$stmt = $conn->prepare($sql_user_vehicle);
$stmt->bind_param("s", $deleteID);

if ($stmt->execute()) {
    // Then delete the record in the `vehicle` table
    $sql_vehicle = "DELETE FROM vehicle WHERE VehicleID=?";
    $stmt = $conn->prepare($sql_vehicle);
    $stmt->bind_param("s", $deleteID);

    if ($stmt->execute()) {
        echo "<p style='text-align:center'>Vehicle and associated user data have been deleted successfully!</p>";
        header("Location: adminvehiclelist.php");
        exit();
    } else {
        echo "<p style='text-align:center'>Error deleting vehicle: " . $stmt->error . "</p>";
    }
} else {
    echo "<p style='text-align:center'>Error deleting associated user data: " . $stmt->error . "</p>";
}

$stmt->close();
$conn->close();
?>

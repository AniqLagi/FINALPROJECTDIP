<?php
session_start();
include 'connect.php';

// Check if session variables are set
if (!isset($_SESSION['username']) || !isset($_SESSION['password'])) {
    header("Location: login.php");
    exit();
}

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $vehicleID = $_POST['VehicleID'];
    $make = $_POST['make'];
    $model = $_POST['model'];
    $licensePlate = $_POST['license_plate'];
    $password = $_POST['password'];
    $repeatPassword = $_POST['repeat_password'];

    // Validate if passwords match
    if ($password !== $repeatPassword) {
        $_SESSION['error'] = "Passwords do not match. Please try again.";
        header("Location: updatevehicle.php?vehicleID=$vehicleID");
        exit();
    }

    // Update vehicle details in the `vehicle` table
    $updateSql = "UPDATE vehicle SET Make='$make', Model='$model', License_Plate='$licensePlate' WHERE VehicleID='$vehicleID'";

    if ($conn->query($updateSql) === TRUE) {
        // If password is updated, update it in the user_vehicle table
        if (!empty($password)) {
            $updatePasswordSql = "UPDATE user_vehicle SET AccessPassword='$password' WHERE VehicleID='$vehicleID'";
            if ($conn->query($updatePasswordSql) === TRUE) {
                $_SESSION['success'] = "Vehicle and password updated successfully!";
                // Check user type and redirect accordingly
                if ($_SESSION['usertype'] == 'admin') {
                    header("Location: adminvehiclelist.php");
                } else {
                    header("Location: Dashboard2.php");
                }
            } else {
                $_SESSION['error'] = "Error updating password: " . $conn->error;
                // Check user type and redirect accordingly
                if ($_SESSION['usertype'] == 'admin') {
                    header("Location: adminvehiclelist.php");
                } else {
                    header("Location: Dashboard2.php");
                }
            }
        } else {
            $_SESSION['success'] = "Vehicle details updated successfully!";
            // Check user type and redirect accordingly
            if ($_SESSION['usertype'] == 'admin') {
                header("Location: adminvehiclelist.php");
            } else {
                header("Location: Dashboard2.php");
            }
        }
        exit();
    } else {
        $_SESSION['error'] = "Error updating vehicle: " . $conn->error;
        // Check user type and redirect accordingly
        if ($_SESSION['usertype'] == 'admin') {
            header("Location: adminvehiclelist.php");
        } else {
            header("Location: Dashboard2.php");
        }
        exit();
    }
}
?>

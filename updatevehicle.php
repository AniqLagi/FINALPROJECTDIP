<?php
session_start();
include 'connect.php';

// Check if session variables are set
if (!isset($_SESSION['username']) || !isset($_SESSION['password'])) {
    header("Location: login.php");
    exit();
}

// Fetch the VehicleID from the query parameter
$vehicleID = isset($_GET['vehicleID']) ? $_GET['vehicleID'] : null;

if ($vehicleID) {
    // Fetch the vehicle details from the database
    $stmt = $conn->prepare("SELECT * FROM vehicle WHERE VehicleID = ?");
    $stmt->bind_param("i", $vehicleID);
    $stmt->execute();
    $result = $stmt->get_result();
    $vehicle = $result->fetch_assoc();
} else {
    echo "No vehicle ID provided.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Edit Vehicle</title>
    <link rel="stylesheet" href="CSSOnly/registerform.css" />
</head>
<body>
<div class="form-container">
    <h2>Edit Vehicle</h2>
    
    <form method="POST" action="updatevehiclefinal.php">
        <input type="hidden" name="VehicleID" value="<?php echo htmlspecialchars($vehicle['VehicleID']); ?>">

        <label for="make">Make:</label>
        <input type="text" name="make" value="<?php echo htmlspecialchars($vehicle['Make']); ?>" required>
        
        <label for="model">Model:</label>
        <input type="text" name="model" value="<?php echo htmlspecialchars($vehicle['Model']); ?>" required>
        
        <label for="license_plate">License Plate:</label>
        <input type="text" name="license_plate" value="<?php echo htmlspecialchars($vehicle['License_Plate']); ?>" required>

        <label for="password">New Password:</label>
        <input type="password" name="password" id="password" required minlength="6" maxlength="20" placeholder="Enter a new password">

        <label for="password">Confirm Password:</label>
        <input type="password" name="repeat_password"  required minlength="6" maxlength="20" placeholder="Re-enter the password">

        <input type="submit" value="Update Vehicle">
        
        <?php
            if ($_SESSION['usertype'] == 'admin') {
                echo '<a href="adminvehiclelist.php" class="styled-button">Back to Dashboard</a>';
            } else {
                echo '<a href="Dashboard2.php" class="styled-button">Back to Dashboard</a>';
            }
        ?>
    </form>
</div>
</body>
</html>

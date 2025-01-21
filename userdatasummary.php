<?php
session_start();

include 'connect.php';

// Check if session variables are set
if (!isset($_SESSION['username']) || !isset($_SESSION['password'])) {
    header("Location: login.php");
    exit();
}

$usernameee = $_SESSION['username'];
$passworddd = $_SESSION['password'];

// Fetch user data from the database
$UserID = $_SESSION['UserID']; // Assuming userID is stored in the session
$query = "SELECT * FROM user WHERE UserID = '$UserID'"; // Adjust the query based on your table structure
$result = mysqli_query($conn, $query);

if ($result) {
    $userData = mysqli_fetch_assoc($result);
} else {
    echo "Error fetching user data: " . mysqli_error($conn);
}

// Fetch Vehicle data from the database
$VehicleID = $_SESSION['VehicleID']; // Assuming userID is stored in the session
$query2 = "SELECT * FROM vehicle WHERE VehicleID = '$VehicleID'"; // Adjust the query based on your table structure
$result2 = mysqli_query($conn, $query2);

if ($result2) {
    $vehicleData = mysqli_fetch_assoc($result2);
} else {
    echo "Error fetching Vehicle data: " . mysqli_error($conn);
}

// Correct $query3 execution
$query3 = "SELECT AccessPassword,AccessRole FROM user_vehicle WHERE UserID = '$UserID' AND VehicleID = '$VehicleID'"; // Correct the typo in $VehicleID
$result3 = mysqli_query($conn, $query3); // Correctly execute $query3

if ($result3) {
    $uservehicleData = mysqli_fetch_assoc($result3);
} else {
    echo "Error fetching user vehicle data: " . mysqli_error($conn);
}

// Query to retrieve total cost of refueling
$totalCostQuery = "SELECT SUM(Refulieng_Cost) AS totalCost FROM refueling WHERE VehicleID = ?";
$stmt = $conn->prepare($totalCostQuery);
$stmt->bind_param("i", $_SESSION['VehicleID']);
$stmt->execute();
$totalCostResult = $stmt->get_result();
$totalCostRow = $totalCostResult->fetch_assoc();
$totalCost = $totalCostRow['totalCost'] ? $totalCostRow['totalCost'] : 0; // Default to 0 if NULL

// Query to retrieve total cost of maintenance
$totalCostQuery2 = "SELECT SUM(Cost) AS totalCost FROM Expenses WHERE VehicleID = ?";
$stmt2 = $conn->prepare($totalCostQuery2);
$stmt2->bind_param("i", $_SESSION['VehicleID']);
$stmt2->execute();
$totalCostResult2 = $stmt2->get_result();
if ($totalCostResult2) {
    $totalCostRow2 = $totalCostResult2->fetch_assoc();
    $totalCost2 = isset($totalCostRow2['totalCost']) ? $totalCostRow2['totalCost'] : 0; // Default to 0 if NULL
} else {
    // Handle query error
    echo "Error: " . $conn->error;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Dashboard Admin</title>
    <link rel="stylesheet" href="CSSOnly/UserdataSummary2.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <!-- HEADER -->
    <div class="main--content">
        <div class="header--wrapper">
            <div class="header--title">
                <h2>
                    <?php
                    if ($_SESSION['usertype'] == 'admin') {
                        echo '<a href="adminvehiclelist.php" class="styled-button">Back to Dashboard</a>';
                    } else {
                        echo '<a href="Dashboard2.php" class="styled-button">Back to Dashboard</a>';
                    }
                    ?>
                </h2>
            </div>
            <div class="user--info"></div>
        </div>

        <!-- CARD CONTAINER -->
        <div class="form-container">
            <div class="card--container">
                <div class="card--wrapper">
                    <!-- User Information Section -->
                    <div class="user-info-wrapper">
                        <h1>User Information</h1>
                        <div class="profile-section">
                            <div class="info-box">
                                <p><strong>Name:</strong> <?php echo htmlspecialchars($userData['Name']); ?></p>
                            </div>
                            <div class="info-box">
                                <p><strong>Username:</strong> <?php echo htmlspecialchars($userData['Username']); ?></p>
                            </div>
                            <div class="info-box">
                                <p><strong>User Type:</strong> <?php echo htmlspecialchars($userData['usertype']); ?></p>
                            </div>
                            <div class="info-box">
                                <p><strong>Email:</strong> <?php echo htmlspecialchars($userData['Email']); ?></p>
                            </div>
                            <div class="info-box">
                                <p><strong>Phone Number:</strong> <?php echo htmlspecialchars($userData['Phone']); ?></p>
                            </div>
                        </div>
                    </div>

                    <!-- Vehicle Information Section -->
                    <div class="vehicle-info-wrapper">
                        <h1>Vehicle Information</h1>
                        <div class="profile-section">
                            <div class="info-box">
                                <p><strong>Vehicle Brand:</strong> <?php echo htmlspecialchars($vehicleData['Make']); ?></p>
                            </div>
                            <div class="info-box">
                                <p><strong>Vehicle Model:</strong> <?php echo htmlspecialchars($vehicleData['Model']); ?></p>
                            </div>
                            <div class="info-box">
                                <p><strong>License Plate:</strong> <?php echo htmlspecialchars($vehicleData['License_Plate']); ?></p>
                            </div>
                            <div class="info-box">
                                <p><strong>Role:</strong> <?php echo htmlspecialchars($uservehicleData['AccessRole']); ?></p>
                            </div>
                            <div class="info-box">
                                <p><strong>Vehicle Password:</strong> <?php echo htmlspecialchars($uservehicleData['AccessPassword']); ?></p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Spending Summary Section (Placed below) -->
                <div class="spending-summary">
                    <h1>Spending Summary</h1>
                    <div class="profile-section">
                        <div class="info-box">
                            <p><strong>Total Refueling:</strong> RM <?php echo number_format($totalCost, 2); ?></p>
                        </div>
                        <div class="info-box">
                            <p><strong>Total Expenses:</strong> RM <?php echo number_format($totalCost2, 2); ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</body>
</html>

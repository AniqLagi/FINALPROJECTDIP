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

// Define $vehicleID (assuming it's stored in the session or needs to be fetched)
$vehicleID = isset($_SESSION['vehicleID']) ? $_SESSION['vehicleID'] : null; // Adjust this line as necessary

// Get the total count of all users
$stmt = $conn->prepare("SELECT COUNT(*) AS total FROM user WHERE usertype = 'user'");
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$totalCost = $row['total'];


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Dashboard Admin</title>
    <link rel="stylesheet" href="CSSOnly/adminpage2.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function confirmDelete(userID) {
    // Send an AJAX request to check if the user has related data
    fetch(`check_user_data.php?userID=${userID}`)
        .then(response => response.json())
        .then(data => {
            if (data.hasRelatedData) {
                Swal.fire({
                    title: "Cannot delete user",
                    text: "This user has related data in other tables. Please remove their data before deleting the user.",
                    icon: "warning",
                    confirmButtonText: "Okay"
                });
            } else {
                // If no related data, proceed with the delete confirmation
                Swal.fire({
                    title: "Are you sure?",
                    text: "You won't be able to revert this!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, delete it!"
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Redirect to the delete page with the ID as a query parameter
                        window.location.href = 'delete_userAdmin.php?deleteID=' + userID;
                    }
                });
            }
        })
        .catch(error => {
            console.error('Error:', error);
            Swal.fire({
                title: "Error",
                text: "Something went wrong. Please try again later.",
                icon: "error",
                confirmButtonText: "Okay"
            });
        });
}

    </script>
</head>
<body>
    <div class="sidebar">
        <div class="logo"></div>
        <ul class="menu">
            <li class="active">
                <a href="admin.php">
                    <i class="fas fa-home"></i>
                    <span>List of User</span>
                </a>
            </li>

            <li>
                <a href="adminvehiclelist.php">
                    <i class="fas fa-car"></i>
                    <span>List of Vehicle</span>
                </a>
            </li>

            <li>
                <a href="adminfuelInfo.php">
                    <i class="fas fa-gas-pump"></i>
                    <span>Refueling Data</span>
                </a>
            </li>

            <li>
                <a href="adminmaintenanceInfo.php">
                    <i class="fas fa-wrench"></i>
                    <span>Maintenance Data</span>
                </a>
            </li>

            <li>
                <a href="adminadduser.php">
                    <i class="fas fa-user"></i>
                    <span>Add New User</span>
                </a>
            </li>

            <li>
                <a href="adminaddexpense.php">
                    <i class="fas fa-money-bill-alt"></i>
                    <span>New Expenses</span>
                </a>
            </li>

            <li>
                <a href="adminChart.php">
                    <i class="fas fa-chart-line"></i>
                    <span>Chart</span>
                </a>
            </li>

            <li class="logout">
                <a href="logout.php">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Logout</span>
                </a>
            </li>
        </ul>
    </div>

    <!-- HEADER -->
    <div class="main--content">
        <div class="header--wrapper">
            <div class="header--title">
                <span>Primary</span>
                <h2>Dashboard / <?php echo htmlspecialchars($usernameee); ?></h2>
            </div>
            <div class="user--info"></div>
            <img src="assets/dProfileImage.jpg" alt="#">
        </div>

        <!-- CARD CONTAINER -->
        <div class="card--container">
            <h2 class="main--title">Account Summary</h2>
            <div class="card--wrapper">

            <div class="payment--card">
                <div class="card--header">
                    <div class="amount">
                        <span class="title">Total of Registered User</span>
                        <span class="amount-value"><?php echo "" . number_format($totalCost); ?></span>
                    </div>
                    <i class="fas fa-user icon"></i>
                </div>
                <span class="card-detail"></span>
            </div>

                <div class="payment--card">
                    <div class="card--header">
                        <div class="amount">
                            <span class="title">
                                <form method="POST" action="">
                                    <input type="text" name="search_user" placeholder="Search users here..." style="width: 150px; padding: 15px;">
                                    <input type="submit" value="Search" class="styled-button">
                                </form>
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            
        </div>

        <!-- User List -->
        <div class="tabular--wrapper">
            <h3 class="main--title2">List of User</h3>
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>UserID</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $searchTerm = isset($_POST['search_user']) ? $_POST['search_user'] : '';
                        if (empty($searchTerm)) {
                            $stmt = $conn->prepare("SELECT * FROM user WHERE usertype = 'user'");
                        } else {
                            $stmt = $conn->prepare("SELECT * FROM user WHERE (Name LIKE ? OR Username LIKE ? OR Email LIKE ?) AND usertype = 'user'");
                            $searchWildcard = "%$searchTerm%";
                            $stmt->bind_param("sss", $searchWildcard, $searchWildcard, $searchWildcard);
                        }
                        $stmt->execute();
                        $userResult = $stmt->get_result();

                        if ($userResult && $userResult->num_rows > 0) {
                            while ($row = $userResult->fetch_assoc()) {
                                echo "<tr>
                                        <td>{$row['Name']}</td>
                                        <td>{$row['UserID']}</td>
                                        <td>{$row['Username']}</td>
                                        <td>{$row['Email']}</td>
                                        <td>+60{$row['Phone']}</td>
                                        <td>
                                            <a href='updateuserAdmin.php?updateID=" . $row['UserID'] . "' class='styled-button'>Edit</a>
                                            <button type='button' class='styled-button' onclick='confirmDelete(" . $row['UserID'] . ")'>Delete</button>
                                        </td>
                                    </tr>";
                            }
                        } else {
                            echo "<tr><td colspan='5'>No users found.</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Admin List -->
        <div class="tabular--wrapper">
            <h3 class="main--title2">List of Admin</h3>
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>UserID</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $searchTerm = isset($_POST['search_admin']) ? $_POST['search_admin'] : '';
                        if (empty($searchTerm)) {
                            $stmt = $conn->prepare("SELECT * FROM user WHERE usertype = 'admin'");
                        } else {
                            $stmt = $conn->prepare("SELECT * FROM user WHERE (Name LIKE ? OR Username LIKE ? OR Email LIKE ?) AND usertype = 'admin'");
                            $searchWildcard = "%$searchTerm%";
                            $stmt->bind_param("sss", $searchWildcard, $searchWildcard, $searchWildcard);
                        }
                        $stmt->execute();
                        $adminResult = $stmt->get_result();

                        if ($adminResult && $adminResult->num_rows > 0) {
                            while ($row = $adminResult->fetch_assoc()) {
                                $isCurrentUser = ($row['Username'] === $_SESSION['username']);
                                echo "<tr>
                                        <td>{$row['Name']}</td>
                                        <td>{$row['UserID']}</td>
                                        <td>{$row['Username']}</td>
                                        <td>{$row['Email']}</td>
                                        <td>+60{$row['Phone']}</td>
                                        <td>";
                                if ($isCurrentUser) {
                                    echo "<a href='updateuserAdmin.php?updateID=" . $row['UserID'] . "' class='styled-button'>Edit</a>
                                          <button class='styled-button' onclick='confirmDelete(" . json_encode($row['UserID']) . ")'>Delete</button>";
                                } else {
                                    echo "<span style='color: grey;'>No actions available</span>";
                                }
                                echo "</td>
                                    </tr>";
                            }
                        } else {
                            echo "<tr><td colspan='6'>No admins found.</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>

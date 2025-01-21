<?php
include 'connect.php';

// Get the user ID from the URL query parameter
$userID = isset($_GET['userID']) ? $_GET['userID'] : '';

if ($userID) {
    // Prepare queries to check for related data in other tables (e.g., expenses, vehicles, refueling, etc.)
    $queries = [
        "SELECT COUNT(*) AS count FROM expenses WHERE UserID = ?",
        "SELECT COUNT(*) AS count FROM user_vehicle WHERE UserID = ?",
        "SELECT COUNT(*) AS count FROM refueling WHERE UserID = ?"
    ];

    // Check each table for related data
    $hasRelatedData = false;
    foreach ($queries as $query) {
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $userID);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        
        if ($row['count'] > 0) {
            $hasRelatedData = true;
            break; // If any related data is found, stop checking further
        }
    }

    // Return a JSON response indicating whether related data was found
    echo json_encode(['hasRelatedData' => $hasRelatedData]);
} else {
    // If no user ID is provided, return an error
    echo json_encode(['error' => 'User ID not provided']);
}
?>

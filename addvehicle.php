<?php
// Initialise the session
session_start();
include 'connect.php';

// Check for error message
if (isset($_SESSION['error'])) {
    echo "<script>alert('" . $_SESSION['error'] . "');</script>";
    unset($_SESSION['error']); // Clear the error message after displaying it
}

$usernameee = $_SESSION['username'];
$passworddd = $_SESSION['password'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Car Registration Form</title>
  <link rel="stylesheet" href="CSSOnly/registerform.css">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <div class="form-container">
      <h1>Register New Vehicle</h1>
      <form id="form1" name="form1" method="post" action="vehicleregister.php">
        <label for="make">Make:</label>
        <input type="text" name="make" id="make" required minlength="3" maxlength="50" placeholder="Enter the car brand">
    
        <label for="model">Model:</label>
        <input type="text" name="model" id="model" required placeholder="Enter the car model">
    
        <label for="plate">License Plate:</label>
        <input type="text" name="plate" id="plate" required placeholder="Enter the car license plate">
        <script>
            const plateInput = document.getElementById('plate');

            plateInput.addEventListener('input', () => {
            plateInput.value = plateInput.value.replace(/\s/g, ''); 
              });
      </script>

        <label for="password">Password:</label>
        <input type="password" name="password" id="password" required minlength="6" maxlength="20" placeholder="Create a password">

        <label for="password">Confirm Password:</label>
        <input type="password" name="repeat_password"  required minlength="6" maxlength="20" placeholder="Re-enter your password">
    
        <div style="display: flex; justify-content: space-between;">
            <input type="submit" name="submit" id="submit" value="REGISTER">
            <input type="reset" name="reset" id="reset" value="CLEAR FORM">
        </div>
        <div>
        <a href="vehicleselect.php" class="styled-button">Back</a>
        </div>
      </form>
    </div>

    <script>
    function goBack() {
        window.history.back();
    }
    </script>

<?php
    if (isset($_GET['error'])) {
        echo "<script>
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Passwords do not match. Please try again.',
            confirmButtonText: 'OK'
        });
        </script>";
    }
    ?>



</body>
</html>

<?php

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Registration Form</title>
<link rel="stylesheet" href="CSSOnly/registerform.css">
</head>
<body>
<a href="loginform.php" class="styled-button" value="LOGIN">Return to Login</a>
<div class="form-container">
  <h1>Reset Your Password</h1>
  <form id="form1" name="form1" method="post" action="Forgot_passwordFinal.php">

    <label for="email">Email:</label>
    <input type="email" name="email" id="email" required placeholder="Enter your email address">

    <label for="security1">What is your favourite pet?</label>
    <input type="text" name="secure1" id="secure1" required minlength="3" maxlength="20" placeholder="Favourite pet">

    <label for="security2">What is the name of your primary school?</label>
    <input type="text" name="secure2" id="secure2" required minlength="3" maxlength="20" placeholder="Primary School">
    <div style="display: flex; justify-content: space-between;">
      <input type="submit" name="submit" id="submit" value="VERIFY">
      <input type="reset" name="reset" id="reset" value="CLEAR FORM">
    </div>
  </form>
</div>
</body>
</html>

<?php
?>

<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Reset Password</title>
        <link rel="stylesheet" href="CSSOnly/registerform.css">
    </head>
    <body>
        <a href="loginform.php" class="styled-button">Return to Login</a>
        <div class="form-container">
        <h1>Reset Password</h1>
        <?php if (isset($error)): ?>
            <div class="error-message"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>
        <form method="post" action="reset_passwordFinal.php">
            <label for="new_password">New Password:</label>
            <input type="password" name="new_password" id="new_password" required minlength="6" placeholder="Create a new password">

            <label for="new_password">Confirm New Password:</label>
            <input type="password" name="cnew_password" id="new_password" required minlength="6" placeholder="Cofirm the new password">

            <center><input type="submit"></input></center>
        </form>
    </div>
    </body>
</html>

<?php
session_start();
if (!isset($_SESSION['verified'])) {
    header("Location: forgot_password.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password - FJA Basketball Court</title>
    <link rel="stylesheet" href="login.css">
</head>
<body>
    <img src="fjabasketball.png" id="logo">
    <form method="POST" action="update_password.php">
        <div class="sec" style="text-align:center; width:30%; margin-top:0px; height:70px;">
            <h2>Reset Password</h2>
        </div>

        <div class="sec" style="text-align:center; width:30%; min-height:100px;">
            <div style="display: inline-block; text-align: left;"><br>
                <label for="new_pass" style="display: inline-block; width: 200px; text-align: left;">New Password:</label>
                <input type="password" id="new_pass" name="new_pass" style="width: 250px; display: inline-block;" required><br><br>
                <label for="confirm_pass" style="display: inline-block; width: 200px; text-align: left;">Confirm Password:</label>
                <input type="password" id="confirm_pass" name="confirm_pass" style="width: 250px; display: inline-block;" required><br><br>
                <input type="submit" value="Submit" class="button" style="display:block; margin-right:auto; margin-left:auto;">
            </div>
        </div><br>
    </form>
</body>
</html>

<?php
session_start();
if (!isset($_SESSION['security_question'])) {
    header("Location: forgot_password.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Security Question - FJA Basketball Court</title>
    <link rel="stylesheet" href="login.css">
</head>
<body>
    <img src="fjabasketball.png" id="logo">
    <form method="POST" action="verify_security_answer.php">
        <div class="sec" style="text-align:center; width:30%; margin-top:0px; height:70px;">
            <h2>Answer Security Question</h2>
        </div>

        <div class="sec" style="text-align:center; width:30%; min-height:100px;">
            <div style="display: inline-block; text-align: left;"><br>
                <label for="seca" style="display: inline-block; width: 200px; text-align: left;"><?php echo htmlspecialchars($_SESSION['security_question']); ?>:</label>
                <input type="text" id="seca" name="seca" style="width: 250px; display: inline-block;" required><br><br>
                <input type="submit" value="Submit" class="button" style="display:block; margin-right:auto; margin-left:auto;">
            </div>
        </div><br>
    </form>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password - FJA Basketball Court</title>
    <link rel="stylesheet" href="login.css">
</head>
<body>
    <img src="fjabasketball.png" id="logo">
    <form method="POST" action="forgot_password.php">
        <div class="sec" style="text-align:center; width:30%; margin-top:0px; height:70px;">
            <h2>Forgot Password</h2>
        </div>

        <div class="sec" style="text-align:center; width:30%; min-height:100px;">
            <div style="display: inline-block; text-align: left;"><br>
                <label for="email" style="display: inline-block; width: 120px; text-align: left;">Email:</label>
                <input type="email" id="email" name="email" style="width: 250px; display: inline-block;" required><br><br>
                <input type="submit" value="Submit" class="button" style="display:block; margin-right:auto; margin-left:auto;">
            </div>
        </div><br>
        <a href = "login.php" style="margin-left:1230px;">Go Back To Login</a>
    </form>
</body>
</html>

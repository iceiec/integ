<?php
echo "<script>alert('You are not yet logged in! Please log in.'); window.location.href = 'login.php'; </script>";
?>

<?php
session_start()
?>

<html>
<title>FJA Basketball Court</title>
<link rel="stylesheet" type="text/css" href="login.css">

<body>
    <form method="POST" action="verify.php">
        <div class="section" style="text-align:center; width:30%; margin-top:330px; height:70px;">
            <h2>FJA Basketball Court Log In</h2>
        </div>

        <div class="section" style="text-align:center; width:30%; min-height:100px;">
        <div style="display: inline-block; text-align: left;"><br>
        <label for="email" style="display: inline-block; width: 80px; text-align: left;">Email:</label>
        <input type="email" id="email" name="email" style="width: 250px; display: inline-block;" required><br><br>
        <label for="pass" style="display: inline-block; width: 80px; text-align: left;">Password:</label>
        <input type="password" id="pass" name="pass" style="width: 250px; display: inline-block;" required>
    </div>
    </div><br>

        <input type="submit" value="Log In" id="submit" style="display:block; margin-right:auto; margin-left:auto;">
        <p style="text-align:center;">Don't have an account? <a href="register.php">Click here</p>
        <br><p style="text-align:center;">
        <a href ="front.php" style="font-size:15px; text-align:center; margin-left:530px; margin-bottom:-5px;">Go to Home Page </a></p>

    </form>
</body>
</html>
<!DOCTYPE html>
<html>
<head>
    <title>FJA Basketball Registration</title>
    <link rel="stylesheet" type="text/css" href="login.css">
</head>
<body>
    <form method="POST" action="registration.php">
        
        <br><br><br><br><br><br><br><br><br><br><br><br>
        <div class="header" style="text-align:center"><h1>Registration</h1></div>

        <div class="section" style="display:block; margin-right: auto; margin-left: auto; text-align:center; width:35%; background-color: rgba(255, 255, 255, 0.8); box-shadow: 0px 3px 10px black; border-radius
        :10px;"><br>

            <label for="fname" style="margin-right:215px;">First Name:</label><br>
            <input type="text" id="fname" name="fname" style="width:300px; text-align:left;" pattern="[A-Za-z ]+" title="Only letters and spaces are allowed" required><br>

            <label for="mname" style="margin-right:200px;">Middle Name:</label><br>
            <input type="text" id="mname" name="mname" style="width:300px; text-align:left;" pattern="[A-Za-z ]+" title="Only letters and spaces are allowed" required><br>

            <label for="lname" style="margin-right:215px;">Last Name:</label><br>
            <input type="text" id="lname" name="lname" style="width:300px; text-align:left;" pattern="[A-Za-z]+" title="Only letters and spaces are allowed" required><br>

            <label for="cont" style="margin-right:175px;">Contact Number:</label><br>
            <input type="text" id="cont" name="cont" style="width:268px; text-align:left;" pattern="[0-9]+" minlength="11" title="Only numbers are allowed" required><br>

            <label for="email" style="margin-right:250px;">Email:</label><br>
            <input type="email" id="email" name="email" style="width:300px; text-align:left;" required><br>

            <label for="pass" style="margin-right:220px;">Password:</label><br>
            <input type="password" id="pass" name="pass" style="width:300px; text-align:left;" minlength="8"  required><br><br>
            <!--pattern="^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])(?=.*_)(?!.* ).{8,16}$">

             New Security Question and Answer fields -->
            <label for="secq" style="margin-right:120px;">Security Question:</label><br>
            <select id="secq" name="secq" style="width:300px; text-align:left;" required>
                <option value="">Select a question</option>
                <option value="What is your mother's maiden name?">What is your mother's maiden name?</option>
                <option value="What was the name of your first pet?">What was the name of your first pet?</option>
                <option value="What was the make of your first car?">What was the make of your first car?</option>
                <option value="In what city were you born?">In what city were you born?</option>
            </select><br>

            <label for="seca" style="margin-right:175px;">Answer:</label><br>
            <input type="text" id="seca" name="seca" style="width:300px; text-align:left;" required><br><br>

            <input type="submit" value="Register" id="register"><br><br><br>
        </div><br>
    </form>
    <p style="text-align:center;">
        <a href="login.php" style="font-size:15px; text-align:center; margin-left:640px; margin-bottom:-5px;">Go back to login</a>
    </p>
</body>
</html>

<?php
session_start();
require "con.php"; // Assuming you have a separate file for database connection

if (!isset($_SESSION['user_level']) || $_SESSION['user_level'] != 2) {
    echo "<script type='text/javascript'>
            alert('You don\\'t have access here!');
            window.location.href = 'logout.php';
          </script>";
    exit();
}

if (isset($_SESSION['email'])) {
    $email = $_SESSION['email'];

    $sql = "SELECT client_firstn, client_lastn, client_contnum, pfp FROM client WHERE client_email = :email";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':email', $email);
    $stmt->execute();

    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($row) {
        $profilePicture = $row['pfp'];
        $client_firstn = $row['client_firstn'];
        $client_lastn = $row['client_lastn'];
        $cp = $row['client_contnum'];
    } else {
        // Handle the case when no user is found
        echo "User not found.";
        exit();
    }
} else {
    // Handle the case when the user is not logged in
    echo "You need to be logged in to access this page.";
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Profile</title>
    <link rel="stylesheet" type="text/css" href="page.css">
    <style>
        #preview {
            width: 250px;
            height: 250px;
            border-radius:50%;
            display: none;
            border: none;
            margin-top: 10px;
            display:block;
            margin-right:auto;
            margin-left:auto;
        } 
        /* Define animation keyframes */
        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }

        /* Apply animation to the sections */
        .sec {
            animation: fadeIn 1s ease-in-out;
        }
    </style>
    
</head>
<body>
<div id="header" style="height:155px;">
    <img src="fjabasketball.png" id="logo">
    <ul>
            <li><a href="admin.php">Home</a></li>
            <li><a href="weekly.php"><b>Frequently Booked Client</b></a></li>
            <li><a href="court-utilization-report.php"><b>Court Utilization</b></a></li>
            <li><a href="monthly-revenue-report.php"><b>Monthly Revenue</b></a></li>
            <li><a href="audit.php"><b>Audit Trail</b></a></li>
            <li><a href="locked.php"><b>Locked Clients</b></a></li>
            <li><a href= "profad.php"><b>Profile</b></a></li>
        </ul>
    <br>
    <div class="profile-header">
        <?php
        
        if (isset($_SESSION['email'])) {
            if (!empty($profilePicture)) {
                echo "<img src='$profilePicture' alt='Profile Picture' class='pfp'><br>";
            }
        }
        ?>
        <div class="user-info">
            <h2 class="username">Welcome, <?php echo $client_firstn . ' ' . $client_lastn; ?>!</h2>
            <a href="logout.php" class="logout-link"><b>Log out</b></a>
        </div>
    </div>
</div>
<div class="sec" style="margin-top:100px; width:1000px; height:500px; border-radius: 20px;">
    <form method="POST" action="up_ad.php" enctype="multipart/form-data">
        <div class="section" style="text-align:center;">
        <img id="preview" src="<?php echo !empty($profilePicture) ? $profilePicture : '#'; ?>" alt="Image Preview"><br>
            <label for="firstname">First Name:</label><br>
            <input type="text" id="firstname" name="firstname" value="<?php echo $client_firstn; ?>" style="text-align:center;" required><br>
            <label for="lastname">Last Name:</label><br>
            <input type="text" id="lastname" name="lastname" value="<?php echo $client_lastn; ?>" style="text-align:center;" required><br>
            <label for="profilepic">Update Profile Picture:</label><br>
            <input type="file" id="profilepic" name="profilepic" accept="image/*" onchange="previewImage(event)"><br><br>
            <input type="submit" value="Update Profile" class="button">
        </div>
    </form>
</div>
<script>
    function previewImage(event) {
        var preview = document.getElementById('preview');
        preview.src = URL.createObjectURL(event.target.files[0]);
        preview.style.display = 'block';
        preview.onload = function() {
            URL.revokeObjectURL(preview.src) // free memory
        }
    }
</script>
</body>
</html>

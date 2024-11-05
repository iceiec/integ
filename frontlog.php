<?php
session_start();

if (!isset($_SESSION['user_level']) || $_SESSION['user_level'] != 1) {
    echo "<script type='text/javascript'>
            alert('You don\\'t have access here!');
            window.location.href = 'logout.php';
          </script>";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FJA Basketball Court</title>
    <link rel="stylesheet" href="page.css">
</head>
<body>
  <div id="header" style="height:155px;">
        <img src="fjabasketball.png" id="logo">
        <ul>
            <li><a href="frontlog.php">Home</a></li>
            <li><a href="howto.php">How To Book</a></li>
            <li><a href="book.php"><b>Book A Schedule</b></a></li>
            <li><a href="profile.php"><b>Profile</b></a></li>
            <li><a href="trans.php"><b>Transactions</b></a></li>
        </ul>
        <br>
        
        <div class="profile-header">
            <?php
            if (isset($_SESSION['email'])) {
                require "client.php";
                $email = $_SESSION['email'];
                $sql = "SELECT * FROM client WHERE client_email = :email";
                $stmt = $conn1->prepare($sql);
                $stmt->bindParam(':email', $email);
                $stmt->execute();
                $info = $stmt->fetch(PDO::FETCH_ASSOC);
                
                if ($info) {
                    $profilePicture = $info['pfp'];
                    $firstName = $info['client_firstn'];
                    $lastName = $info['client_lastn'];
                    if (!empty($profilePicture)) {
                        echo "<img src='$profilePicture' alt='Profile Picture' class='pfp'>";
                    }
                }
            }
            ?>
            <div class="user-info">
                <h2 class="username">Welcome, <?php echo $firstName . ' ' . $lastName; ?>!</h2>
                <a href="logout.php" class="logout-link"><b>Log out</b></a>
            </div>
        </div>
    </div>
    
    <div class="heading">
        <h1 class="slide-up">Welcome to FJA Basketball Court!</h1>
        <h5>Where you can showcase your talent as a player, or as a team! Need a court? We got you!</h5>
        <a href="book.php" class="button">Book a Schedule</a>
    </div>
    <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>

    <div class="sec">
        <div style="text-align: center;">
            <table style="margin: 0 auto;">
                <tr>
                    <td>
                        <div class="desc" style="padding: 20px;">
                            <h1 style="margin-bottom: 10px; text-align:center;">Juliet Court</h1>
                            <img src="juliet.jpg" id="juliet" style="width: 100%; height: auto;">
                        </div>
                    </td>
                    <td style="padding-left: 20px;">
                        <div class="desc" style="padding: 20px;">
                            <h1 style="margin-bottom: 10px; text-align:center;">Andoy Court</h1>
                            <img src="andoy.jpg" id="andoy" style="width: 100%; height: auto;">
                        </div>
                    </td>
                </tr>
            </table>
        </div>

        <br><br><br><br><br><br>

        <div style="text-align: center;">
            <table style="margin: 0 auto;">
                <tr>
                    <td>
                        <div class="desc" style="padding: 20px;">
                            <h1 style="text-align:center;">About Us</h1>
                            <p>
                                FJA Basketball Court was made in the year 2022. The court is located inside the compound of FJA. Besides having a court, FJA also offers a Pavilion and a swimming pool.
                                If you want to book a schedule at the pavilion or the swimming pool, <a href="https://web.facebook.com/profile.php?id=100034819287094" target="_blank">click here!</a><br><br>
                                FJA Basketball Court has two courts: <b><i>Juliet</i></b> and <b><i>Andoy</i></b>. The court was named after our grandmother (Juliet) and grandfather (Andoy).
                            </p>
                        </div>
                    </td>
                    <td>
                        <div class="desc" style="padding: 20px;">
                            <h1 style="text-align:center;">Location</h1>
                            <p style="margin-top:20px;">
                                We are located at <a href="https://maps.app.goo.gl/6XTd2JFBPar1bGXk9" target="_blank">0893 J.P. Rizal St., Sta. Barbara, Baliwag Bulacan</a>. We are in front of the Iglesia Ni Cristo - Lokal ng Sta. Barbara.
                            </p>
                        </div>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</body>
</html>

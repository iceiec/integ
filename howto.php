<?php
session_start();

if (!isset($_SESSION['user_level']) || $_SESSION['user_level'] != 1) {
    echo "<script type='text/javascript'>
            alert('You don\\'t have access here!');
            window.location.href = 'login.php';
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
<style>
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
	

    <div class="sec" style="margin-top:100px; width:80%; border-radius:50px;">
	<h1 style="font-size: 30px; text-align:center;">How To Book A Schedule?</h1>
	<p style="text-align:center;">Booking a schedule to our court is not a problem! We have a standard process of reserving a schedule to our court. We require a downpayment of <b style="color:black;">300 pesos</b>
	and we strictly use <b style="color:black;">GCash</b> as a mode of payment. And after paying the downpayment, we will include the reference number for your assurance that the booking was made.
			</p>
	</div>

	<div class="sec" style="width:85%; border-radius:50px;">
	<h1 style="font-size: 50px; text-align:center;">Rules</h1>
	<p style="text-align:center;">
	*Strictly no <b>cancelling</b> of schedule<br>
	<b>*Downpayment first to reserve the court schedule</b><br>
	*Come on time, and don't exceed on the time limit<br>
	*Have a proper basketball attire<br>
	*No liquors or alcoholic beverages, cigarettes, etc. inside the court<br>
	*Throw your trash properly<br>
	*<b>What if we had an emergency on that time and I want to refund my downpayment?</b><br>
	*Strictly no <b>REFUND</b> of downpayment<br>
	*Unless it <b>rains</b>, then we will refund the downpayment.
	</p>
	</div>
</div>
</body>
</html>

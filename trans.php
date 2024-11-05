<?php
session_start();
require "client.php"; // Ensure this file correctly establishes the database connection

if (!isset($_SESSION['user_level']) || $_SESSION['user_level'] != 1) {
    echo "<script type='text/javascript'>
            alert('You don\\'t have access here!');
            window.location.href = 'logout.php';
          </script>";
    exit();
}

// Get the client_id from the user's session
$client_id = $_SESSION['client_id'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="page.css"> <!-- Ensure this path is correct -->
    <title>Transaction Table</title>
    <style>
        .schedule-table {
            display: flex;
            justify-content: center;
        }
        table {
            border-collapse: collapse;
            width: 80%; /* Adjust width as needed */
            margin: 0 auto; /* Center the table horizontally */
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
            text-align: left;
        }
        .sec {
            text-align: center;
        }
    </style>
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
    </div><br><br>
    <div class="sec" style="width:1800px; border-radius:50px;">
        <h2>Transactions you've made</h2>
        <div class="schedule-table">
            <table>
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Reference Number</th>
                        <th>Downpayment</th>
                        <th>Payment Method</th>
                        <th>Court Name</th>
                        <th>Total Amount</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    try {
                        // Join the transactions and sched tables to filter based on client_id
                        $stmt = $conn1->prepare("SELECT t.timestamp, t.reference_number, t.amount, t.payment_method, s.court_name, s.total_amount
                                                FROM transactions t
                                                JOIN sched s ON t.sched_id = s.sched_id
                                                WHERE s.client_id = :client_id");
                        $stmt->bindParam(':client_id', $client_id, PDO::PARAM_INT);
                        $stmt->execute();
                        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

                        if (count($result) > 0) {
                            foreach ($result as $row) {
                                echo "<tr>
                                        <td>" . htmlspecialchars(date('Y-m-d H:i:s', strtotime($row["timestamp"]))) . "</td>
                                        <td>" . htmlspecialchars($row["reference_number"]) . "</td>
                                        <td>" . htmlspecialchars($row["amount"]) . "</td>
                                        <td>" . htmlspecialchars($row["payment_method"]) . "</td>
                                        <td>" . htmlspecialchars($row["court_name"]) . "</td>
                                        <td>" . htmlspecialchars($row["total_amount"]) . "</td>
                                      </tr>";
                            }
                        } else {
                            echo "<tr><td colspan='6'>No transactions found</td></tr>";
                        }
                    } catch (PDOException $e) {
                        echo "<tr><td colspan='6'>Error: " . $e->getMessage() . "</td></tr>";
                    }
                    $conn1 = null; // Close the database connection
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>

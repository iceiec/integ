<!DOCTYPE html>
<html>
<head>
    <title>Online Receipt</title>
    <link rel="stylesheet" href="gcash.css">
</head>
<script>
    function confirmBooking() {
        // You can also perform the booking logic here before showing the alert
        alert('Booked successfully');
        window.location.href = 'book.php';
    }
</script>
<body>
    <div id="con" style="height:480px; width:600px; background-color:white; box-shadow:0px 5px 10px black; display: auto; margin-right:auto; margin-left:auto; margin-top:0px;"><br>
        <br><br><br><h2 style="text-align:center; font-size:30px;">Online Receipt</h2>
        <?php
        // Database connection
        require "client.php";

        // Get the necessary information from the database
        if (isset($_GET['reference_number'], $_GET['client_id'])) {
            $referenceNumber = $_GET['reference_number'];
            $clientId = $_GET['client_id'];

            // Query to fetch the transaction details
            $query = "SELECT t.reference_number, t.amount, s.total_amount, s.court_name, c.client_firstn, c.client_lastn, c.client_contnum
            FROM transactions t
            JOIN sched s ON t.sched_id = s.sched_id
            JOIN client c ON s.client_id = c.client_id
            WHERE t.reference_number = :reference_number AND c.client_id = :client_id";            
  
            $stmt = $conn1->prepare($query);
            $stmt->bindParam(':reference_number', $referenceNumber);
            $stmt->bindParam(':client_id', $clientId);
            $stmt->execute();

            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($row) {
                $gcashHolder = "P***** A.";
                $gcashNumber = "0932 868 1868";
                $userName = $row['client_firstn'] . " " . $row['client_lastn'];
                $senderNumber = $row['client_contnum'];
                $amountPaid = $row['amount'];
                $remainingBalance = $row['total_amount'] - $row['amount'];
                $courtName = $row['court_name'];

                echo "<div class='section' style='margin-left:50px'>";
                echo "<p><strong>GCash Holder:</strong> $gcashHolder</p>";
                echo "<p><strong>GCash Number:</strong> $gcashNumber</p>";
                echo "<p><strong>User Name:</strong> $userName</p>";
                echo "<p><strong>Reference Number:</strong> $referenceNumber</p>";
                echo "<p><strong>Sender Number:</strong> $senderNumber</p>";
                echo "</div>";

                echo "<div class='section' style='margin-left:50px'>";
                echo "<h3 style='margin-left:145px; font-size:30px;'>Payment Details</h3>";
                echo "<p><strong>Amount Paid:</strong> ₱$amountPaid</p>";
                echo "<p><strong>Remaining Balance:</strong> ₱$remainingBalance</p>";
                echo "</div>";

                echo "<div class='section'>";
                echo "<div class='text-center mt-3'>";
                echo "</div>";
            }
        }

        // Audit trail
        $auditQuery = "INSERT INTO audit_trail (client_id, action) VALUES (:client_id, 'paid')";
        $stmt = $conn1->prepare($auditQuery);
        $stmt->bindParam(':client_id', $clientId);
        $stmt->execute();
        ?>
        <a href='javascript:void(0);' class="button" onclick="confirmBooking()" style="margin-left:260px;">Confirm</a>
        
    </div>
</body>
</html>

<?php
session_start();
require "con.php";

if (isset($_POST['court'], $_POST['date'], $_POST['time']) && isset($_SESSION['email'])) {
    $court = $_POST['court'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $email = $_SESSION['email'];
    $downpayment = 300;
    $totalAmount = ($court === 'Andoy') ? 600 : 500;

    try {
        $clientQuery = "SELECT client_id FROM client WHERE client_email = :email";
        $stmt = $conn->prepare($clientQuery);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $clientInfo = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($clientInfo) {
            $clientId = $clientInfo['client_id'];

            $startEndTime = explode("-", $time);
            $startTime = $startEndTime[0] . ":00";
            $endTime = $startEndTime[1] . ":00";

            $startTimeFull = $date . ' ' . $startTime;
            $endTimeFull = $date . ' ' . $endTime;

            $conn->beginTransaction();

            try {
                // Check if slot is available
                $query = "SELECT * FROM sched WHERE court_name = :court AND sched_timedate = :start_time";
                $stmt = $conn->prepare($query);
                $stmt->bindParam(':court', $court);
                $stmt->bindParam(':start_time', $startTimeFull);
                $stmt->execute();
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

                if (!$result) {
                    // Book the slot
                    $insertQuery = "INSERT INTO sched (client_id, sched_timedate, sched_endtime, court_name, sched_status, sched_time, sched_end, total_amount) VALUES (:client_id, :start_time, :end_time, :court, 'Booked', :start_time_only, :end_time_only, :total_amount)";
                    $stmt = $conn->prepare($insertQuery);
                    $stmt->bindParam(':client_id', $clientId);
                    $stmt->bindParam(':start_time', $startTimeFull);
                    $stmt->bindParam(':end_time', $endTimeFull);
                    $stmt->bindParam(':court', $court);
                    $stmt->bindParam(':start_time_only', $startTime);
                    $stmt->bindParam(':end_time_only', $endTime);
                    $stmt->bindParam(':total_amount', $totalAmount);
                    if ($stmt->execute()) {
                        $schedId = $conn->lastInsertId();
                        
                        // Insert transaction record
                        $transQuery = "INSERT INTO transactions (sched_id, amount, payment_method, reference_number) VALUES (:sched_id, :downpayment, 'GCash', :reference_number)";
                        $stmt = $conn->prepare($transQuery);
                        $stmt->bindParam(':sched_id', $schedId);
                        $stmt->bindParam(':downpayment', $downpayment);
                        $stmt->bindParam(':reference_number', uniqid('REF_', true));
                        if ($stmt->execute()) {
                            $conn->commit();
                            $auditQuery = "INSERT INTO audit_trail (client_id, action) VALUES (:client_id, 'booking')";
                            $stmt = $conn->prepare($auditQuery);
                            $stmt->bindParam(':client_id', $clientId);
                            $stmt->execute();

                            $_SESSION['success_message'] = "Booking successful!";
                            header("Location: adminsched.php");
                            exit();
                        } else {
                            throw new Exception("Failed to record the transaction. Please try again.");
                        }
                    } else {
                        throw new Exception("Failed to book the schedule. Please try again.");
                    }
                } else {
                    $_SESSION['error_message'] = "The slot is already booked!";
                    header("Location: adminsched.php");
                    exit();
                }
            } catch (Exception $e) {
                $conn->rollBack();
                $_SESSION['error_message'] = $e->getMessage();
                header("Location: adminsched.php");
                exit();
            }
        } else {
            $_SESSION['error_message'] = "Client not found.";
            header("Location: adminsched.php");
            exit();
        }
    } catch(PDOException $e) {
        $_SESSION['error_message'] = "Connection failed: " . $e->getMessage();
        header("Location: adminsched.php");
        exit();
    }
} else {
    $_SESSION['error_message'] = "Invalid form submission.";
    header("Location: adminsched.php");
    exit();
}
?>

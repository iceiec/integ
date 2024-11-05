<?php
session_start();
require "client.php";

function logError($message) {
    error_log($message, 3, 'error_log.txt'); // Log to a file named error_log.txt
}

if (isset($_POST['reference_number'], $_POST['client_id'])) {
    $referenceNumber = $_POST['reference_number'];
    $clientId = $_POST['client_id'];

    try {
        $conn1->beginTransaction();

        // Find the schedule ID associated with the reference number
        $query = "SELECT sched_id FROM transactions WHERE reference_number = :reference_number";
        $stmt = $conn1->prepare($query);
        $stmt->bindParam(':reference_number', $referenceNumber);
        $stmt->execute();
        $transaction = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($transaction) {
            $schedId = $transaction['sched_id'];

            // Delete the transaction record
            $deleteTransactionQuery = "DELETE FROM transactions WHERE reference_number = :reference_number";
            $stmt = $conn1->prepare($deleteTransactionQuery);
            $stmt->bindParam(':reference_number', $referenceNumber);
            $stmt->execute();

            // Delete the schedule record
            $deleteScheduleQuery = "DELETE FROM sched WHERE sched_id = :sched_id";
            $stmt = $conn1->prepare($deleteScheduleQuery);
            $stmt->bindParam(':sched_id', $schedId);
            $stmt->execute();

            // Insert audit trail record
            $auditQuery = "INSERT INTO audit_trail (client_id, action) VALUES (:client_id, 'booking cancellation')";
            $stmt = $conn1->prepare($auditQuery);
            $stmt->bindParam(':client_id', $clientId);
            $stmt->execute();

            $conn1->commit();
            echo "success";
        } else {
            throw new Exception("Transaction not found.");
        }
    } catch (Exception $e) {
        $conn1->rollBack();
        logError("Error: " . $e->getMessage());
        echo "error: " . $e->getMessage();
    }
} else {
    logError("Error: Invalid request.");
    echo "error: Invalid request.";
}
?>

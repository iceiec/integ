<?php
session_start();

// Enable error reporting for debugging purposes
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Check if the session is active
if (isset($_SESSION['client_id'])) {
    $client_id = $_SESSION['client_id'];

    require "con.php"; // Include the database connection file

    try {
        // Insert logout record into audit_trail table
        $action = 'logout';
        $sql_audit = "INSERT INTO audit_trail (client_id, action) VALUES (:client_id, :action)";
        $stmt_audit = $conn->prepare($sql_audit);
        $stmt_audit->bindParam(':client_id', $client_id);
        $stmt_audit->bindParam(':action', $action);
        $stmt_audit->execute();
        $stmt_audit->closeCursor(); // Close the statement

        // Unset all session variables
        session_unset();

        // Destroy the session
        session_destroy();

        // Close the database connection
        $conn = null;

        // Redirect to the login page or any other desired page
        header("Location: front.php");
        exit();
    } catch (PDOException $e) {
        die("Database error: " . $e->getMessage());
    }
} else {
    // Handle the case when the session is not active
    echo "Session expired or not active.";
    exit();
}
?>

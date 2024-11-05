<?php
// Start the session
session_start();

// Unset all session variables
session_unset();

// Destroy the session
session_destroy();

// Insert logout record into audit_trail table
require "con.php"; // Include the database connection file

if (isset($_SESSION['client_id'])) {
    $client_id = $_SESSION['client_id'];
    $action = 'logout';

    $sql_audit = "INSERT INTO audit_trail (client_id, action) VALUES (?, ?)";
    $stmt_audit = $conn->prepare($sql_audit);
    $stmt_audit->bind_param("is", $client_id, $action);
    $stmt_audit->execute();
    $stmt_audit->close(); // Close the statement
}

// Redirect to the login page
header("Location: login.php");
exit();
?>
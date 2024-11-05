<?php
require "con.php"; // Assuming you have a separate file for database connection
session_start();
$email = $_SESSION['email'];

try {
    // Fetch current first name, last name, and contact number from the database
    $getCurrentNameSql = "SELECT client_firstn, client_lastn FROM client WHERE client_email = ?";
    $getCurrentNameStmt = $conn->prepare($getCurrentNameSql);
    $getCurrentNameStmt->execute([$email]);
    $result = $getCurrentNameStmt->fetch(PDO::FETCH_ASSOC);
    $currentFirstName = $result['client_firstn'];
    $currentLastName = $result['client_lastn'];

    // Store current first name, last name, and contact number in the session
    $_SESSION['client_firstn'] = $currentFirstName;
    $_SESSION['client_lastn'] = $currentLastName;

    // Update first name, last name, and contact number
    $firstName = $_POST['firstname'];
    $lastName = $_POST['lastname'];

    $updateNameSql = "UPDATE client SET client_firstn = ?, client_lastn = ? WHERE client_email = ?";
    $updateNameStmt = $conn->prepare($updateNameSql);

    if ($updateNameStmt->execute([$firstName, $lastName, $email])) {
        // Handle profile picture upload
        if (!empty($_FILES['profilepic']['tmp_name'])) {
            $targetDir = "uploads/";
            $targetFile = $targetDir . basename($_FILES["profilepic"]["name"]);
            if (move_uploaded_file($_FILES["profilepic"]["tmp_name"], $targetFile)) {
                $profilePicture = $targetFile;
                // Update profile picture path in the database
                $updatePicSql = "UPDATE client SET pfp = ? WHERE client_email = ?";
                $updatePicStmt = $conn->prepare($updatePicSql);
                $updatePicStmt->execute([$profilePicture, $email]);
                echo "<script>alert('Profile updated successfully!');</script>";
                echo "<script>window.location.href = 'profad.php';</script>";
            } else {
                echo "Error updating profile.";
            }
        }
    } else {
        echo "Error updating profile.";
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
$conn = null;
?>
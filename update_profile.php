<?php
require "client.php"; // Assuming you have a separate file for database connection

session_start();
$email = $_SESSION['email'];

try {
    // Fetch current first name, last name, and contact number from the database
    $getCurrentNameSql = "SELECT client_firstn, client_lastn, client_contnum FROM client WHERE client_email = ?";
    $getCurrentNameStmt = $conn1->prepare($getCurrentNameSql);
    $getCurrentNameStmt->execute([$email]);
    $result = $getCurrentNameStmt->fetch(PDO::FETCH_ASSOC);

    $currentFirstName = $result['client_firstn'];
    $currentLastName = $result['client_lastn'];
    $currentNum = $result['client_contnum'];

    // Store current first name, last name, and contact number in the session
    $_SESSION['client_firstn'] = $currentFirstName;
    $_SESSION['client_lastn'] = $currentLastName;
    $_SESSION['client_contnum'] = $currentNum;

    // Update first name, last name, and contact number
    $firstName = $_POST['firstname'];
    $lastName = $_POST['lastname'];
    $cont = $_POST['phone'];

    $updateNameSql = "UPDATE client SET client_firstn = ?, client_lastn = ?, client_contnum = ? WHERE client_email = ?";
    $updateNameStmt = $conn1->prepare($updateNameSql);
    
    if ($updateNameStmt->execute([$firstName, $lastName, $cont, $email])) {
        // Handle profile picture upload
        if (!empty($_FILES['profilepic']['tmp_name'])) {
            $targetDir = "uploads/";
            $targetFile = $targetDir . basename($_FILES["profilepic"]["name"]);
            if (move_uploaded_file($_FILES["profilepic"]["tmp_name"], $targetFile)) {
                $profilePicture = $targetFile;

                // Update profile picture path in the database
                $updatePicSql = "UPDATE client SET pfp = ? WHERE client_email = ?";
                $updatePicStmt = $conn1->prepare($updatePicSql);
                $updatePicStmt->execute([$profilePicture, $email]);

                // Insert audit trail entry
                $clientId = $_SESSION['client_id'];
                $updatedFirstName = ($firstName != $_SESSION['client_firstn']) ? true : false;
                $updatedLastName = ($lastName != $_SESSION['client_lastn']) ? true : false;
                $updatedCont = ($cont != $_SESSION['client_contnum']) ? true : false;

                if ($updatedFirstName || $updatedLastName || $updatedCont) {
                    $auditQuery = "INSERT INTO audit_trail (client_id, action) VALUES (?, 'update name and profile')";
                } else {
                    $auditQuery = "INSERT INTO audit_trail (client_id, action) VALUES (?, 'update profile')";
                }

                $auditStmt = $conn1->prepare($auditQuery);
                $auditStmt->execute([$clientId]);
            } else {
                echo "Error uploading profile picture.";
            }
        } else {
            // Insert audit trail entry for updating first name, last name, and/or contact number
            $clientId = $_SESSION['client_id'];
            $updatedFirstName = ($firstName != $_SESSION['client_firstn']) ? true : false;
            $updatedLastName = ($lastName != $_SESSION['client_lastn']) ? true : false;
            $updatedCont = ($cont != $_SESSION['client_contnum']) ? true : false;

            if ($updatedFirstName || $updatedLastName || $updatedCont) {
                $auditQuery = "INSERT INTO audit_trail (client_id, action) VALUES (?, 'update profile')";
                $auditStmt = $conn1->prepare($auditQuery);
                $auditStmt->execute([$clientId]);
            }
        }

        echo "<script>alert('Profile updated successfully!');</script>";
        echo "<script>window.location.href = 'profile.php';</script>";
    } else {
        echo "Error updating profile.";
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

$conn1 = null;
?>

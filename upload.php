<?php
require "con.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Handling profile picture upload
    $targetDir = "uploads/";
    $targetFile = $targetDir . basename($_FILES["pfp"]["name"]);
    if (move_uploaded_file($_FILES["pfp"]["tmp_name"], $targetFile)) {
        $profilePicture = $targetFile;

        // Inserting profile picture details into the database
        $insertSql = "INSERT INTO client (pfp) VALUES (?)";
        $auditQuery = "INSERT INTO audit_trail (client_id, action) VALUES ('$clientId', 'updateProfile')";
        $conn1->query($auditQuery);
        $insertStmt = $conn->prepare($insertSql);
        $insertStmt->bind_param("s", $profilePicture);

        if ($insertStmt->execute()) {
            echo "<script>alert('Uploaded Image!');</script>";
            echo "<script>window.location.href = 'fronthome.php';</script>";
        } else {
            $response = "Error placing order: " . $conn->error;
            echo $response;
        }

        // Closing statements and connection
        $insertStmt->close();
    } else {
        echo "Error uploading file.";
    }
   

    $conn->close();
}
?>

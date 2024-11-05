<?php
session_start();
require 'con.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_SESSION['email'];
    $new_pass = $_POST['new_pass'];
    $confirm_pass = $_POST['confirm_pass'];

    if ($new_pass === $confirm_pass) {
        $hashedpw = password_hash($new_pass, PASSWORD_DEFAULT);

        // Create a new PDO instance
        try {
            $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            // Set the PDO error mode to exception
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
            exit;
        }

        $sql = "UPDATE client SET client_pw = :hashedpw WHERE client_email = :email";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':hashedpw', $hashedpw, PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();

        session_destroy();
        echo "<script>alert('Password reset successfully!'); window.location.href = 'login.php';</script>";

        // Close PDO connection
        $pdo = null;
    } else {
        echo "<script>alert('Passwords do not match!'); window.location.href = 'reset_password.php';</script>";
    }
}
?>

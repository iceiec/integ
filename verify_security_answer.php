<?php
session_start();
require 'con.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_SESSION['email'];
    $seca = $_POST['seca'];

    // Create a new PDO instance
    try {
        $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        // Set the PDO error mode to exception
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
        exit;
    }

    $sql = "SELECT security_answer FROM client WHERE client_email = :email";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->execute();
    $stmt->bindColumn('security_answer', $security_answer);
    $stmt->fetch();

    if ($security_answer === $seca) {
        $_SESSION['verified'] = true;
        header("Location: reset_password.php");
        exit();
    } else {
        echo "<script>alert('Incorrect answer!'); window.location.href = 'security_question.php';</script>";
    }

    // Close PDO connection
    $pdo = null;
}
?>

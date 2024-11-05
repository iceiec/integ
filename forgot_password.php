<?php
require 'con.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];

    // Create a new PDO instance
    try {
        $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        // Set the PDO error mode to exception
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
        exit;
    }

    $sql = "SELECT security_question FROM client WHERE client_email = :email";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->execute();
    $stmt->bindColumn('security_question', $security_question);
    $stmt->fetch();

    if ($security_question) {
        session_start();
        $_SESSION['email'] = $email;
        $_SESSION['security_question'] = $security_question;
        header("Location: security_question.php");
        exit();
    } else {
        echo "<script>alert('Email not found!'); window.location.href = 'forgot_password.php';</script>";
    }

    // Close PDO connection
    $pdo = null;
}
?>

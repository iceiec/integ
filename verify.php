<?php
session_start();
require "con.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $pass = $_POST['pass'];

    $sql = "SELECT client_id, client_pw, user_level, failed_attempts, lockout_time FROM client WHERE client_email = :email";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result) {
        $client_id = $result['client_id'];
        $hashed = $result['client_pw'];
        $userLevel = $result['user_level'];
        $failedAttempts = $result['failed_attempts'];
        $lockoutTime = $result['lockout_time'];
        
        $currentTime = time();
        $lockoutDuration = 60; // 1 minute in seconds
        $lockoutEnd = strtotime($lockoutTime) + $lockoutDuration;

        if ($lockoutTime && $currentTime < $lockoutEnd) {
            echo "<script>alert('Account is locked. Please try again in 1 minute.'); window.location.href = 'login.php';</script>";
            exit();
        }

        if (password_verify($pass, $hashed)) {
            $sql_reset_attempts = "UPDATE client SET failed_attempts = 0, lockout_time = NULL WHERE client_id = :client_id";
            $stmt_reset = $conn->prepare($sql_reset_attempts);
            $stmt_reset->bindParam(':client_id', $client_id);
            $stmt_reset->execute();

            $_SESSION['email'] = $email;
            $_SESSION['user_level'] = $userLevel;
            $_SESSION['client_id'] = $client_id;

            $action = 'login';
            $sql_audit = "INSERT INTO audit_trail (client_id, action) VALUES (:client_id, :action)";
            $stmt_audit = $conn->prepare($sql_audit);
            $stmt_audit->bindParam(':client_id', $client_id);
            $stmt_audit->bindParam(':action', $action);
            $stmt_audit->execute();

            if ($userLevel == 1) {
                header("Location: frontlog.php");
            } elseif ($userLevel == 2) {
                header("Location: admin.php");
            } else {
                echo "<script>alert('Unexpected user level.'); window.location.href = 'login.php';</script>";
            }
            exit();
        } else {
            $failedAttempts++;
            if ($failedAttempts >= 4) {
                $lockoutTime = date("Y-m-d H:i:s");
                $sql_update_attempts = "UPDATE client SET failed_attempts = :failed_attempts, lockout_time = :lockout_time WHERE client_id = :client_id";
                $stmt_update = $conn->prepare($sql_update_attempts);
                $stmt_update->bindParam(':failed_attempts', $failedAttempts);
                $stmt_update->bindParam(':lockout_time', $lockoutTime);
                $stmt_update->bindParam(':client_id', $client_id);
            } else {
                $sql_update_attempts = "UPDATE client SET failed_attempts = :failed_attempts WHERE client_id = :client_id";
                $stmt_update = $conn->prepare($sql_update_attempts);
                $stmt_update->bindParam(':failed_attempts', $failedAttempts);
                $stmt_update->bindParam(':client_id', $client_id);
            }
            $stmt_update->execute();

            echo "<script>alert('Incorrect password! Please try again. " . $failedAttempts . " attempt(s). You only have 4 attempts.'); window.location.href = 'login.php';</script>";
            exit();
        }
    } else {
        echo "<script>alert('Email not found! Please try again.'); window.location.href = 'login.php';</script>";
        exit();
    }
}
?>

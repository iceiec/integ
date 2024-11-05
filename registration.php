<?php
require 'con.php';

$fname = $_POST['fname'];
$mname = $_POST['mname'];
$lname = $_POST['lname'];
$email = $_POST['email'];
$pass = $_POST['pass'];
$cont = $_POST['cont'];
$secq = $_POST['secq'];
$seca = $_POST['seca'];

$hashedpw = password_hash($pass, PASSWORD_DEFAULT);

try {
    // Create a new PDO instance
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // Set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Prepare the SQL statement
    $sql = "INSERT INTO client (client_firstn, client_midn, client_lastn, client_contnum, client_email, client_pw, security_question, security_answer, user_level, reg_date) 
            VALUES (:fname, :mname, :lname, :cont, :email, :hashedpw, :secq, :seca, 1, NOW())";
    $stmt = $pdo->prepare($sql);

    // Bind parameters
    $stmt->bindParam(':fname', $fname, PDO::PARAM_STR);
    $stmt->bindParam(':mname', $mname, PDO::PARAM_STR);
    $stmt->bindParam(':lname', $lname, PDO::PARAM_STR);
    $stmt->bindParam(':cont', $cont, PDO::PARAM_STR);
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->bindParam(':hashedpw', $hashedpw, PDO::PARAM_STR);
    $stmt->bindParam(':secq', $secq, PDO::PARAM_STR);
    $stmt->bindParam(':seca', $seca, PDO::PARAM_STR);

    // Execute the statement
    $stmt->execute();

    echo "<script>alert('Registered Successfully!'); window.location.href = 'login.php'; </script>";
} catch (PDOException $e) {
    echo "<script>alert('Error inserting record! Please try again..'); window.location.href = 'register.php'; </script>";
    // For debugging purposes, you can uncomment the line below
    // echo "Error: " . $e->getMessage();
}

// Close the PDO connection
$pdo = null;
?>

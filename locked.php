<?php
session_start();
require "con.php";

// Initialize variables
$sql = "";
$result = null;

// Check if the user is an admin
if ($_SESSION['user_level'] != 2) {
    header("Location: login.php");
    exit();
}

// Create a new PDO instance
try {
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // Set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    exit;
}

// Unlock user if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['unlock_user'])) {
    $clientId = $_POST['client_id'];

    $sql = "UPDATE client SET failed_attempts = 0, lockout_time = NULL WHERE client_id = :client_id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':client_id', $clientId, PDO::PARAM_INT);
    $stmt->execute();

    echo "<script>alert('User account has been unlocked.'); window.location.href = 'locked.php';</script>";
}

// Fetch all locked users
$sql = "SELECT client_id, client_email, failed_attempts, lockout_time FROM client WHERE failed_attempts > 0 OR lockout_time IS NOT NULL";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page - Locked Users</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <br>
        <h2>Unlock User</h2>
        <form method="get" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <div class="form-group">
            
            </div>
        </form>
        
        <table class="table table-striped table-bordered mt-3">
            <thead class="thead-dark">
                <tr>
                    <th>Email</th>
                    <th>Failed Attempts</th>
                    <th>Lockout Time</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($result as $user): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($user['client_email']); ?></td>
                        <td><?php echo $user['failed_attempts']; ?></td>
                        <td><?php echo $user['lockout_time']; ?></td>
                        <td>
                            <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>" style="display:inline;">
                                <input type="hidden" name="client_id" value="<?php echo $user['client_id']; ?>">
                                <button type="submit" name="unlock_user" class="btn btn-primary">Unlock</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
                
            </tbody>
        </table>
    </div>
    <div class="text-center mt-3">
        <a href="admin.php">Go Back</a>
    </div>
</body>
</html>

<?php
// Close PDO connection
$pdo = null;
?>

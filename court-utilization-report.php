<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Court Utilization Report</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="front.css">
</head>
<body>
<div class="container">
    <h1>Court Utilization Report</h1>
    <form method="GET" action="">
        <label for="start_date">Start Date:</label>
        <input type="date" id="start_date" name="start_date">

        <label for="end_date">End Date:</label>
        <input type="date" id="end_date" name="end_date">

        <input type="submit" value="Generate Report">
    </form>
    <p>Report generated on <?php echo date('Y-m-d'); ?></p>
    <table class="table table-striped table-bordered">
        <thead class="thead-dark">
            <tr>
                <th>Court Name</th>
                <th>Total Bookings</th>
                <th>Total Revenue</th>
            </tr>
        </thead>
        <tbody>
        <?php
require "con.php"; // Ensure this file correctly establishes the database connection

// Retrieve start and end dates from the form submission
$start_date = $_GET['start_date'] ?? null;
$end_date = $_GET['end_date'] ?? null;

// Set default date range if not provided
if (!$start_date || !$end_date) {
    $start_date = date('Y-m-d', strtotime('-1 month')); // Default to one month ago
    $end_date = date('Y-m-d'); // Default to current date
}

try {
    // Construct SQL query with date range filter
    $courtUtilizationReport = "SELECT s.court_name,
    COUNT(t.transaction_id) AS total_bookings,
    SUM(t.amount) AS total_revenue
FROM sched s
LEFT JOIN transactions t ON s.sched_id = t.sched_id
WHERE DATE(t.timestamp) BETWEEN :start_date AND :end_date
GROUP BY s.court_name;";

    // Prepare the query
    $stmt = $conn->prepare($courtUtilizationReport);

    // Bind parameters
    $stmt->bindParam(':start_date', $start_date);
    $stmt->bindParam(':end_date', $end_date);

    // Execute the query
    $stmt->execute();

    // Fetch the results
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if ($results) {
        foreach ($results as $row) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row['court_name']) . "</td>";
            echo "<td>" . $row['total_bookings'] . "</td>";
            echo "<td>" . $row['total_revenue'] . "</td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='3'>No bookings found.</td></tr>";
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

$conn = null; // Close database connection
?>


        </tbody>
    </table>
    <div class="text-center mt-3">
    <a href="pdf-court.php?start_date=<?php echo urlencode($start_date); ?>&end_date=<?php echo urlencode($end_date); ?>" target="_blank" class="btn btn-primary">Download PDF</a>
    </div>
    <a href="admin.php">Go Back</a>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

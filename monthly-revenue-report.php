<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Monthly Revenue Report</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="front.css">
</head>
<body>
<div class="container">
    <h1>Monthly Revenue Report</h1>
    <form method="get" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <label for="month">Select Month:</label>
        <input type="month" id="month" name="month" value="<?php echo isset($_GET['month']) ? $_GET['month'] : date('Y-m'); ?>">
        <button type="submit" class="btn btn-primary">Generate Report</button>
    </form>
    <p>Report generated on <?php echo date('Y-m-d'); ?></p>
    <table class="table table-striped table-bordered">
        <thead class="thead-dark">
            <tr>
                <th>Month</th>
                <th>Total Revenue</th>
            </tr>
        </thead>
        <tbody>
            <?php
            require "con.php";

            // Create a new PDO instance
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            // Set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $selectedMonth = isset($_GET['month']) ? $_GET['month'] : date('Y-m');

            // Prepare the SQL statement
            $monthlyRevenueReport = "SELECT DATE_FORMAT(s.sched_timedate, '%Y-%m') AS month,
                                     SUM(s.total_amount) AS total_revenue
                                     FROM sched s
                                     INNER JOIN transactions t ON s.sched_id = t.sched_id
                                     WHERE DATE_FORMAT(s.sched_timedate, '%Y-%m') = :selectedMonth
                                     GROUP BY DATE_FORMAT(s.sched_timedate, '%Y-%m');";
            $stmt = $conn->prepare($monthlyRevenueReport);
            $stmt->bindParam(':selectedMonth', $selectedMonth);
            $stmt->execute();

            // Fetch the result
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($row) {
                echo "<tr>";
                echo "<td>" . date('F Y', strtotime($row['month'] . '-01')) . "</td>";
                echo "<td>" . htmlspecialchars($row['total_revenue']) . "</td>";
                echo "</tr>";
            } else {
                echo "<tr><td colspan='2'>No revenue data found for the selected month.</td></tr>";
            }
            ?>
        </tbody>
    </table>
    <div class="text-center mt-3">
        <a href="pdf-rev.php?month=<?php echo htmlspecialchars($selectedMonth); ?>" target="_blank" class="btn btn-primary">Download PDF</a>
    </div>
    <a href="admin.php">Go Back</a>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

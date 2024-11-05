<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Top Clients Report</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="front.css">
</head>
<body>
<div class="container">
    <h1>Top Clients Report</h1>
    <p>Report generated on <?php echo date('Y-m-d'); ?></p>
    <table class="table table-striped table-bordered">
        <thead class="thead-dark">
            <tr>
                <th>Client Name</th>
                <th>Total Bookings</th>
            </tr>
        </thead>
        <tbody>
            <?php
            require "con.php";
            $topClientsReport = "
                SELECT CONCAT(c.client_firstn, ' ', c.client_lastn) AS client_name, COUNT(s.sched_id) AS total_bookings
                FROM client c
                INNER JOIN sched s ON c.client_id = s.client_id
                GROUP BY c.client_id
                HAVING COUNT(s.sched_id) >= 6
                ORDER BY total_bookings DESC;
            ";
            $stmt = $conn->prepare($topClientsReport);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if ($result) {
                foreach ($result as $row) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row['client_name']) . "</td>";
                    echo "<td>" . $row['total_bookings'] . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='2'>No clients found with 6 or more bookings.</td></tr>";
            }
            ?>
        </tbody>
    </table>
    <div class="text-center mt-3">
        <a href="pdf-client.php" target="_blank" class="btn btn-primary">Download PDF</a>
    </div>
    <a href="admin.php">Go Back</a>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

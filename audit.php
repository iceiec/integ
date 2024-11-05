<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Audit Trail Report</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="front.css">
</head>
<body>
<div class="container">
    <h1>Audit Trail Report</h1>
    <form method="get" action="<?php echo $_SERVER['PHP_SELF']; ?>">
      <label for="date">Select Date:</label>
<input type="date" id="date" name="date" value="<?php echo isset($_GET['date']) ? $_GET['date'] : date('Y-m-d'); ?>">
<button type="submit" class="btn btn-primary">Generate Report</button>

    </form>
    <p>Report generated on <?php echo date('Y-m-d'); ?></p>
    <table class="table table-striped table-bordered">
        <thead class="thead-dark">
            <tr>
                <th>Audit ID</th>
                <th>Name</th>
                <th>Action</th>
                <th>Timestamp</th>
            </tr>
        </thead>
        <tbody>
        <?php
require "con.php";

// Pagination variables
$limit = 15; // Number of records to display per page
$offset = isset($_GET['offset']) ? $_GET['offset'] : 0; // Offset for pagination

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    // Retrieve the selected date from the form
    $selectedDate = isset($_GET['date']) ? $_GET['date'] : date('Y-m-d');

    // Query to fetch audit trail records for the selected date
    $auditTrailReport = "SELECT at.id, CONCAT(c.client_firstn, ' ', c.client_midn, ' ', c.client_lastn) AS fullname, at.action, at.timestamp
                         FROM audit_trail at
                         JOIN client c ON at.client_id = c.client_id
                         WHERE DATE(at.timestamp) = '$selectedDate'
                         ORDER BY at.timestamp DESC
                         LIMIT $limit OFFSET $offset;";

    // Execute the query
    $result = $conn->query($auditTrailReport);

    if ($result) {
        // Check if records are found
        if ($result->rowCount() > 0) {
            // Display the audit trail records
            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                echo "<tr>";
                echo "<td>" . $row['id'] . "</td>";
                echo "<td>" . $row['fullname'] . "</td>";
                echo "<td>" . $row['action'] . "</td>";
                echo "<td>" . $row['timestamp'] . "</td>";
                echo "</tr>";
            }
        } else {
            // No audit trail records found for the selected date
            echo "<tr><td colspan='4'>No audit trail records found for the selected date.</td></tr>";
        }
    } else {
        // Query execution failed
        echo "Error: " . $conn->errorInfo()[2];
    }
    }

?>

        </tbody>
    </table>
    
    <div class="text-center mt-3">
        <?php
      $countQuery = "SELECT COUNT(*) AS total FROM audit_trail;";
      $countResult = $conn->query($countQuery);
      
      if ($countResult) {
          $totalRecords = $countResult->fetchColumn();
      
          if ($offset > 0) {
              $prevOffset = max(0, $offset - $limit);
              echo "<a href='?offset=$prevOffset' class='btn btn-secondary'>Back</a>";
          }
      
          if ($offset + $limit < $totalRecords) {
              $nextOffset = $offset + $limit;
              echo "<a href='?offset=$nextOffset' class='btn btn-primary ml-2'>Next</a>";
          }
      } else {
          // Handle the error case if the query fails
          $totalRecords = 0;
          echo "Error: " . $conn->errorInfo()[2];
      }
        ?>
    </div>
    <div class="text-center mt-3">
        <a href="pdf-audit.php?month=<?php echo $selectedMonth; ?>" target="_blank" class="btn btn-primary">Download PDF</a>
    </div>
    <a href="admin.php">Go Back</a>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
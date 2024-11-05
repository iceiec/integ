<?php
// Include TCPDF library
require_once('tcpdf/tcpdf.php');
require('con.php');

try {
    // Create a new PDO instance
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // Set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Query to retrieve data from the "sched" and "trans" tables
    $sql = "SELECT s.court_name,
    COUNT(t.transaction_id) AS total_bookings,
    SUM(t.amount) AS total_revenue
FROM sched s
LEFT JOIN transactions t ON s.sched_id = t.sched_id
WHERE DATE(t.timestamp) BETWEEN :start_date AND :end_date
GROUP BY s.court_name;";
    $stmt = $conn->prepare($sql);

    // Retrieve start and end dates from the form submission
    $start_date = $_GET['start_date'] ?? null;
    $end_date = $_GET['end_date'] ?? null;

    // Bind parameters
    $stmt->bindParam(':start_date', $start_date, PDO::PARAM_STR);
    $stmt->bindParam(':end_date', $end_date, PDO::PARAM_STR);

    // Execute the query
    $stmt->execute();

    // Fetch all results
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Initialize TCPDF
    $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

    // Set document information
    $pdf->SetCreator(PDF_CREATOR);
    $pdf->SetAuthor('Your Name');
    $pdf->SetTitle('Court Utilization Report');
    $pdf->SetSubject('Court Utilization Report');
    $pdf->SetKeywords('TCPDF, PDF, report');

    // Remove default header/footer
    $pdf->setPrintHeader(false);
    $pdf->setPrintFooter(false);

    // Add a page
    $pdf->AddPage();

    // Set font
    $pdf->SetFont('helvetica', '', 10);

    // Include Bootstrap CSS
    $html = '<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">';

    // Header
    $html .= '<h1 class="text-center mb-4">Court Utilization Report</h1>';
    $html .= '<p class="text-center">Report generated on ' . date('Y-m-d') . '</p>';

    // Table
    $html .= '<table class="table table-bordered">';
    $html .= '<thead class="thead-dark">';
    $html .= '<tr><th>Court Name</th><th>Total Bookings</th><th>Total Revenue</th></tr>';
    $html .= '</thead>';
    $html .= '<tbody>';

    // Loop through the results
    foreach ($results as $row) {
        $html .= '<tr>';
        $html .= '<td>' . htmlspecialchars($row['court_name']) . '</td>';
        $html .= '<td>' . htmlspecialchars($row['total_bookings']) . '</td>';
        $html .= '<td>' . htmlspecialchars($row['total_revenue']) . '</td>';
        $html .= '</tr>';
    }

    $html .= '</tbody>';
    $html .= '</table>';

    // Output the HTML content
    $pdf->writeHTML($html, true, false, true, false, '');

    // Close and output PDF document
    $pdf->Output('court-utilization.pdf', 'D');

} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}

$conn = null; // Close database connection
?>

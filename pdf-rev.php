<?php
ob_start(); // Start output buffering

// Include TCPDF library
require_once('tcpdf/tcpdf.php');
require('con.php');

// Get the selected month from the query parameter
$selectedMonth = isset($_GET['month']) ? $_GET['month'] : date('Y-m');

try {
    // Query to retrieve data from the "sched" and "transactions" tables
    $sql = "SELECT DATE_FORMAT(s.sched_timedate, '%Y-%m') AS month,
            SUM(t.total_amount) AS total_revenue
            FROM sched s
            INNER JOIN transactions t ON s.sched_id = t.sched_id
            WHERE DATE_FORMAT(s.sched_timedate, '%Y-%m') = :selectedMonth
            GROUP BY DATE_FORMAT(s.sched_timedate, '%Y-%m');";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':selectedMonth', $selectedMonth, PDO::PARAM_STR);
    $stmt->execute();

    // Fetch the result
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
    exit;
}

// Initialize TCPDF
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// Set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Your Name');
$pdf->SetTitle('Revenue Report');
$pdf->SetSubject('Revenue Report');
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
$html .= '<h1 class="text-center mb-4">Revenue Report</h1>';
$html .= '<p class="text-center">Report generated on ' . date('Y-m-d') . '</p>';

// Table
$html .= '<table class="table table-bordered">';
$html .= '<thead class="thead-dark">';
$html .= '<tr><th>Month</th><th>Total Revenue</th></tr>';
$html .= '</thead>';
$html .= '<tbody>';

if ($result) {
    foreach ($result as $row) {
        $html .= '<tr>';
        $html .= '<td>' . date('F Y', strtotime($row['month'] . '-01')) . '</td>';
        $html .= '<td>' . htmlspecialchars($row['total_revenue']) . '</td>';
        $html .= '</tr>';
    }
} else {
    $html .= '<tr><td colspan="2" class="text-center">No revenue data found for the selected month.</td></tr>';
}

$html .= '</tbody>';
$html .= '</table>';

// Output the HTML content
$pdf->writeHTML($html, true, false, true, false, '');

// Close and output PDF document
ob_end_clean(); // Clear the output buffer
$pdf->Output('revenue-report.pdf', 'D');
?>

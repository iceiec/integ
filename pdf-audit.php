<?php
ob_start(); // Start output buffering

// Include TCPDF library
require_once('tcpdf/tcpdf.php');
require('con.php');

// Get the selected date from the query parameter
$selectedDate = isset($_GET['date']) ? $_GET['date'] : date('Y-m-d');

$limit = 100; // Number of records to display per page
$offset = isset($_GET['offset']) ? $_GET['offset'] : 0; // Offset for pagination

try {
    // Query to retrieve data from the "audit_trail" table
    $sql = "SELECT * FROM audit_trail WHERE DATE(timestamp) = :selectedDate ORDER BY timestamp DESC LIMIT :limit OFFSET :offset";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':selectedDate', $selectedDate, PDO::PARAM_STR);
    $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
    $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
    exit();
}

// Initialize TCPDF
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// Set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Your Name');
$pdf->SetTitle('Audit Trail');
$pdf->SetSubject('Audit Trail');
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
$html .= '<h1 class="text-center mb-4">Audit Trail</h1>';
$html .= '<p class="text-center">Report generated on ' . date('Y-m-d') . '</p>';

// Table
$html .= '<table class="table table-bordered">';
$html .= '<thead class="thead-dark">';
$html .= '<tr><th>Audit ID</th><th>Client ID</th><th>Action</th><th>Time Stamp</th></tr>';
$html .= '</thead>';
$html .= '<tbody>';

if (count($result) > 0) {
    foreach ($result as $row) {
        $html .= '<tr>';
        $html .= '<td>' . htmlspecialchars($row['id']) . '</td>';
        $html .= '<td>' . htmlspecialchars($row['client_id']) . '</td>';
        $html .= '<td>' . htmlspecialchars($row['action']) . '</td>';
        $html .= '<td>' . htmlspecialchars($row['timestamp']) . '</td>';
        $html .= '</tr>';
    }
} else {
    $html .= '<tr><td colspan="4" class="text-center">No audit trail for the selected month.</td></tr>';
}

$html .= '</tbody>';
$html .= '</table>';

// Output the HTML content
$pdf->writeHTML($html, true, false, true, false, '');

// Close and output PDF document
ob_end_clean(); // Clear the output buffer
$pdf->Output('audit-trail.pdf', 'D');
?>

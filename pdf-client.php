<?php
// Include TCPDF library
require_once('tcpdf/tcpdf.php');
require('con.php');

// Define the current week's start and end dates
$week_start = date('Y-m-d', strtotime('last monday'));
$week_end = date('Y-m-d', strtotime('next sunday'));

// Query to retrieve data from the "client" and "sched" tables
$sql = "
    SELECT 
        CONCAT(c.client_firstn, ' ', c.client_lastn) AS client_name,
        c.client_email,
        COUNT(s.sched_id) AS total_bookings,
        GROUP_CONCAT(CONCAT('Court: ', s.court_name, ', Time: ', s.sched_time, ' - ', s.sched_end, ', Date: ', DATE(s.sched_timedate)) SEPARATOR '<br>') AS booking_details
    FROM 
        client c
    INNER JOIN 
        sched s ON c.client_id = s.client_id
    WHERE 
        s.sched_timedate BETWEEN :week_start AND :week_end
    GROUP BY 
        c.client_id
    HAVING 
        COUNT(s.sched_id) >= 6
    ORDER BY 
        total_bookings DESC;
";

// Prepare the query
$stmt = $conn->prepare($sql);

// Bind parameters
$stmt->bindParam(':week_start', $week_start);
$stmt->bindParam(':week_end', $week_end);

// Execute the query
$stmt->execute();

// Fetch the results
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Initialize TCPDF
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// Disable output buffering
ob_end_clean();

// Set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Your Name');
$pdf->SetTitle('Client Booking Report');
$pdf->SetSubject('Client Booking Report');
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
$html .= '<h1 class="text-center mb-4">Client Booking Report</h1>';
$html .= '<p class="text-center">Report generated on ' . date('Y-m-d') . '</p>';

// Table
$html .= '<table class="table table-bordered">';
$html .= '<thead class="thead-dark">';
$html .= '<tr><th>Client Name</th><th>Email</th><th>Total Bookings</th></tr>';
$html .= '</thead>';
$html .= '<tbody>';

// Check if there are results
if ($result) {
    // Loop through the results
    foreach ($result as $row) {
        $html .= '<tr>';
        $html .= '<td>' . htmlspecialchars($row['client_name']) . '</td>';
        $html .= '<td>' . htmlspecialchars($row['client_email']) . '</td>';
        $html .= '<td>' . $row['total_bookings'] . '</td>';
        $html .= '</tr>';
        // Add space between clients
        $html .= '<tr><td colspan="4">&nbsp;</td></tr>';
    }
} else {
    // No results found
    $html .= '<tr><td colspan="4" class="text-center">No clients found with at least 6 bookings.</td></tr>';
}
$html .= '</tbody>';
$html .= '</table>';

// Output the HTML content
$pdf->writeHTML($html, true, false, true, false, '');

// Close and output PDF document
$pdf->Output('client-booking-report.pdf', 'D');
?>

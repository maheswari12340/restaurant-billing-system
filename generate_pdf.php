<?php
// Include the TCPDF library
require_once('tcpdf/tcpdf.php');

// Create a new PDF document
$pdf = new TCPDF();

// Set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetTitle('Sample PDF');

// Add a page
$pdf->AddPage();

// Set content
$html = "<h1>Hello, PDF!</h1><p>This is a test PDF generated using TCPDF.</p>";

// Write HTML content
$pdf->writeHTML($html);

// Output the PDF
$pdf->Output('sample.pdf', 'D');  // 'D' forces download, 'I' for inline view
?>

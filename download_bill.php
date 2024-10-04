<?php
require_once 'tcpdf/tcpdf.php'; // Adjust the path as needed

use Dompdf\Dompdf;

session_start();

if (!isset($_SESSION['order_details'])) {
    header("Location: order.php");
    exit();
}

$order_details = $_SESSION['order_details'];
$total_price = $_SESSION['total_price'];
$tax = $_SESSION['tax'];
$total_amount = $_SESSION['total_amount'];

// Generate HTML for PDF
$html = '
<!DOCTYPE html>
<html>
<head>
    <title>Your Bill</title>
    <style>
        body { font-family: Arial, sans-serif; }
        h2 { text-align: center; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        table, th, td { border: 1px solid #ddd; }
        th, td { padding: 12px; text-align: left; }
        th { background-color: #f2f2f2; }
        .total { font-weight: bold; }
    </style>
</head>
<body>
    <h2>Your Bill</h2>
    <table>
        <thead>
            <tr>
                <th>Item</th>
                <th>Price (₹)</th>
            </tr>
        </thead>
        <tbody>';

foreach ($order_details as $item) {
    $html .= '<tr>
                <td>' . htmlspecialchars($item['name']) . '</td>
                <td>' . number_format($item['price'], 2) . '</td>
              </tr>';
}

$html .= '<tr>
            <td class="total">Total Price</td>
            <td class="total">' . number_format($total_price, 2) . '</td>
          </tr>
          <tr>
            <td class="total">Tax (10%)</td>
            <td class="total">' . number_format($tax, 2) . '</td>
          </tr>
          <tr>
            <td class="total">Total Amount</td>
            <td class="total">' . number_format($total_amount, 2) . '</td>
          </tr>
        </tbody>
    </table>
</body>
</html>';

// Create new PDF document
$pdf = new TCPDF();

// Set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Your Company Name');
$pdf->SetTitle('Your Bill ');
$pdf->SetSubject('Invoice');

// Add a page
$pdf->AddPage();

// Set content
$pdf->writeHTML($html, true, false, true, false, '');

// Output the PDF
$pdf->Output('bill.pdf', 'D');  // 'D' for download, 'I' for inline view
?>
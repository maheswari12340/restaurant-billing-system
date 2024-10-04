<?php
session_start();

if (!isset($_SESSION['order_details'])) {
    header("Location: order.php");
    exit();
}

$order_details = $_SESSION['order_details'];
$total_price = $_SESSION['total_price'];
$tax = $_SESSION['tax'];
$total_amount = $_SESSION['total_amount'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Billing</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(to right, #6a11cb, #2575fc);
            color: #fff;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            background-color: rgba(255, 255, 255, 0.1);
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
            width: 400px; /* Adjusted for a more compact layout */
            text-align: center;
        }
        h2 {
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        th, td {
            padding: 10px;
            text-align: left;
            border: 1px solid #fff;
        }
        th {
            background-color: rgba(255, 255, 255, 0.2);
        }
        tr:nth-child(even) {
            background-color: rgba(255, 255, 255, 0.1);
        }
        .download-button {
            display: inline-block;
            background-color: #2575fc;
            color: #fff;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
            margin-top: 20px;
        }
        .download-button:hover {
            background-color: #6a11cb;
        }
    </style>
</head>
<body>
    <div class="container">
    <h2>Thanks for coming !!!!</h2>
    <h2>Visit again...</h2>
        <h2>Your Bill</h2>
        <table>
            <thead>
                <tr>
                    <th>Item</th>
                    <th>Price (₹)</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($order_details as $item): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($item['name']); ?></td>
                        <td><?php echo number_format($item['price'], 2); ?></td>
                    </tr>
                <?php endforeach; ?>
                <tr>
                    <td><strong>Total Price</strong></td>
                    <td><strong><?php echo number_format($total_price, 2); ?></strong></td>
                </tr>
                <tr>
                    <td><strong>Tax (10%)</strong></td>
                    <td><strong><?php echo number_format($tax, 2); ?></strong></td>
                </tr>
                <tr>
                    <td><strong>Total Amount</strong></td>
                    <td><strong><?php echo number_format($total_amount, 2); ?></strong></td>
                </tr>
            </tbody>
        </table>
        <a href="download_bill.php" class="download-button">Download Bill as PDF</a>
    </div>
</body>
</html>

<?php
session_start();
include('db.php');

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $items = $_POST['cuisine'];
    $total_price = 0;
    $order_details = [];

    foreach ($items as $item) {
        list($name, $price) = explode('|', $item);
        $total_price += (int) $price;
        $order_details[] = array('name' => $name, 'price' => $price);
    }

    $tax = $total_price * 0.1; // 10% tax
    $total_amount = $total_price + $tax;

    // Store order in session for use in billing
    $_SESSION['order_details'] = $order_details;
    $_SESSION['total_price'] = $total_price;
    $_SESSION['tax'] = $tax;
    $_SESSION['total_amount'] = $total_amount;

    header("Location: billing.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Place Order</title>
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
            width: 800px; /* Increased width for more space */
            text-align: center;
            overflow-y: auto; /* Allow vertical scroll if content exceeds height */
            max-height: 80vh; /* Limit height for scrolling */
        }
        h2 {
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin: 20px 0 10px;
            font-weight: bold;
        }
        .dish {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin: 10px 0;
            background-color: rgba(255, 255, 255, 0.2);
            padding: 10px;
            border-radius: 5px;
        }
        img {
            width: 100px; /* Increased size for images */
            height: 100px; /* Increased size for images */
            border-radius: 5px;
            margin-right: 10px; /* Space between image and text */
            object-fit: cover; /* Maintain aspect ratio */
        }
        input[type="checkbox"] {
            margin-right: 10px; /* Space between checkbox and text */
        }
        input[type="submit"] {
            background-color: #2575fc;
            color: #fff;
            border: none;
            padding: 10px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            width: 100%;
            margin-top: 20px; /* Space above button */
        }
        input[type="submit"]:hover {
            background-color: #6a11cb;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Place Your Order</h2>
        <form method="POST" action="">
            <label>Select Dishes:</label>
            
            <h3>South Indian</h3>
            <div class="dish">
                <input type="checkbox" name="cuisine[]" value="Dosa|150"> 
                <img src="dosa.jpeg" alt="Dosa">
                <span>Dosa - ₹150</span>
            </div>
            <div class="dish">
                <input type="checkbox" name="cuisine[]" value="Idli|100"> 
                <img src="idli.jpeg" alt="Idli">
                <span>Idli - ₹100</span>
            </div>

            <h3>Rajasthani</h3>
            <div class="dish">
                <input type="checkbox" name="cuisine[]" value="Dal Baati|200"> 
                <img src="dal-bhaati.jpeg" alt="Dal Baati">
                <span>Dal Baati - ₹200</span>
            </div>
            <div class="dish">
                <input type="checkbox" name="cuisine[]" value="Gatte ki Sabzi|180"> 
                <img src="gatte ki sabzi.jpeg" alt="Gatte ki Sabzi">
                <span>Gatte ki Sabzi - ₹180</span>
            </div>

            <h3>Bengali</h3>
            <div class="dish">
                <input type="checkbox" name="cuisine[]" value="Fish Curry|220"> 
                <img src="fish curry.jpeg" alt="Fish Curry">
                <span>Fish Curry - ₹220</span>
            </div>
            <div class="dish">
                <input type="checkbox" name="cuisine[]" value="Mishti Doi|120"> 
                <img src="mishti dhoi.jpeg" alt="Mishti Doi">
                <span>Mishti Doi - ₹120</span>
            </div>

            <h3>Punjabi</h3>
            <div class="dish">
                <input type="checkbox" name="cuisine[]" value="Butter Chicken|250"> 
                <img src="butter chicken.jpeg" alt="Butter Chicken">
                <span>Butter Chicken - ₹250</span>
            </div>
            <div class="dish">
                <input type="checkbox" name="cuisine[]" value="Naan|50"> 
                <img src="naan.jpeg" alt="Naan">
                <span>Naan - ₹50</span>
            </div>

            <h3>Maharashtrian</h3>
            <div class="dish">
                <input type="checkbox" name="cuisine[]" value="Vada Pav|60"> 
                <img src="vada pav.jpeg" alt="Vada Pav">
                <span>Vada Pav - ₹60</span>
            </div>
            <div class="dish">
                <input type="checkbox" name="cuisine[]" value="Pav Bhaji|180"> 
                <img src="pav bhaji.jpeg" alt="Pav Bhaji">
                <span>Pav Bhaji - ₹180</span>
            </div>

            <input type="submit" value="Place Order">
        </form>
    </div>
</body>
</html>

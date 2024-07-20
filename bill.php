<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medical Bill</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
        }

        .bill-container {
            width: 80%;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            border-top: 5px solid #007BFF;
            border-bottom: 5px solid #007BFF;
        }

        h1 {
            text-align: center;
            color: #007BFF;
        }

        .patient-details p {
            margin: 5px 0;
            color: #555;
        }

        .bill-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .bill-table th, .bill-table td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }

        .bill-table th {
            background-color: #007BFF;
            color: #fff;
        }

        .bill-table tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .bill-table tfoot {
            font-weight: bold;
            background-color: #f2f2f2;
        }

        .print-button-container {
            text-align: center;
            margin-top: 20px;
        }

        button {
            padding: 10px 20px;
            font-size: 16px;
            color: #fff;
            background-color: #007BFF;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="bill-container">
        <h1>Hospital Medical Bill        </h1>
        <div class="patient-details">
            <?php
            // Retrieve data from URL parameters
            $patientName = $_POST['name'] ?? '';
            $patientID = $_POST['id'] ?? '';
            $date = $_POST['date'] ?? '';
            $medicineNames = $_POST['medicine_name'] ?? [];
            $quantities = $_POST['quantity'] ?? [];
            $prices = $_POST['price'] ?? [];
            $discounts = $_POST['discount'] ?? [];

            // Display patient details
            echo "<p><strong>Patient Name:</strong> $patientName</p>";
            echo "<p><strong>Patient ID:</strong> $patientID</p>";
            echo "<p><strong>Date:</strong> $date</p>";
            ?>
        </div>

        <table class="bill-table">
            <thead>
                <tr>
                    <th>Medicine Name</th>
                    <th>Quantity</th>
                    <th>Price per Unit</th>
                    <th>Total Price</th>
                    <th>Discount</th>
                    <th>Price After Discount</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Display medicine details
                $totalBeforeTax = 0;
                foreach ($medicineNames as $index => $medicineName) {
                    $quantity = $quantities[$index];
                    $price = $prices[$index];
                    $discount = $discounts[$index];
                    $totalPrice = $quantity * $price;
                    $priceAfterDiscount = $totalPrice - ($totalPrice * $discount / 100);
                    $totalBeforeTax += $priceAfterDiscount;

                    echo "<tr>";
                    echo "<td>$medicineName</td>";
                    echo "<td>$quantity</td>";
                    echo "<td>$price</td>";
                    echo "<td>$totalPrice</td>";
                    echo "<td>$discount%</td>";
                    echo "<td>$priceAfterDiscount</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
            <tfoot>
                <?php
                // Calculate tax and final amount
                $taxRate = 5;
                $taxAmount = $totalBeforeTax * $taxRate / 100;
                $finalAmount = $totalBeforeTax + $taxAmount;

                // Display total amounts
                echo "<tr><td colspan='5'><strong>Total Amount Before Tax</strong></td><td>$totalBeforeTax</td></tr>";
                echo "<tr><td colspan='5'><strong>Tax (5%)</strong></td><td>$taxAmount</td></tr>";
                echo "<tr><td colspan='5'><strong>Final Amount</strong></td><td>$finalAmount</td></tr>";
                ?>
            </tfoot>
        </table>
        <div class="print-button-container">
            <button onclick="window.print()">Print</button>
        </div>
    </div>
</body>
</html>

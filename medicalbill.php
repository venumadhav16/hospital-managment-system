<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hospital Medical Bill </title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 80%;
            margin: auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            margin-top: 50px;
        }

        h1 {
            color: #007BFF;
            text-align: center;
            margin-bottom: 30px;
        }

        label {
            font-weight: bold;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            margin-bottom: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #007BFF;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        input[type="text"],
        input[type="number"],
        input[type="date"],
        input[type="submit"] {
            padding: 8px;
            width: calc(100% - 20px);
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            margin-bottom: 10px;
        }

        input[type="submit"] {
            background-color: #007BFF;
            color: white;
            cursor: pointer;
            width: 100%;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
    <script>
        // Function to add a new row of input fields
        function addRow() {
            var table = document.getElementById("medicine-table");
            var newRow = table.insertRow(table.rows.length);
            var cells = [];
            for (var i = 0; i < 4; i++) {
                cells.push(newRow.insertCell(i));
                var input = document.createElement("input");
                input.type = (i === 0) ? "text" : "number";
                input.name = (i === 0) ? "medicine_name[]" : (i === 1) ? "quantity[]" : (i === 2) ? "price[]" : "discount[]";
                input.step = (i === 2 || i === 3) ? "0.01" : "1";
                input.required = true;
                cells[i].appendChild(input);
            }
        }
    </script>
</head>
<body>
    <div class="container">
        <h1>Hospital Medical Bill Generator</h1>
        <form action="bill.php" method="POST">
            <label for="name">Patient Name:</label>
            <input type="text" id="name" name="name" required><br>
            <label for="id">Patient ID:</label>
            <input type="text" id="id" name="id" required><br>
            <label for="date">Date:</label>
            <input type="date" id="date" name="date" required><br>

            <h2>Enter Medicine Details</h2>
            <table id="medicine-table">
                <thead>
                    <tr>
                        <th>Medicine Name</th>
                        <th>Quantity</th>
                        <th>Price per Unit</th>
                        <th>Discount (%)</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><input type="text" name="medicine_name[]" required></td>
                        <td><input type="number" name="quantity[]" required></td>
                        <td><input type="number" step="0.01" name="price[]" required></td>
                        <td><input type="number" step="0.01" name="discount[]" required></td>
                    </tr>
                </tbody>
            </table>

            <input type="button" value="Add Row" onclick="addRow()">
            <input type="submit" value="Generate Bill">
        </form>
    </div>
</body>
</html>

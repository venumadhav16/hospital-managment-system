<?php
session_start();
include 'db_connection.php';

if (!isset($_SESSION['username'])) {
    // Redirect to login page if not logged in
    header('Location: login.php');
    exit();
}

$username = $_SESSION['username'];

// Fetch admin details using the username
$sql = "SELECT id, username, email, fullname, phone, address FROM admins WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $adminDetails = $result->fetch_assoc();
} else {
    echo "Admin details not found.";
    exit();
}

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Hospital Management System</title>
    <link rel="stylesheet" href="styles.css">
    <style>
       /* Add your CSS styles here */
body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    background-color: #f4f6f9;
    color: #333;
}
header {
    background-color: #0056a6;
    padding: 20px;
    color: white;
    text-align: center;
    position: relative;
}
.logout-btn {
    position: absolute;
    top: 20px;
    right: 20px;
    background-color: #cc0000;
    color: white;
    border: none;
    padding: 10px 20px;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}
.logout-btn:hover {
    background-color: #990000;
}
.container {
    padding: 20px;
    max-width: 1200px;
    margin: auto;
}
.admin-details {
    background-color: white;
    padding: 20px;
    margin-bottom: 20px;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}
.admin-details table {
    width: 100%;
    border-collapse: collapse;
}
.admin-details th, .admin-details td {
    padding: 12px;
    border: 1px solid #ddd;
}
.admin-details th {
    background-color: #f2f2f2;
    width: 20%;
}
.boxes {
    display: flex;
    justify-content: space-around;
    flex-wrap: wrap;
}
.box {
    width: 30%;
    padding: 20px;
    text-align: center;
    background-color: #fff;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    cursor: pointer;
    margin: 10px;
    border-radius: 10px;
    transition: background-color 0.3s ease;
    font-size: 1.2em;
}
.box:hover {
    background-color: #e0e0e0;
}
.card {
    background-color: white;
    padding: 20px;
    margin: 20px 0;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    overflow-x: auto; /* Added to allow horizontal scrolling */
}
.card h3 {
    margin-top: 0;
}
.card table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 10px; 
}
.card th, .card td {
    padding: 12px;
    border: 1px solid #ddd;
    text-align: left;
}
.card th {
    background-color: #f2f2f2;
}
.vertical-table {
     width: 100%;
}

.vertical-table th, .vertical-table td {
    padding: 12px;
    border: 1px solid #ddd;
    text-align: left; /* Ensure text alignment left */
}

.vertical-table th {
    background-color: #f2f2f2;
} 

    </style>
</head>
<body>
    <header>
        <h1>Welcome, <?php echo htmlspecialchars($username); ?>!</h1>
        <p>This is the admin dashboard.</p>
        <a href="logout.php" class="logout-btn">Logout</a>
    </header>
    <div class="container">
        <div class="admin-details">
            <h3>Your Details</h3>
            <table>
                <tr>
                    <th>ID</th>
                    <td><?php echo htmlspecialchars($adminDetails['id']); ?></td>
                </tr>
                <tr>
                    <th>Username</th>
                    <td><?php echo htmlspecialchars($adminDetails['username']); ?></td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td><?php echo htmlspecialchars($adminDetails['email']); ?></td>
                </tr>
                <tr>
                    <th>Full Name</th>
                    <td><?php echo htmlspecialchars($adminDetails['fullname']); ?></td>
                </tr>
                <tr>
                    <th>Phone</th>
                    <td><?php echo htmlspecialchars($adminDetails['phone']); ?></td>
                </tr>
                <tr>
                    <th>Address</th>
                    <td><?php echo htmlspecialchars($adminDetails['address']); ?></td>
                </tr>
            </table>
        </div>
        <div class="boxes">
            <div class="box" onclick="fetchData('users')">Get Users</div>
            <div class="box" onclick="fetchData('doctors')">Get Doctors</div>
            <div class="box" onclick="fetchData('appointments')">Get Appointments</div>
        </div>
        <div id="data-container" class="card"></div>
    </div>
    <script>
        function fetchData(type) {
            fetch('fetch_data.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: `type=${type}`
            })
            .then(response => response.text())
            .then(data => {
                document.getElementById('data-container').innerHTML = data;
            })
            .catch(error => console.error('Error:', error));
        }
    </script>
</body>
</html>

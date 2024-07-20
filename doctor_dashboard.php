<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['role'] !== 'doctor') {
    header('Location: login.php');
    exit();
}

include('db_connection.php');

// Fetch doctor information
$username = $_SESSION['username'];
$query = "SELECT * FROM doctors WHERE username = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();
$doctor = $result->fetch_assoc();

// Fetch appointments for the logged-in doctor
$today = date('Y-m-d');
$appointmentsQuery = "SELECT * FROM appointments WHERE doctor = ? AND date = ?";
$stmt = $conn->prepare($appointmentsQuery);
$stmt->bind_param("ss", $username, $today);
$stmt->execute();
$appointmentsResult = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor Dashboard - Hospital Management System</title>
    <link rel="stylesheet" href="styles.css">
    <style>
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
    padding: 10px 20px;
    color: white;
    display: flex;
    justify-content: center; /* Center the header content */
    align-items: center;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

header h1 {
    margin: 0;
    text-align: center; /* Ensure the text is centered */
}

.logout-button {
    background-color: #e74c3c;
    color: white;
    border: none;
    padding: 10px 20px;
    border-radius: 5px;
    cursor: pointer;
    text-decoration: none;
    font-size: 16px;
    transition: background-color 0.3s ease;
    position: absolute; /* Position absolute for logout button */
    right: 20px; /* Align it to the right */
}

.logout-button:hover {
    background-color: #c0392b;
}

        nav ul {
            list-style-type: none;
            padding: 0;
            display: flex;
            justify-content: center;
            margin: 0;
            background-color: #0056a6;
        }

        nav ul li {
            margin: 0 15px;
        }

        nav ul li a {
            color: white;
            text-decoration: none;
            font-size: 18px;
            transition: color 0.3s ease;
        }

        nav ul li a:hover {
            color: #ffde00;
        }

        .dashboard-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 20px;
        }

        .dashboard-box {
            background-color: white;
            padding: 20px;
            margin: 20px 0;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 80%;
            max-width: 800px;
        }

        .dashboard-box h2 {
            margin-top: 0;
            color: #0056a6;
            text-align: center;
            border-bottom: 2px solid #0056a6;
            padding-bottom: 10px;
        }

        .dashboard-box table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .dashboard-box table, th, td {
            border: 1px solid #ccc;
        }

        .dashboard-box th, td {
            padding: 12px;
            text-align: left;
        }

        .dashboard-box th {
            background-color: #0056a6;
            color: white;
        }

        .dashboard-box td {
            background-color: #f9f9f9;
        }

        @media (max-width: 600px) {
            .dashboard-box {
                width: 90%;
            }

            nav ul li {
                margin: 0 10px;
            }

            nav ul li a {
                font-size: 16px;
            }

            .dashboard-box h2 {
                font-size: 24px;
            }

            .dashboard-box th, td {
                padding: 8px;
            }
        }
    </style>
</head>
<body>
    <header>
        <h1>Welcome to Doctor Dashboard</h1>
        <a href="logout.php" class="logout-button">Logout</a>
    </header>
    <nav>
        <ul>
            <li><a href="doctor_dashboard.php">Dashboard</a></li>
        </ul>
    </nav>
    <div class="dashboard-container">
        <div class="dashboard-box">
            <h2>Doctor Profile</h2>
            <table>
                <tr>
                    <th>Username</th>
                    <td><?php echo htmlspecialchars($doctor['username']); ?></td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td><?php echo htmlspecialchars($doctor['email']); ?></td>
                </tr>
                <tr>
                    <th>Full Name</th>
                    <td><?php echo htmlspecialchars($doctor['fullname']); ?></td>
                </tr>
                <tr>
                    <th>Phone</th>
                    <td><?php echo htmlspecialchars($doctor['phone']); ?></td>
                </tr>
                <tr>
                    <th>Address</th>
                    <td><?php echo htmlspecialchars($doctor['address']); ?></td>
                </tr>
            </table>
        </div>

        <div class="dashboard-box">
            <h2>Today's Appointments</h2>
            <table>
                <tr>
                    <th>Patient Name</th>
                    <th>Email Address</th>
                    <th>Phone Number</th>
                    <th>Age</th>
                    <th>Gender</th>
                    <th>Date of Appointment</th>
                    <th>Preferred Time</th>
                    <th>Reason for Appointment</th>
                    <th>Address</th>
                </tr>
                <?php while ($appointment = $appointmentsResult->fetch_assoc()): ?>
                <tr>
                    <td><?php echo htmlspecialchars($appointment['patientName']); ?></td>
                    <td><?php echo htmlspecialchars($appointment['email']); ?></td>
                    <td><?php echo htmlspecialchars($appointment['phone']); ?></td>
                    <td><?php echo htmlspecialchars($appointment['age']); ?></td>
                    <td><?php echo htmlspecialchars($appointment['gender']); ?></td>
                    <td><?php echo htmlspecialchars($appointment['date']); ?></td>
                    <td><?php echo htmlspecialchars($appointment['time']); ?></td>
                    <td><?php echo htmlspecialchars($appointment['reason']); ?></td>
                    <td><?php echo htmlspecialchars($appointment['address']); ?></td>
                </tr>
                <?php endwhile; ?>
            </table>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', (event) => {
            console.log('Doctor Dashboard Loaded');
            alert('Welcome, <?php echo htmlspecialchars($doctor["fullname"]); ?>');
        });
    </script>
</body>
</html>

<?php
$stmt->close();
$conn->close();
?>

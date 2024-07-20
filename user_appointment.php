<?php
// Database connection (require_once ensures it's loaded only once)
require_once 'db_connection.php';

// Fetch all appointments from the database
$sql = "SELECT * FROM appointments";
$result = $conn->query($sql);

// Check if appointments exist
$appointments = [];
if ($result->num_rows > 0) {
    // Fetching all rows into an associative array
    while ($row = $result->fetch_assoc()) {
        $appointments[] = $row;
    }
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>User Appointments</title>
  <link rel="stylesheet" href="styles.css">
  <style>
    /* Additional styles specific to this page */
    body {
      background-color: #f0f8ff; /* Light blue background */
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
    }
    .container {
      max-width: 800px;
      margin: 20px auto;
      padding: 20px;
      background-color: #ffffff; /* White background */
      border-radius: 8px;
      box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
    }
    h1 {
      color: #2c3e50; /* Dark blue heading */
      text-align: center;
    }
    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 20px;
    }
    table, th, td {
      border: 1px solid #bdc3c7; /* Light grey border */
    }
    th, td {
      padding: 10px;
      text-align: left;
    }
    th {
      background-color: #3498db; /* Blue header */
      color: white;
    }
    tr:nth-child(even) {
      background-color: #ecf0f1; /* Light grey alternate row */
    }
    .btn-container {
      margin-top: 20px;
      text-align: center;
    }
    .dashboard-btn {
      display: inline-block;
      padding: 10px 20px;
      background-color: #27ae60; /* Green button */
      color: white;
      text-decoration: none;
      border-radius: 4px;
      transition: background-color 0.3s ease;
    }
    .dashboard-btn:hover {
      background-color: #218c4d; /* Darker green on hover */
    }
  </style>
</head>
<body>
  <div class="container">
    <h1>User Appointments</h1>
    
    <?php if (!empty($appointments)): ?>
      <table>
        <thead>
          <tr>
            <th>Appointment ID</th>
            <th>Patient Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Date</th>
            <th>Time</th>
            <th>Doctor</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($appointments as $appointment): ?>
            <tr>
              <td><?php echo htmlspecialchars($appointment['id']); ?></td>
              <td><?php echo htmlspecialchars($appointment['patientName']); ?></td>
              <td><?php echo htmlspecialchars($appointment['email']); ?></td>
              <td><?php echo htmlspecialchars($appointment['phone']); ?></td>
              <td><?php echo htmlspecialchars($appointment['date']); ?></td>
              <td><?php echo htmlspecialchars($appointment['time']); ?></td>
              <td><?php echo htmlspecialchars($appointment['doctor']); ?></td>
              <td><a href="admin_dashboard.php" class="dashboard-btn">Go to Dashboard</a></td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    <?php else: ?>
      <p>No appointments found.</p>
    <?php endif; ?>

    <div class="btn-container">
      <a href="admin_dashboard.php" class="dashboard-btn">Go to Dashboard</a>
    </div>
  </div>
</body>
</html>

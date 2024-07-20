<?php
include 'db_connection.php';

$type = $_POST['type'] ?? '';

switch ($type) {
    case 'users':
        $usersSql = "SELECT id, username, email, fullname, phone, address FROM users";
        $usersResult = $conn->query($usersSql);

        if ($usersResult->num_rows > 0) {
            echo "<div class='card'>
                    <h3>Users</h3>
                    <table class='vertical-table'>
                        <tr><th>ID</th><th>Username</th><th>Email</th><th>Full Name</th><th>Phone</th><th>Address</th></tr>";
            while ($row = $usersResult->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['id']}</td>
                        <td>{$row['username']}</td>
                        <td>{$row['email']}</td>
                        <td>{$row['fullname']}</td>
                        <td>{$row['phone']}</td>
                        <td>{$row['address']}</td>
                      </tr>";
            }
            echo "</table></div>";
        } else {
            echo "<p>No users found.</p>";
        }
        break;

    case 'doctors':
        $doctorsSql = "SELECT id, username, email, fullname, phone, address FROM doctors";
        $doctorsResult = $conn->query($doctorsSql);

        if ($doctorsResult->num_rows > 0) {
            echo "<div class='card'>
                    <h3>Doctors</h3>
                    <table class='vertical-table'>
                        <tr><th>ID</th><th>Username</th><th>Email</th><th>Full Name</th><th>Phone</th><th>Address</th></tr>";
            while ($row = $doctorsResult->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['id']}</td>
                        <td>{$row['username']}</td>
                        <td>{$row['email']}</td>
                        <td>{$row['fullname']}</td>
                        <td>{$row['phone']}</td>
                        <td>{$row['address']}</td>
                      </tr>";
            }
            echo "</table></div>";
        } else {
            echo "<p>No doctors found.</p>";
        }
        break;

    case 'appointments':
        $appointmentsSql = "SELECT id, patientname AS patient_name, email AS patient_email, phone AS patient_phone, age, gender, date, time, reason, address AS patient_address, doctor, created_at, aadhaar_number
                            FROM appointments";
        $appointmentsResult = $conn->query($appointmentsSql);

        if ($appointmentsResult->num_rows > 0) {
            echo "<div class='card'>
                    <h3>Appointments</h3>
                    <table class='vertical-table'>
                        <tr><th>ID</th><th>Patient Name</th><th>Email</th><th>Phone</th><th>Age</th><th>Gender</th><th>Date</th><th>Time</th><th>Reason</th><th>Address</th><th>Doctor</th><th>Created At</th><th>Aadhaar Number</th></tr>";
            while ($row = $appointmentsResult->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['id']}</td>
                        <td>{$row['patient_name']}</td>
                        <td>{$row['patient_email']}</td>
                        <td>{$row['patient_phone']}</td>
                        <td>{$row['age']}</td>
                        <td>{$row['gender']}</td>
                        <td>{$row['date']}</td>
                        <td>{$row['time']}</td>
                        <td>{$row['reason']}</td>
                        <td>{$row['patient_address']}</td>
                        <td>{$row['doctor']}</td>
                        <td>{$row['created_at']}</td>
                        <td>{$row['aadhaar_number']}</td>
                      </tr>";
            }
            echo "</table></div>";
        } else {
            echo "<p>No appointments found.</p>";
        }
        break;

    default:
        echo "<p>Invalid request.</p>";
}

$conn->close();
?>

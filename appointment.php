<?php
$appointmentSuccess = false;
$formData = [];
$selectedDoctor = '';

// Database connection
require_once 'db_connection.php';

// Check if a doctor name is passed via query parameter
if (isset($_GET['doctor'])) {
    $selectedDoctor = $_GET['doctor'];
    $doctorPredefined = true;
} else {
    $doctorPredefined = false;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $formData['patientName'] = $_POST['patientName'];
    $formData['email'] = $_POST['email'];
    $formData['phone'] = $_POST['phone'];
    $formData['aadhaar_number'] = $_POST['aadhaar_number'];
    $formData['age'] = $_POST['age'];
    $formData['gender'] = $_POST['gender'];
    $formData['date'] = $_POST['date'];
    $formData['time'] = $_POST['time'];
    $formData['reason'] = $_POST['reason'];
    $formData['address'] = $_POST['address'];
    
    if (isset($_POST['doctorOption']) && $_POST['doctorOption'] == 'select') {
        $formData['doctor'] = $_POST['doctor_select'];
    } else {
        $formData['doctor'] = $_POST['doctor_entered'];
    }

    // SQL query to insert data into appointments table
    $sql = "INSERT INTO appointments (patientName, email, phone, aadhaar_number, age, gender, date, time, reason, address, doctor) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    
    // Prepare and bind parameters
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssisisssss", 
                      $formData['patientName'], 
                      $formData['email'], 
                      $formData['phone'], 
                      $formData['aadhaar_number'], 
                      $formData['age'], 
                      $formData['gender'], 
                      $formData['date'], 
                      $formData['time'], 
                      $formData['reason'], 
                      $formData['address'], 
                      $formData['doctor']);
    
    // Execute query
    if ($stmt->execute()) {
        $appointmentSuccess = true;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    
    // Close statement and connection
    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Doctor Appointment Form</title>
  <style>
   body {
    font-family: Arial, sans-serif;
    background-color: #e0f7fa; /* Light cyan background for a hospital theme */
    margin: 0;
    padding: 20px; /* Added padding for spacing */
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
}

#appointment-form-container {
    background-color: #ffffff;
    padding: 30px; /* Increased padding for more spacing */
    border-radius: 10px; /* Slightly rounded corners */
    box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
    width: 500px; /* Increased width for better spacing */
    max-height: 90vh;
    overflow-y: auto;
}

#appointment-form-container h1 {
    text-align: center;
    color: #00796b; /* Teal color for heading */
    margin-bottom: 25px; /* Increased margin for better spacing */
}

.form-group {
    margin-bottom: 20px; /* Increased margin for more spacing between fields */
}

.form-group label {
    display: block;
    font-weight: bold;
    margin-bottom: 8px; /* Slightly increased margin for label */
    color: #00796b; /* Teal color for labels */
}

.form-group input, .form-group select, .form-group textarea {
    width: 100%;
    padding: 10px; /* Increased padding for inputs */
    border: 1px solid #cccccc;
    border-radius: 5px; /* Slightly more rounded inputs */
}

.form-group textarea {
    resize: vertical;
}

.gender-options {
    display: flex;
    gap: 15px; /* Increased gap between gender options */
}

.form-group button {
    width: 48%;
    padding: 12px; /* Increased padding for buttons */
    border: none;
    border-radius: 5px; /* Slightly more rounded buttons */
    background-color: #007bff; /* Blue color for submit button */
    color: white;
    cursor: pointer;
}

.form-group button[type="reset"] {
    background-color: #6c757d; /* Gray color for reset button */
}

.form-group button:hover {
    opacity: 0.9;
}

#success-container {
    text-align: center;
}

.details {
    margin: 15px 0; /* Increased margin for details */
}

.details label {
    font-weight: bold;
}

.btn-container {
    margin-top: 25px; /* Increased margin for better spacing */
}

.dashboard-btn {
    display: inline-block;
    padding: 12px 25px; /* Increased padding for button */
    background-color: #28a745; /* Green color for dashboard button */
    color: white;
    text-decoration: none;
    border-radius: 5px; /* Slightly more rounded button */
    transition: background-color 0.3s ease;
}

.dashboard-btn:hover {
    background-color: #218838;
}

  </style>
</head>
<body>
  <div id="appointment-form-container">
    <?php if ($appointmentSuccess): ?>
      <div id="success-container">
        <h1>Appointment Successful</h1>
        <div class="details">
            <label>Patient Name: </label> <?php echo htmlspecialchars($formData['patientName']); ?>
        </div>
        <div class="details">
            <label>Email Address: </label> <?php echo htmlspecialchars($formData['email']); ?>
        </div>
        <div class="details">
            <label>Phone Number: </label> <?php echo htmlspecialchars($formData['phone']); ?>
        </div>
        <div class="details">
            <label>Aadhaar Number: </label> <?php echo htmlspecialchars($formData['aadhaar_number']); ?>
        </div>
        <div class="details">
            <label>Age: </label> <?php echo htmlspecialchars($formData['age']); ?>
        </div>
        <div class="details">
            <label>Gender: </label> <?php echo htmlspecialchars($formData['gender']); ?>
        </div>
        <div class="details">
            <label>Date of Appointment: </label> <?php echo htmlspecialchars($formData['date']); ?>
        </div>
        <div class="details">
            <label>Preferred Time: </label> <?php echo htmlspecialchars($formData['time']); ?>
        </div>
        <div class="details">
            <label>Reason for Appointment: </label> <?php echo htmlspecialchars($formData['reason']); ?>
        </div>
        <div class="details">
            <label>Address: </label> <?php echo htmlspecialchars($formData['address']); ?>
        </div>
        <div class="details">
            <label>Doctor: </label> <?php echo htmlspecialchars($formData['doctor']); ?>
        </div>
        <div class="btn-container">
            <a href="user_dashboard.php" class="dashboard-btn">Go to Dashboard</a>
        </div>
      </div>
    <?php else: ?>
      <h1>Book Your Appointment</h1>
      <form id="appointment-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" onsubmit="return validateForm()">
        <div class="form-group">
          <label for="doctor-option">Doctor:</label>
          <?php if ($doctorPredefined): ?>
            <input type="text" id="doctor-entered" name="doctor_entered" value="<?php echo htmlspecialchars($selectedDoctor); ?>" readonly>
          <?php else: ?>
            <input type="radio" id="select-doctor" name="doctorOption" value="select" onclick="toggleDoctorInput()" checked> Select a Doctor
            <input type="radio" id="enter-doctor" name="doctorOption" value="enter" onclick="toggleDoctorInput()"> Enter Doctor's Name
            <div class="form-group" id="doctor-select">
              <label for="doctor_select">Select Doctor:</label>
              <select id="doctor_select" name="doctor_select">
                <option value="">-- Select a Doctor --</option>
                <option value="Dr. John Doe">Dr. John Doe</option>
                <option value="Dr. Jane Smith">Dr. Jane Smith</option>
                <option value="Dr. Michael Lee">Dr. Michael Lee</option>
                <option value="Dr. Emily Johnson">Dr. Emily Johnson</option>
              </select>
            </div>
            <div class="form-group" id="doctor-input" style="display: none;">
              <label for="doctor-entered">Enter Doctor's Name:</label>
              <input type="text" id="doctor-entered" name="doctor_entered" value="">
            </div>
          <?php endif; ?>
        </div>
        <div class="form-group">
          <label for="patient-name">Patient Name:</label>
          <input type="text" id="patient-name" name="patientName" required>
        </div>
        <div class="form-group">
          <label for="email">Email Address:</label>
          <input type="email" id="email" name="email" required>
        </div>
        <div class="form-group">
          <label for="phone">Phone Number:</label>
          <input type="tel" id="phone" name="phone" required>
        </div>
        <div class="form-group">
          <label for="aadhaar_number">Aadhaar Number:</label>
          <input type="text" id="aadhaar_number" name="aadhaar_number" required>
        </div>
        <div class="form-group">
          <label for="age">Age:</label>
          <input type="number" id="age" name="age" required>
        </div>
        <div class="form-group">
          <label for="gender">Gender:</label>
          <div class="gender-options">
            <input type="radio" id="gender-male" name="gender" value="Male">
            <label for="gender-male">Male</label>
            <input type="radio" id="gender-female" name="gender" value="Female">
            <label for="gender-female">Female</label>
          </div>
        </div>
        <div class="form-group">
          <label for="date">Date of Appointment:</label>
          <input type="date" id="date" name="date" required>
        </div>
        <div class="form-group">
          <label for="time">Preferred Time:</label>
          <input type="time" id="time" name="time" required>
        </div>
        <div class="form-group">
          <label for="reason">Reason for Appointment:</label>
          <textarea id="reason" name="reason" rows="3" required></textarea>
        </div>
        <div class="form-group">
          <label for="address">Address:</label>
          <input type="text" id="address" name="address" required>
        </div>
        <div class="form-group">
          <button type="submit">Submit Appointment</button>
          <button type="reset">Reset Form</button>
        </div>
        <div class="btn-container">
            <a href="user_dashboard.php" class="dashboard-btn">Go to Dashboard</a>
        </div>
      </form>
    <?php endif; ?>
  </div>
  <script>
    function toggleDoctorInput() {
      const doctorSelect = document.getElementById('doctor-select');
      const doctorInput = document.getElementById('doctor-input');
      const selectDoctor = document.getElementById('select-doctor');

      if (selectDoctor.checked) {
        doctorSelect.style.display = 'block';
        doctorInput.style.display = 'none';
      } else {
        doctorSelect.style.display = 'none';
        doctorInput.style.display = 'block';
      }
    }

    function validateForm() {
      const name = document.getElementById('patient-name').value;
      const email = document.getElementById('email').value;
      const phone = document.getElementById('phone').value;
      const aadhaar_number = document.getElementById('aadhaar_number').value;
      const age = document.getElementById('age').value;
      const genderMale = document.getElementById('gender-male').checked;
      const genderFemale = document.getElementById('gender-female').checked;
      const date = document.getElementById('date').value;
      const time = document.getElementById('time').value;
      const reason = document.getElementById('reason').value;
      const address = document.getElementById('address').value;

      const selectDoctor = document.getElementById('select-doctor').checked;
      const doctor = selectDoctor ? document.getElementById('doctor_select').value : document.getElementById('doctor-entered').value;

      if (name === "" || email === "" || phone === "" || aadhaar_number === "" || age === "" || (!genderMale && !genderFemale) || date === "" || time === "" || reason === "" || address === "") {
        alert("Please fill out all required fields.");
        return false;
      }

      return true;
    }

    // Call the function initially to set the correct display state
    toggleDoctorInput();
  </script>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup - Hospital Management System</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            background-color: #f4f6f9;
            color: #333;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        header {
            background-color: #0056a6;
            padding: 10px 0;
        }

        nav ul {
            list-style-type: none;
            padding: 0;
            display: flex;
            justify-content: center;
            margin: 0;
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

        .signup-page {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f0f0f0;
        }

        .signup-box {
            background-color: white;
            padding: 50px;
            margin: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 700px;
            max-width: 600px;
            flex: 1;
        }

        .signup-box h2 {
            margin-top: 75px;
            color: #0056a6;
            text-align: center;
        }

        .signup-box form {
            display: flex;
            flex-direction: column;
        }

        .signup-box label {
            margin-top: 20px;
            color: #666;
        }

        .signup-box input {
            padding: 12px;
            margin-top: 8px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
            width: calc(100% - 26px); /* Adjust width to account for padding and border */
        }

        .signup-box .password-container {
            position: relative;
            width: 100%;
        }

        .signup-box .password-container input {
            width: calc(100% - 50px); /* Adjust width to account for padding, border, and toggle button */
            padding-right: 50px;
        }

        .signup-box .password-container .toggle-password {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #666;
        }

        .signup-box button {
            padding: 12px;
            margin-top: 30px;
            background-color: #0056a6;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .signup-box button:hover {
            background-color: #004080;
        }

        .signup-options {
            margin-top: 10px;
            text-align: center;
        }

        .signup-options a {
            color: #0056a6;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .signup-options a:hover {
            color: #004080;
        }

        @media (max-width: 768px) {
            .signup-box {
                width: 60%;
            }
        }

        @media (max-width: 480px) {
            .signup-box {
                width: 90%;
            }
        }
    </style>
    <script>
        function validateSignupForm() {
            let username = document.getElementById('signup-username').value;
            let email = document.getElementById('signup-email').value;
            let password = document.getElementById('signup-password').value;
            let fullname = document.getElementById('signup-fullname').value;
            let phone = document.getElementById('signup-phone').value;
            let address = document.getElementById('signup-address').value;

            let usernameValid = username.length >= 5 && username.length <= 20;
            let emailValid = /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
            let passwordValid = password.length >= 8 && /[A-Z]/.test(password) && /[a-z]/.test(password) && /\d/.test(password);
            let fullnameValid = fullname.trim() !== "";
            let phoneValid = /^\d{10}$/.test(phone);
            let addressValid = address.trim() !== "";

            if (!usernameValid) {
                alert("Username must be between 5 and 20 characters.");
                return false;
            }

            if (!emailValid) {
                alert("Please enter a valid email address.");
                return false;
            }

            if (!passwordValid) {
                alert("Password must be at least 8 characters long, contain at least one uppercase letter, one lowercase letter, and one number.");
                return false;
            }

            if (!fullnameValid) {
                alert("Full Name must be filled out.");
                return false;
            }

            if (!phoneValid) {
                alert("Phone Number must be a 10-digit number.");
                return false;
            }

            if (!addressValid) {
                alert("Address must be filled out.");
                return false;
            }

            return true;
        }

        function togglePasswordVisibility() {
            const passwordField = document.getElementById('signup-password');
            const togglePassword = document.querySelector('.toggle-password');
            const type = passwordField.type === 'password' ? 'text' : 'password';
            passwordField.type = type;
            togglePassword.textContent = type === 'password' ? 'Show' : 'Hide';
        }
    </script>
</head>
<body>
    <main class="signup-page">
        <div class="signup-box">
            <?php
                if (isset($_GET['userType']) && $_GET['userType'] === 'admin') {
                    echo "<h2>Admin Signup</h2>";
                    echo '<form id="admin-signup-form" action="signup_processing.php" method="POST" onsubmit="return validateSignupForm()">';
                    echo '<input type="hidden" name="userType" value="admin">';
                } elseif (isset($_GET['userType']) && $_GET['userType'] === 'doctor') {
                    echo "<h2>Doctor Signup</h2>";
                    echo '<form id="doctor-signup-form" action="signup_processing.php" method="POST" onsubmit="return validateSignupForm()">';
                    echo '<input type="hidden" name="userType" value="doctor">';
                } else {
                    echo "<h2>Patient Signup</h2>";
                    echo '<form id="patient-signup-form" action="signup_processing.php" method="POST" onsubmit="return validateSignupForm()">';
                    echo '<input type="hidden" name="userType" value="user">';
                }
            ?>
                <label for="signup-username">Username</label>
                <input type="text" id="signup-username" name="username">
                <label for="signup-email">Email</label>
                <input type="email" id="signup-email" name="email">
                <label for="signup-password">Password</label>
                <div class="password-container">
                    <input type="password" id="signup-password" name="password">
                    <span class="toggle-password" onclick="togglePasswordVisibility()">Show</span>
                </div>
                <label for="signup-fullname">Full Name</label>
                <input type="text" id="signup-fullname" name="fullname">
                <label for="signup-phone">Phone Number</label>
                <input type="tel" id="signup-phone" name="phone">
                <label for="signup-address">Address</label>
                <input type="text" id="signup-address" name="address">
                <button type="submit">Signup</button>
                <div class="signup-options">
                    <a href="login.php">Login</a>
                </div>
            </form>
        </div>
    </main>
</body>
</html>

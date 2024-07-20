<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Hospital Management System</title>
    <link rel="stylesheet" href="styles.css">
    <script>
        function validateForm(userType) {
            let username = document.getElementById(`${userType}-username`).value;
            let password = document.getElementById(`${userType}-password`).value;
            let usernameValid = username.length >= 5 && username.length <= 20;
            let passwordValid = password.length >= 8 && /[A-Z]/.test(password);

            if (!usernameValid) {
                alert("Username must be between 5 and 20 characters.");
                return false;
            }

            if (!passwordValid) {
                alert("Password must be at least 8 characters long and contain at least one uppercase letter.");
                return false;
            }

            if (username === "" || password === "") {
                alert("Username and Password must be filled out");
                return false;
            }

            return true;
        }

        function showInvalidCredentials() {
            alert("Invalid credentials. Please try again.");
        }

        function togglePasswordVisibility(userType) {
            const passwordField = document.getElementById(`${userType}-password`);
            const togglePassword = document.querySelector(`.${userType}-toggle-password`);
            const type = passwordField.type === 'password' ? 'text' : 'password';
            passwordField.type = type;
            togglePassword.textContent = type === 'password' ? 'Show' : 'Hide';
        }
    </script>
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

        .login-page {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f0f0f0;
        }

        .login-box {
            background-color: white;
            padding: 40px;
            margin: 0 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 30%;
            min-width: 300px;
            flex: 1;
        }

        .login-box h2 {
            margin-top: 0;
            color: #0056a6;
            text-align: center;
        }

        .login-box form {
            display: flex;
            flex-direction: column;
        }

        .login-box label {
            margin-top: 20px;
            color: #666;
        }

        .login-box input {
            padding: 12px;
            margin-top: 8px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
            width: calc(100% - 26px); /* Adjust width to account for padding and border */
        }

        .password-container {
            position: relative;
            width: 100%;
        }

        .password-container input {
            width: calc(100% - 50px); /* Adjust width to account for padding, border, and toggle button */
            padding-right: 50px;
        }

        .password-container .toggle-password {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #666;
        }

        .login-box button {
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

        .login-box button:hover {
            background-color: #004080;
        }

        .login-options {
            margin-top: 10px;
            text-align: center;
        }

        .login-options a {
            color: #0056a6;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .login-options a:hover {
            color: #004080;
        }

        @media (max-width: 768px) {
            .login-box {
                width: 60%;
            }
        }

        @media (max-width: 480px) {
            .login-box {
                width: 90%;
            }
        }
    </style>
</head>
<body>
<main class="login-page">
    <div class="login-box">
        <h2>Admin Login</h2>
        <form id="admin-login-form" action="login_processing.php" method="POST" onsubmit="return validateForm('admin')">
            <input type="hidden" name="userType" value="admin">
            <label for="admin-username">Username</label>
            <input type="text" id="admin-username" name="username">
            <label for="admin-password">Password</label>
            <div class="password-container">
                <input type="password" id="admin-password" name="password">
                <span class="toggle-password admin-toggle-password" onclick="togglePasswordVisibility('admin')">Show</span>
            </div>
            <button type="submit" class="admin-button">Login</button>
            <div class="login-options">
                <a href="signup.php?userType=admin">Signup</a> | <a href="#">Forgot Password?</a>
            </div>
        </form>
    </div>
    <div class="login-box">
        <h2>Doctor Login</h2>
        <form id="doctor-login-form" action="login_processing.php" method="POST" onsubmit="return validateForm('doctor')">
            <input type="hidden" name="userType" value="doctor">
            <label for="doctor-username">Username</label>
            <input type="text" id="doctor-username" name="username">
            <label for="doctor-password">Password</label>
            <div class="password-container">
                <input type="password" id="doctor-password" name="password">
                <span class="toggle-password doctor-toggle-password" onclick="togglePasswordVisibility('doctor')">Show</span>
            </div>
            <button type="submit" class="doctor-button">Login</button>
            <div class="login-options">
                <a href="signup.php?userType=doctor">Signup</a> | <a href="#">Forgot Password?</a>
            </div>
        </form>
    </div>
    <div class="login-box">
        <h2>Patient Login</h2>
        <form id="patient-login-form" action="login_processing.php" method="POST" onsubmit="return validateForm('patient')">
            <input type="hidden" name="userType" value="user">
            <label for="patient-username">Username</label>
            <input type="text" id="patient-username" name="username">
            <label for="patient-password">Password</label>
            <div class="password-container">
                <input type="password" id="patient-password" name="password">
                <span class="toggle-password patient-toggle-password" onclick="togglePasswordVisibility('patient')">Show</span>
            </div>
            <button type="submit" class="user-button">Login</button>
            <div class="login-options">
                <a href="signup.php?userType=user">Signup</a> | <a href="#">Forgot Password?</a>
            </div>
        </form>
    </div>
</main>
<?php
    if (isset($_GET['error'])) {
        echo "<script>showInvalidCredentials();</script>";
    }
?>
</body>
</html>

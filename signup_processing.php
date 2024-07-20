<?php
session_start();
include('db_connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);
        $fullname = mysqli_real_escape_string($conn, $_POST['fullname']);
        $phone = mysqli_real_escape_string($conn, $_POST['phone']);
        $address = mysqli_real_escape_string($conn, $_POST['address']);
        $userType = mysqli_real_escape_string($conn, $_POST['userType']);
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        if ($userType === 'admin') {
            $table = 'admins';
            $role = 'admin';
        } elseif ($userType === 'doctor') {
            $table = 'doctors';
            $role = 'doctor';
        } else {
            $table = 'users';
            $role = 'user';
        }

        // Check if username already exists
        $stmt = $conn->prepare("SELECT id FROM $table WHERE username = ?");
        if (!$stmt) {
            throw new Exception("Prepare statement failed: " . $conn->error);
        }
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            // Username already exists
            $stmt->close();
            header("Location: signup.php?userType=$userType&error=Username already taken");
            exit();
        } else {
            // Insert new user
            $stmt->close();
            $stmt = $conn->prepare("INSERT INTO $table (username, email, password, fullname, phone, address, role) VALUES (?, ?, ?, ?, ?, ?, ?)");
            if (!$stmt) {
                throw new Exception("Prepare statement failed: " . $conn->error);
            }
            $stmt->bind_param("sssssss", $username, $email, $hashed_password, $fullname, $phone, $address, $role);

            if ($stmt->execute()) {
                // Successful signup
                $_SESSION['username'] = $username;
                $_SESSION['role'] = $role;
                $_SESSION['loggedin'] = true;
                if ($role === 'admin') {
                    header("Location: admin_dashboard.php");
                } elseif ($role === 'doctor') {
                    header("Location: doctor_dashboard.php");
                } else {
                    header("Location: user_dashboard.php");
                }
                exit();
            } else {
                throw new Exception("Signup failed: " . $stmt->error);
            }
        }
    } catch (Exception $e) {
        header("Location: signup.php?userType=$userType&error=" . urlencode($e->getMessage()));
        exit();
    } finally {
        if (isset($stmt) && $stmt->open) {
            $stmt->close();
        }
        $conn->close();
    }
}
?>

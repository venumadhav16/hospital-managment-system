<?php
session_start();
include('db_connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $userType = mysqli_real_escape_string($conn, $_POST['userType']);

    if ($userType === 'admin') {
        $table = 'admins';
    } elseif ($userType === 'doctor') {
        $table = 'doctors';
    } else {
        $table = 'users';
    }

    $stmt = $conn->prepare("SELECT id, password, role FROM $table WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();
    
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $hashed_password, $role);
        $stmt->fetch();
        
        if (password_verify($password, $hashed_password)) {
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
            header("Location: login.php?error=Invalid credentials");
            exit();
        }
    } else {
        header("Location: login.php?error=Invalid credentials");
        exit();
    }

    $stmt->close();
    $conn->close();
}
?>

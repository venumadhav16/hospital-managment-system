<?php
// users.php
include 'db_connection.php';

// Fetch users data
$sql = "SELECT * FROM users";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User List - Hospital Management System</title>
    <style>
        /* styles.css */
body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f9;
    color: #333;
    margin: 0;
    padding: 0;
}

header {
    background-color: #4CAF50;
    color: white;
    padding: 10px 0;
    text-align: center;
}

header h1 {
    margin: 0;
}

nav {
    margin-top: 10px;
}

nav .button {
    background-color: #fff;
    color: #4CAF50;
    padding: 10px 20px;
    text-decoration: none;
    border-radius: 5px;
    border: 2px solid #4CAF50;
    transition: background-color 0.3s, color 0.3s;
}

nav .button:hover {
    background-color: #4CAF50;
    color: #fff;
}

main {
    padding: 20px;
}

h2 {
    text-align: center;
    margin-top: 0;
}

table.user-table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}

table.user-table th, table.user-table td {
    border: 1px solid #ddd;
    padding: 8px;
    text-align: center;
}

table.user-table th {
    background-color: #4CAF50;
    color: white;
}

table.user-table tr:nth-child(even) {
    background-color: #f2f2f2;
}

table.user-table tr:hover {
    background-color: #ddd;
}
</style>
</head>
<body>
    <header>
        <h1>Hospital Management System</h1>
        <nav>
            <a href="admin_dashboard.php" class="button">Dashboard</a>
        </nav>
    </header>
    <main>
        <h2>User List</h2>
        <table class="user-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>password</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>" . $row["id"]. "</td>
                                <td>" . $row["username"]. "</td>
                                <td>" . $row["email"]. "</td>
                                <td>" . $row["password"]. "</td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>No users found</td></tr>";
                }
                $conn->close();
                ?>
            </tbody>
        </table>
    </main>
</body>
</html>

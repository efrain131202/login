<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('HTTP/1.1 405 Method Not Allowed');
    exit(json_encode(['error' => 'Method Not Allowed']));
}

if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Aquí debes configurar los detalles de tu base de datos
    $host = 'localhost';
    $user = 'root';
    $pass = 'password';
    $db = 'database';

    $conn = new mysqli($host, $user, $pass, $db);

    if ($conn->connect_error) {
        header('HTTP/1.1 500 Internal Server Error');
        exit(json_encode(['error' => 'Database connection failed']));
    }

    $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $_SESSION['username'] = $username;
        exit(json_encode(['success' => true]));
    } else {
        header('HTTP/1.1 401 Unauthorized');
        exit(json_encode(['error' => 'Invalid login credentials']));
    }

    $conn->close();
} else {
    header('HTTP/1.1 400 Bad Request');
    exit(json_encode(['error' => 'Missing username or password']));
}
?>


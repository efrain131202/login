<?php
session_start();

if (isset($_POST['username']) && isset($_POST['password'])) {
	$username = $_POST['username'];
	$password = $_POST['password'];

	$host = 'localhost';
	$user = 'root';
	$pass = 'root';
	$db = 'users';

	$conn = new mysqli($host, $user, $pass, $db);

	if ($conn->connect_error) {
		die('Connection failed: ' . $conn->connect_error);
	}

	$sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
	$result = $conn->query($sql);

	if ($result->num_rows == 1) {
		$_SESSION['username'] = $username;
		echo 'success';
	} else {
		echo 'error';
	}

	$conn->close();
}
?>

<?php
	include_once('./connect.php');
	session_start();
	$id = $_SESSION['user']['id'];
	mysqli_query($connect, "UPDATE users SET Token = NULL WHERE id = '$id'");
	unset($_SESSION['user']);
	header('Location: ../login.php');
?>
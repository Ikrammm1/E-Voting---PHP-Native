<?php
	include 'includes/session.php';

	if(isset($_POST['edit'])){
		$id = $_POST['id'];
		$fullname = $_POST['fullname'];
		$password = $_POST['password'];

		$sql = "SELECT * FROM voters WHERE id = $id";
		$query = $conn->query($sql);
		$row = $query->fetch_assoc();

		if($password == ''){
			$password = $row['password'];
			// $password = password_hash($password, PASSWORD_DEFAULT);
		}
		else{
			$password = password_hash($password, PASSWORD_DEFAULT);
		}

		$sql = "UPDATE voters SET fullname = '$fullname', password = '$password' WHERE id = '$id'";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Voter updated successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
	}
	else{
		$_SESSION['error'] = 'Fill up edit form first';
	}

	header('location: voters.php');

?>
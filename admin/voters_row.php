<?php 
	include 'includes/session.php';

	if(isset($_POST['id'])){
		$id = $_POST['id'];
		$sql = "SELECT * FROM voters WHERE id = '$id'";
		$query = $conn->query($sql);
		$row = $query->fetch_assoc();
		$data = array(
			"id" => $row["id"],
			"nim" => $row["nim"],
			"fullname" => $row["fullname"],
			"photo" => $row["photo"],
		);

		echo json_encode($data);
	}
?>
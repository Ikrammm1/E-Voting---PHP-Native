<?php
	include 'includes/session.php';

	if(isset($_POST['delete'])){
		$id = $_POST['id'];
		
		$sqlgambar = "SELECT photo FROM candidates WHERE id = '$id'";
			$query = $conn->query($sqlgambar);
			$row = $query->fetch_assoc();
			$nama_file = "../images/$row[photo]";
			
			if (file_exists($nama_file)) {
				 if (unlink($nama_file)) {
					$sql = "DELETE FROM candidates WHERE id = '$id'";
					if($conn->query($sql)){
						$_SESSION['success'] = 'Candidate deleted successfully';
						}else{
						$_SESSION['error'] = $conn->error;
					}
				} else {
					$_SESSION['error'] = $conn->error;
				}
				
			}
		
	}
	else{
		$_SESSION['error'] = 'Select item to delete first';
	}

	header('location: candidates.php');
	
?>
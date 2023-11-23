<?php
include '../includes/conn.php';

//ambil data yang dikirim dari android
$voters_id = $_POST['voters_id'];
$fullname = $_POST['fullname'];
$password = $_POST['password'];
if($password == ''){
			$password = $password;
		}
		else{
			$password = password_hash($password, PASSWORD_DEFAULT);
		}

$sql_update = "UPDATE voters SET fullname = '$fullname', password = '$password' WHERE id = '$voters_id'";
$query_update = $conn->query($sql_update);
// var_dump($sql_input);
if ($query_update) {
    echo json_encode(
        array(
            'status' => true,
            'message' => 'Success',
        )
    );
} else {
    echo json_encode(
        array(
            'status' => false,
            'message' => 'Kesalahan',
        )
    );
}


// mengatur tampilan json

header('Content-Type: application/json');
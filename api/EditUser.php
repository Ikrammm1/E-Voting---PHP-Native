<?php
include '../includes/conn.php';

//ambil data yang dikirim dari android
$voters_id = $_POST['voters_id'];
$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];

$sql_update = "UPDATE voters SET firstname = '$firstname', lastname = '$lastname' WHERE id = '$voters_id'";
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

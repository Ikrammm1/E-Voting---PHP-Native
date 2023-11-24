<?php
include '../includes/conn.php';

//ambil data yang dikirim dari android
$vote = $_POST['vote'];

$sql_delete = "DELETE FROM votes WHERE id = '$vote'";
$query_delete = $conn->query($sql_delete);
// var_dump($sql_input);
if ($query_delete) {
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
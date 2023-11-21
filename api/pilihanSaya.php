<?php

include '../includes/conn.php';

$voters_id = $_POST['voters_id'];
$sql = "SELECT
            candidates.id as id_candidate,
            candidates.position_id as id_position,
            candidates.firstname, 
            candidates.lastname,
            candidates.photo, 
            candidates.platform, 
            COUNT(votes.voters_id) AS jml_vote 
        FROM `votes`
        RIGHT JOIN candidates ON votes.candidate_id = candidates.id
        where votes.voters_id = '$voters_id'
        GROUP BY candidates.id";

$query = $conn->query($sql);

if ($query->num_rows < 1) {
    echo json_encode(
        array(
            'response' => false,
            'message' => 'No Result',
            'payload' => null
        )
    );
} else {
    $row = $query->fetch_assoc();

    $filename = $row['photo'];
    $dir = '/images/';
    $image_path = $dir . $filename;
    echo json_encode(array(
        "candidate_id" => $row["id_candidate"],
        "position_id" => $row["id_position"],
        "firstname" => $row["firstname"],
        "lastname" => $row["lastname"],
        "photo" => $image_path,
        "platform" => $row["platform"],
        "jml_vote" => $row["jml_vote"],
    ));
}

// mengatur tampilan json

header('Content-Type: application/json');

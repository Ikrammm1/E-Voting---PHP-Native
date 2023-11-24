<?php

include '../includes/conn.php';

$voters_id = $_POST['voters_id'];
$sql = "SELECT votes.id as votes_id, position_id as id_position, 
    votes.candidate_id as id_candidate, nim, fullname, photo, platform
FROM votes 
INNER JOIN candidates ON votes.candidate_id = candidates.id
WHERE votes.voters_id = '$voters_id';";

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
    $jml_vote = $query->num_rows;
    $filename = $row['photo'];
    $dir = '/images/';
    $image_path = $dir . $filename;
    echo json_encode(array(
        "votes_id" => $row["votes_id"],
        "candidate_id" => $row["id_candidate"],
        "position_id" => $row["id_position"],
        "nim" => $row["nim"],
        "fullname" => $row["fullname"],
        "photo" => $image_path,
        "platform" => $row["platform"],
        "jml_vote" => $jml_vote,
    ));
}

// mengatur tampilan json

header('Content-Type: application/json');
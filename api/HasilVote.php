<?php

include '../includes/conn.php';

$sql = "SELECT
            candidates.id as id_candidate,
            candidates.position_id as id_position,
            candidates.fullname, 
            candidates.nim,
            candidates.photo, 
            candidates.platform, 
            COUNT(votes.voters_id) AS jml_vote 
        FROM `votes`
        RIGHT JOIN candidates ON votes.candidate_id = candidates.id
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
    $result = [];
    while ($row = mysqli_fetch_array($query)) {
        $filename = $row['photo'];
        $dir = '/images/';
        $image_path = $dir . $filename;
        array_push(
            $result,
            array(
                "candidate_id" => $row["id_candidate"],
                "position_id" => $row["id_position"],
                "nim" => $row["nim"],
                "fullname" => $row["fullname"],
                "photo" => $image_path,
                "platform" => $row["platform"],
                "jml_vote" => $row["jml_vote"],
            )
        );
    }
    echo json_encode($result);
}

// mengatur tampilan json

header('Content-Type: application/json');
?>
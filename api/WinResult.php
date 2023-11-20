<?php

include '../includes/conn.php';

$sql = "SELECT subquery.id,
                subquery.position_id,
                subquery.id_candidate,
                subquery.firstname,
                subquery.lastname,
                subquery.photo,
                subquery.platform,
                subquery.jml_vote
        FROM (
            SELECT 	votes.id,
                    votes.position_id,
                    candidates.id AS id_candidate,
                    candidates.firstname,
                    candidates.lastname,
                    candidates.photo,
                    candidates.platform,
                    COUNT(votes.voters_id) AS jml_vote
            FROM votes
            RIGHT JOIN candidates ON votes.candidate_id = candidates.id
            GROUP BY candidates.id
        ) AS subquery
        ORDER BY subquery.jml_vote DESC
        LIMIT 1";

		$query = $conn->query($sql);

		if($query->num_rows < 1){
            echo json_encode(
                array(
                    'response' => false,
                    'message' => 'No Result',
                    'payload' => null
                )
            );
		}
		else{
            $result = [];
            while($row = mysqli_fetch_array($query)) {
                $filename = $row['photo'];
                $dir = '/images/';
                $image_path = $dir.$filename;
                array_push($result, array(
                                    "id" => $row["id"],
                                    "candidate_id" => $row["id_candidate"],
                                    "position_id" => $row["id_position"],
                                    "firstname" => $row["firstname"],
                                    "lastname" => $row["lastname"],
                                    "photo" => $image_path,
                                    "platform" => $row["platform"], 
                                    "jml_vote" => $row["jml_vote"], 
                                     )
                            );
            }
            echo json_encode($result);

		}

// mengatur tampilan json

header('Content-Type: application/json')

?>
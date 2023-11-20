<?php

include '../includes/conn.php';

$sql = "SELECT votes.id, 
            votes.candidate_id, 
            votes.position_id,
            candidates.firstname, 
            candidates.lastname,
            candidates.photo, 
            candidates.platform, 
            COUNT(votes.voters_id) AS jml_vote 
        FROM `votes`
        RIGHT JOIN candidates ON votes.candidate_id = candidates.id
        GROUP BY candidates.id";

		$query = $conn->query($sql);

		if($query->num_rows < 1){
            echo json_encode(
                array(
                    'response' => false,
                    'message' => 'No Resukt',
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
                                    "candidate_id" => $row["candidate_id"],
                                    "position_id" => $row["position_id"],
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
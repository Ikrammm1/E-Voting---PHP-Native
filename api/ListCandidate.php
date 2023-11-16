<?php

include '../includes/conn.php';

$sql = "SELECT * FROM candidates";
		$query = $conn->query($sql);

		if($query->num_rows < 1){
            echo json_encode(
                array(
                    'response' => false,
                    'message' => 'No Voting',
                    'payload' => null
                )
            );
		}
		else{
			// $row = $query->fetch_assoc();
            $result = [];
            while($row = mysqli_fetch_array($query)) {
                $filename = $row['photo'];
                $dir = '/votesystem/images/';
                $image_path = $dir.$filename;
                array_push($result, array(
                                    "id" => $row["id"],
                                    "position_id" => $row["position_id"],
                                    "firstname" => $row["firstname"],
                                    "lastname" => $row["lastname"],
                                    "photo" => $image_path,
                                    "platform" => $row["platform"], 
                                     )
                            );
            }
            echo json_encode(array('candidates' =>$result));
            

                    
			
		}

// mengatur tampilan json

header('Content-Type: application/json')

?>
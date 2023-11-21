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
			$voters_id = $_POST['voters_id'];
            $sqlcek = "SELECT * FROM votes WHERE voters_id = '$voters_id'";
            $querycek = $conn->query($sqlcek);
            if($querycek->num_rows > 0){
                $status = 'true';                          
            }else{
                $status = 'false'; 
            }
            $result = [];
            while($row = mysqli_fetch_array($query)) {
                $filename = $row['photo'];
                $dir = '/images/';
                $image_path = $dir.$filename;
                array_push($result, array(
                                    "id" => $row["id"],
                                    "position_id" => $row["position_id"],
                                    "firstname" => $row["firstname"],
                                    "lastname" => $row["lastname"],
                                    "photo" => $image_path,
                                    "platform" => $row["platform"], 
                                    "status_vote" => $status,
                                     )
                            );
            }
            echo json_encode(array('candidates' =>$result));
            

                    
			
		}

// mengatur tampilan json

header('Content-Type: application/json')

?>
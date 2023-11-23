<?php
	include '../includes/conn.php';

        //ambil data yang dikirim dari android
		$voters_id = $_POST['voters_id'];
		$candidate_id = $_POST['candidate_id'];

		$sql = "SELECT * FROM votes WHERE voters_id = '$voters_id' and candidate_id = '$candidate_id' ";
		$query = $conn->query($sql);
    
		if($query->num_rows < 1){
			$sql_input = "INSERT INTO votes (voters_id, candidate_id) VALUES ('$voters_id', '$candidate_id')";
            $query_input = $conn->query($sql_input);
            // var_dump($sql_input);
            if ($query_input) {
               echo json_encode(
                    array(
                        'status' => true,
                        'message' => 'Success',
                    )
                );
            }else{
                echo json_encode(
                    array(
                        'status' => false,
                        'message' => 'Kesalahan',
                    )
                );
            }

            
		}
		else{
			    echo json_encode(
                    array(
                        'status' => false,
                        'message' => 'You can only choose 1 candidate',
                    )
                );
		}

// mengatur tampilan json

header('Content-Type: application/json')

?>
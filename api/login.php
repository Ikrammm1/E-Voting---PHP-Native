<?php

	include '../includes/conn.php';

        //ambil data yang dikirim dari android
		$voter = $_POST['voter'];
		$password = $_POST['password'];
        
		$sql = "SELECT * FROM voters WHERE voters_id = '$voter'";
		$query = $conn->query($sql);
       
		if($query->num_rows < 1){
            echo json_encode(
                array(
                    'response' => false,
                    'message' => 'Cannot find voter with the ID',
                    'payload' => null
                )
            );
		}
		else{
			$row = $query->fetch_assoc();
            $filename = $row['photo'];
            $dir = '/votesystem/images/';
            $image_path = $dir.$filename;

			if(password_verify($password, $row['password'])){
                    echo json_encode(
                        array(
                            'response' => true,
                            'message' => 'Success',
                            'payload' => array(
                                "id" => $row["id"],
                                "firstname" => $row["firstname"],
                                "lastname" => $row["lastname"],
                                "photo" => $image_path
                                
                            )
                        )
                    );
			}
			else{
                echo json_encode(
                    array(
                        'response' => false,
                        'message' => 'Incorrect password',
                        'payload' => null
                    )
                );
			}
		}

// mengatur tampilan json

header('Content-Type: application/json')

?>
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
                $position_id =$row["position_id"];
                $sqlpos = "SELECT * FROM positions WHERE id = '$position_id'";
                $querypos = $conn->query($sqlpos);
                $positions = $querypos->fetch_assoc();

                        date_default_timezone_set("Asia/Jakarta");
                        $mulai = strtotime(date($positions['start_vote']));
                        $deadline = strtotime(date($positions['end_vote']));
                        $sekarang = strtotime(date("Y-m-d H:i:s"));
                        $awal = $mulai - $sekarang;
                        $tetap = $deadline - $mulai;
                        $harit = floor($tetap / (60 * 60 * 24));
                        $jamt  = floor($tetap % (60 * 60 * 24) / (60 * 60));
                        $menitt = floor($tetap % (60 * 60) / 60);
                        $detikt = floor($tetap % 60);
                        $sisa = $deadline - $sekarang;
                        if ($awal <= 0 && $sisa > 0){
                            $mulai_vote = true;
                        }else{
                            $mulai_vote = false;
                        }

                $filename = $row['photo'];
                $dir = '/images/';
                $image_path = $dir.$filename;
                array_push($result, array(
                                    "id" => $row["id"],
                                    "candidate_id" => $row["candidate_id"],
                                    "nim" => $row["nim"],
                                    "fullname" => $row["fullname"],
                                    "photo" => $image_path,
                                    "platform" => $row["platform"], 
                                    "status_vote" => $status,
                                    "mulai_vote" => $mulai_vote
                                     )
                            );
            }
            echo json_encode(array('candidates' =>$result));
            

                    
			
		}

// mengatur tampilan json

header('Content-Type: application/json')

?>
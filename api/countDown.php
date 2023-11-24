<?php
	include '../includes/conn.php';

        //ambil data yang dikirim dari android
       
        $sqlpos = "SELECT * FROM positions LIMIT 1";
        $querypos = $conn->query($sqlpos);
        $positions = $querypos->fetch_assoc();

                date_default_timezone_set("Asia/Jakarta");
                $mulai = strtotime(date($positions['start_vote']));
                $deadline = strtotime(date($positions['end_vote']));
                $sekarang = strtotime(date("Y-m-d H:i:s"));
                $awal = $mulai - $sekarang;
                $sisa = $deadline - $sekarang;
                $hari = floor($sisa / (60 * 60 * 24));
                $jam  = floor($sisa % (60 * 60 * 24) / (60 * 60));
                $menit = floor($sisa % (60 * 60) / 60);
                $detik = floor($sisa % 60);
                $countDown = "$hari hari $jam jam $menit menit";
	
            if ($querypos) {
               echo json_encode(
                    array(
                        'position_id' => $positions['id'],
                        'description' => $positions['description'],
                        'start_vote' => $positions['start_vote'],
                        'end_vote' => $positions['end_vote'],
                        'countdown' => $countDown,
                        'sisa_waktu' => $sisa,
                        'awal' => $awal
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
		

// mengatur tampilan json

header('Content-Type: application/json')

?>
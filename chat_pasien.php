<?php
    require "koneksi.php";
    
    if($_SERVER['REQUEST_METHOD'] == "POST"){
        $response = array();
        $id_user = $_POST['id_user'];

        $query = "SELECT DISTINCT A.name, A.foto_profil, A.id_dokter
                        FROM user_dokter A, user_pasien B, data_chat C
                        WHERE (B.id_pasien = '$id_user' AND A.id_dokter = C.id_dokter)";
        $hasil = mysqli_query($con,$query);

        if (!$hasil) {
            printf("Error: %s\n", mysqli_error($con));
            exit();
        }
        if(isset($hasil)){
            while ($fetchdata = mysqli_fetch_array($hasil)){
                $response[] = $fetchdata;  
                
            }
            echo json_encode($response);
        }
        else{
            echo json_decode('ERROR');
        }
    
    }
?>

<?php
    require "koneksi.php";
    
    if($_SERVER['REQUEST_METHOD'] == "POST"){
        $response = array();
        $id_dokter = $_POST['id_dokter'];

        // $query = "SELECT  DISTINCT A.nama_lengkap, A.profilePicture, A.id_user, A.id_pasien
        //             FROM tabel_pasien A, data_chat B
        //             WHERE (B.id_pengirim = '$id_dokter'
        //             AND B.id_penerima= A.id_user) OR (B.id_penerima = '$id_dokter'
        //             AND B.id_pengirim= A.id_user)";
        $query = "SELECT DISTINCT B.name, B.foto_profil, B.id_pasien FROM user_dokter A, user_pasien B, data_chat C WHERE (C.id_dokter = '$id_dokter' AND B.id_pasien = C.id_user)";
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

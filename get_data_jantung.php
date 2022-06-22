<?php

require_once "koneksi.php";

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $response   = array();
    $id_pasien  = $_POST['id_pasien'];
    $jam        = $_POST['jam'];
    $query      = "SELECT * FROM `r_deteksi` WHERE `id_pasien` ='$id_pasien' AND `jam_rekam` = '$jam'";
    $hasil      = mysqli_query($con, $query);

    if(mysqli_num_rows($hasil)===0){
        $response['value'] = '0';
        $response['message'] = 'Data Kosong';
        $response['content'] = (object)[];
        echo json_encode($response);
    } else{
        while($fetchdata = mysqli_fetch_array($hasil)){
            $response['value'] = '1';
            $response['message'] = 'Data Kosong';
            $response['content'][] = [
                'id_r' => $fetchdata['id_r'],
                'id_pasien' => $fetchdata['id_pasien'],
                'tanggal_rekam' => $fetchdata["tanggal_rekam"],
                'jam_rekam' => $fetchdata['jam_rekam'],
                'total_r' => $fetchdata['total_r'],
            ];
        }
        echo json_encode($response);

    }
}

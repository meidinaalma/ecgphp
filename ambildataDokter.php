<?php

require_once "koneksi.php";

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $response   = array();
    
    
    $query      = "SELECT * FROM user_dokter";
    $hasil      = mysqli_query($con, $query);

    if(mysqli_num_rows($hasil)===0){
        $response['value'] = '0';
        
        echo json_encode($response);
    }
    else {
       
        
        while ($fetchdata = mysqli_fetch_array($hasil)) {
            $response[] = $fetchdata;
            // $response['role'] = $fetchdata['tipe_user'];
            // $response['username'] = $fetchdata['username'];
            // $response['name'] = $fetchdata['nama_lengkap'];
        }
        echo json_encode($response);
    } 
}

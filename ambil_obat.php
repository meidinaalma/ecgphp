<?php

require "koneksi.php";

if($_SERVER['REQUEST_METHOD']=="POST"){
    $response   = array();
    $id_pasien  = $_POST['id_pasien'];
    $id_dokter  = $_POST['id_dokter'];
    
    $query_insert= "SELECT * 
    FROM  resep_obat 
    WHERE id_pasien = '$id_pasien' AND id_dokter = '$id_dokter'";
    $hasil      = mysqli_query($con, $query_insert);
   $total = 0;
    if(!$hasil){
        printf("error : %s\n", mysqli_error($con));
        exit();
    }
    if(isset($hasil)){
        while ($fetchdata = mysqli_fetch_array($hasil)){
            $response[] = $fetchdata;
            $total++;
        }
        $response['total'] = "$total";
        echo json_encode($response);
    }else{
        $response['value'] = '0';
        echo json_encode($response);
    }
}
 
?>

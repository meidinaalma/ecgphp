<?php

require "koneksi.php";

if($_SERVER['REQUEST_METHOD']=="POST"){
    $response   = array();
    $id_dokter= $_POST['id_dokter'];
    $bulan    = $_POST['bulan'];
    $tahun    = $_POST['tahun'];
   
    
    
    $query      = "SELECT DISTINCT B.foto_profil, B.name, A.clock, B.id_pasien, A.id_user as id_pasien, A.tanggal FROM data_ecg A, user_pasien B WHERE A.id_dokter='$id_dokter' AND B.id_pasien = A.id_user AND MONTH(A.tanggal) = '$bulan' AND YEAR(A.tanggal)='$tahun'";

   $hasil      = mysqli_query($con, $query);
    
   if(!$hasil){
       printf("error : %s\n", mysqli_error($con));
       exit();
   }
    if(isset($hasil)){
        while($fetchdata= mysqli_fetch_array($hasil, MYSQLI_ASSOC)){
            $response[] = $fetchdata;
        }
        echo json_encode($response);
    }else{
        $response['value'] = '0';
        echo json_encode($response);
    }
}
 
?>

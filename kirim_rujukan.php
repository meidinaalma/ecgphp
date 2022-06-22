<?php

require "koneksi.php";

if($_SERVER['REQUEST_METHOD']=="POST"){
    $response   = array();
    $id_dokter  = $_POST['id_dokter'];
    $id_pasien  = $_POST['id_pasien'];
    $tanggal    = $_POST['tanggal'];
    $keterangan = $_POST['keterangan'];
    
    
    $query_insert= "INSERT INTO `surat_rujukan` SET `id_dokter`='$id_dokter',`id_pasien`= '$id_pasien', 
    `tanggal`='$tanggal', `keterangan`='$keterangan'";
   $hasil      = mysqli_query($con, $query_insert);
   if(!$hasil){
       printf("error : %s\n", mysqli_error($con));
       exit();
   }
    if(isset($hasil)){
        $response['value']= '1';
        echo json_encode($response);
    }else{
        $response['value'] = '0';
        echo json_encode($response);
    }
}
 
?>

<?php

require "koneksi.php";

if($_SERVER['REQUEST_METHOD']=="POST"){
    $response   = array();
    $id_user= $_POST['id_user'];
    $pesan      = $_POST['pesan'];
    $id_dokter= $_POST['id_dokter'];
    $waktu      = $_POST['waktu'];
    $tanggal    = $_POST['tanggal'];
    $pengirim    = $_POST['pengirim'];
    
    
    $query_insert= "INSERT INTO `data_chat` SET `id_user`='$id_user',`pesan`= '$pesan',`id_dokter`='$id_dokter',`jam`='$waktu', 
    `tanggal`='$tanggal', `pengirim`='$pengirim'";
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

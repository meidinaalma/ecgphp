<?php

require "koneksi.php";

if($_SERVER['REQUEST_METHOD']=="POST"){
    $response   = array();
    $id_pasien= $_POST['id_pasien'];
    $id_dokter= $_POST['id_dokter'];
    $menit    = $_POST['menit'];
    $detik    = $_POST['detik'];
    $tanggal    = $_POST['tanggal'];
    
    
    $query      = "SELECT DISTINCT id_data_diagnosa FROM data_ecg WHERE `id_pasien`='$id_pasien' AND `id_dokter`='$id_dokter' AND `menit`='$menit' AND `detik`='$detik' AND `tanggal`='$tanggal'";

   $hasil      = mysqli_query($con, $query);
    
   if(!$hasil){
       printf("error : %s\n", mysqli_error($con));
       exit();
   }
    if(isset($hasil)){
        while($fetchdata= mysqli_fetch_array($hasil, MYSQLI_ASSOC)){
            $response = $fetchdata['id_data_diagnosa'];
        }
        // echo json_encode($response);
        $query_diagnosa="SELECT isi_diagnosa FROM data_diagnosa WHERE `id_data_diagnosa`='$response'";
        $hasil_dua=mysqli_query($con,$query_diagnosa);
        if(!$hasil_dua){
            printf("error : %s\n", mysqli_error($con));
            exit();
        }
         if(isset($hasil_dua)){
             while($fetch= mysqli_fetch_array($hasil_dua, MYSQLI_ASSOC)){
                 $response = $fetch['isi_diagnosa'];
             }
             echo json_encode($response);
             
         }else{
             $response['nilai'] = '0';
             echo json_encode($response);
         }
    }else{
        $response['value'] = '0';
        echo json_encode($response);
    }
}
 
?>

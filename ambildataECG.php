<?php

require "koneksi.php";

if($_SERVER['REQUEST_METHOD']=="POST"){
    $response   = array();
    $id_pasien= $_POST['id_pasien'];
    $id_dokter= $_POST['id_dokter'];
    $menit0    = $_POST['menit0'];
    $detik0    = $_POST['detik0'];
    $menit1    = $_POST['menit1'];
    $detik1    = $_POST['detik1'];
    $tanggal    = $_POST['tanggal'];
    $clock    = $_POST['waktu_rekaman'];
    
    $query      = "SELECT jam,data,menit,detik FROM data_ecg WHERE `id_user`='$id_pasien' AND `id_dokter`='$id_dokter'  AND `tanggal`='$tanggal' AND `clock`='$clock' AND (`id_data_ecg` BETWEEN (SELECT id_data_ecg FROM data_ecg WHERE `id_user`='$id_pasien' AND `id_dokter`='$id_dokter'  AND `tanggal`='$tanggal' AND `clock`='$clock' AND `menit`='$menit0' AND `detik`='$detik0' LIMIT 1) AND (SELECT id_data_ecg FROM data_ecg WHERE `id_user`='$id_pasien' AND `id_dokter`='$id_dokter'  AND `tanggal`='$tanggal' AND `clock`='$clock' AND `menit`='$menit1' AND `detik`='$detik1' ORDER BY id_data_ecg ASC LIMIT 1 ))";
    //`menit` BETWEEN '$menit0' AND '$menit1' AND `detik` BETWEEN '$detik0' AND '$detik1'
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

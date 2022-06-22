<?php

require "koneksi.php";

if($_SERVER['REQUEST_METHOD']=="POST"){
    $response   = array();
    $isi_diagnosa     = $_POST['isi_diagnosa'];
    $tanggal_diagnosa = $_POST['tanggal_diagnosa'];
    $waktu_diagnosa   = $_POST['waktu_diagnosa'];

    $id_user       = $_POST['id_pasien'];
    
    $id_dokter     = $_POST['id_dokter'];
    $menit0         = $_POST['menit0'];
    $detik0         = $_POST['detik0'];
    $menit1         = $_POST['menit1'];
    $detik1         = $_POST['detik1'];
    $tanggal       = $_POST['tanggal'];
    
    
    
    $query_insert= "INSERT INTO `data_diagnosa` SET `isi_diagnosa`='$isi_diagnosa',`tanggal_diagnosa`= '$tanggal_diagnosa',`waktu_diagnosa`='$waktu_diagnosa'";
    $query_select= "SELECT id_data_diagnosa FROM data_diagnosa WHERE isi_diagnosa ='$isi_diagnosa' AND tanggal_diagnosa = '$tanggal_diagnosa' AND waktu_diagnosa = '$waktu_diagnosa'";
    
    
   $hasil      = mysqli_query($con, $query_insert);
   if(!$hasil){
       printf("error : %s\n", mysqli_error($con));
       exit();
   }
    if(isset($hasil)){
        $response['value']= '1';
        echo json_encode($response);
        $hasil_dua = mysqli_query($con, $query_select);
        if(mysqli_num_rows($hasil_dua)===0){
            $respon['nilai'] = '0';
            
            echo json_encode($respon);
        }
        else {
            while ($fetchdata = mysqli_fetch_array($hasil_dua)) {
                $respon = $fetchdata['id_data_diagnosa'];
                // $response['role'] = $fetchdata['tipe_user'];
                // $response['username'] = $fetchdata['username'];
                // $response['name'] = $fetchdata['nama_lengkap'];
            }
            echo json_encode($respon);
            $query_update= "UPDATE data_ecg SET id_data_diagnosa = $respon
             WHERE id_user='$id_user' AND id_dokter='$id_dokter' AND menit BETWEEN '$menit0' AND '$menit1'
             AND detik BETWEEN '$detik0' AND '$detik1' AND tanggal='$tanggal'";
            $hasil_tiga = mysqli_query($con, $query_update);
            if(!$hasil_tiga){
                printf("error : %s\n", mysqli_error($con));
                exit();
            }
             if(isset($hasil_tiga)){
                 $resp['nil']= '1';
                 echo json_encode($resp);
             }else{
                 $resp['nil'] = '0';
                 echo json_encode($resp);
             }
        } 
        
    }else{
        $response['value'] = '0';
        echo json_encode($response);
    }
}
 
?>

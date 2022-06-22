<?php

require "koneksi.php";

if($_SERVER['REQUEST_METHOD']=="POST"){
    $response   = array();
    $id_pasien= $_POST['id_pasien'];
    $id_dokter= $_POST['id_dokter'];
    $tanggal = $_POST['tanggal'];
    
   
    
    $query      = "select b.tanggal ,a.menit_awal, a.detik_awal, b.menit menit_akhir, b.detik detik_akhir, c.id_data_diagnosa, c.isi_diagnosa, c.tanggal_diagnosa, c.waktu_diagnosa 
                    from data_ecg b inner join (select menit menit_awal, detik detik_awal, max(id_data_ecg) max_val from data_ecg where id_pasien='$id_pasien' AND id_dokter='$id_dokter' AND tanggal='$tanggal' AND id_data_diagnosa!=0 
                    group by id_data_diagnosa) a on a.max_val = b.id_data_ecg 
                    inner join data_diagnosa c on c.id_data_diagnosa=b.id_data_diagnosa";

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

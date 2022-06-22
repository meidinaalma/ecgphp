<?php

require "koneksi.php";

if($_SERVER['REQUEST_METHOD']=="POST"){
    
    $response      = array();
    // Takes raw data from the request
    $json = file_get_contents('php://input');

// Converts it into a PHP object
    $data_ = json_decode($json);
    //var_dump($data_);
    
    $panjang= count($data_->data);
   
    //echo $data_->tanggal;
    for($i=0;$i<$panjang;$i++){
        //echo $i;
        $id_pasien      = $data_->id_pasien;
        $data          = $data_->data[$i]->data;
        $id_dokter     = $data_->id_dokter;
        $waktu         = $data_->data[$i]->menit;
        $detik         = $data_->data[$i]->detik;
        $tanggal       = $data_->tanggal;
        $jam           = $data_->data[$i]->sample;
        $channel       = $data_->channel;
        $clock         = $data_->waktu_rekaman;
        
        $query_insert= "INSERT INTO `data_ecg` SET `id_user`='$id_pasien',`data`= '$data',`id_dokter`='$id_dokter',
        `menit`='$waktu',`detik`='$detik', `tanggal`= '$tanggal', `jam`= '$jam', `channel`= '$channel',`clock`= '$clock'";
        
        $hasil      = mysqli_query($con, $query_insert);
      if(!$hasil){
          printf("error : %s\n", mysqli_error($con));
          exit();
      }
        else if(isset($hasil)){
            $response['value']= '1';
            echo json_encode($response);
        }else{
            $response['value'] = '0';
            echo json_encode($response);
    }
}
    
   
}
 
?>

// <?php

// require "koneksi.php";

// if($_SERVER['REQUEST_METHOD']=="POST"){
//     $response      = array();
//     $id_user       = $_POST['id_user'];
//     $data          = $_POST['data'];
//     $id_dokter     = $_POST['id_dokter'];
//     $waktu         = $_POST['waktu'];
//     $detik         = $_POST['detik'];
//     $tanggal       = $_POST['tanggal'];
//     $jam           = $_POST['jam'];
//     $channel       = $_POST['channel'];
//     $clock         = $_POST['waktu_rekaman'];
    
//     $query_insert= "INSERT INTO `data_ecg` SET `id_user`='$id_user',`data`= '$data',`id_dokter`='$id_dokter',
//     `menit`='$waktu',`detik`='$detik', `tanggal`= '$tanggal', `jam`= '$jam', `channel`= '$channel',`clock`= '$clock'";

//   $hasil      = mysqli_query($con, $query_insert);
//   if(!$hasil){
//       printf("error : %s\n", mysqli_error($con));
//       exit();
//   }
//     if(isset($hasil)){
//         $response['value']= '1';
//         echo json_encode($response);
//     }else{
//         $response['value'] = '0';
//         echo json_encode($response);
//     }
// }
 
// ?>

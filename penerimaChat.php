<?php

require_once "koneksi.php";

// if($_SERVER['REQUEST_METHOD']=="POST"){
//     $response   = array();
//     $id_penerima= $_POST['id_penerima'];
//     $query      = "SELECT * FROM `user` WHERE `id_user` ='$id_penerima'";
//     $hasil      = mysqli_query($con, $query);
//     if(!$hasil){
//         printf("error : %s\n", mysqli_error($con));
//         exit();
//     }
//     if(isset($hasil)){
// 	    while($fetchdata= mysqli_fetch_array($hasil, MYSQLI_ASSOC)){
//             $id_user = $fetchdata['id_user'];
// 	        $role  = $fetchdata['tipe_user'];
//         }
//         if($role==0){
//             $query_pasien     = "SELECT * FROM `tabel_pasien` WHERE `id_user` ='$id_penerima'";
//             $hasil_pasien      = mysqli_query($con, $query_pasien);
//             while($fetchdata0= mysqli_fetch_array($hasil_pasien, MYSQLI_ASSOC)){
//                 $response['nama'] = $fetchdata0['nama_lengkap'];
//     	        $response['foto']  = $fetchdata0['profilePicture'];
//             }
//         }else{
//             $query_dokter     = "SELECT * FROM `tabel_dokter` WHERE `id_user` ='$id_penerima'";
//             $hasil_dokter      = mysqli_query($con, $query_dokter);
//             while($fetchdata0= mysqli_fetch_array($hasil_dokter, MYSQLI_ASSOC)){
//                 $response['nama'] = $fetchdata0['nama_lengkap'];
//     	        $response['foto']  = $fetchdata0['profilePicture'];
//             }
//         }
      	
      	
//         echo json_encode($response);
//     }else{
//         $response = 'Error';
//         echo json_encode($response);
//     }
// }

if($_SERVER['REQUEST_METHOD']=="POST"){
    // $query = "SELECT DISTINCT B.name, B.foto_profil, B.id_pasien FROM user_dokter A, user_pasien B, data_chat C WHERE (A.id_dokter = '$id_dokter' AND B.id_pasien = C.id_user)";
    $response   = array();
    $id_dokter= $_POST['id_dokter'];
    // $query      = "SELECT * FROM `data_chat` WHERE `id_dokter` ='$id_dokter'";
    $query      = "SELECT * FROM  data_chat  WHERE id_dokter = '$id_dokter'";
    $hasil      = mysqli_query($con, $query);
    if(!$hasil){
        printf("error : %s\n", mysqli_error($con));
        exit();
    } if(isset($hasil)){
        $response['value'] = '1';
        while ($fetchdata = mysqli_fetch_array($hasil)) {
            $response[] = $fetchdata;
        }
       echo json_encode($response);
   }else{
       $response['value'] = '0';
       echo json_encode($response);
   }
}
 
?>

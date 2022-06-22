<?php

require "koneksi.php";

if($_SERVER['REQUEST_METHOD']=="POST"){
    $response   = array();
    $id_dokter= $_POST['id_dokter'];
    $id_user= $_POST['id_user'];
    
    $query      = "SELECT * FROM data_chat WHERE `id_dokter`='$id_dokter' AND `id_user`='$id_user' ORDER BY id_chat DESC";

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

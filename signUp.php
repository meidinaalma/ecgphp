<?php

require "koneksi.php";

if($_SERVER['REQUEST_METHOD']=="POST"){
    $response   = array();
    $username   = $_POST['username'];
    $email      = $_POST['email'];
    $password   = $_POST['password'];
    $role       = $_POST['role'];
    
    $query_insert= "INSERT INTO `user` SET `username`='$username',`email`= '$email',`password`='$password', `tipe_user`='$role'";
   $hasil      = mysqli_query($con, $query_insert);
   if(!$hasil){
       printf("error : %s\n", mysqli_error($con));
       exit();
   }
    if(isset($hasil)){
	     $response['value'] = '1';
        echo json_encode($response);
    }else{
        $response['value'] = '0';
        echo json_encode($response);
    }
}
 
?>
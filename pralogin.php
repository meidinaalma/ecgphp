<?php

require_once "koneksi.php";

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $response   = array();
    $email      = $_POST['email'];
    $password   = $_POST['password'];
    $query      = "SELECT * FROM `user` WHERE `email` ='$email' and `password` = '$password'";
    $hasil      = mysqli_query($con, $query);

    if(mysqli_num_rows($hasil)===0){
        $response['value'] = '0';
        $response['message'] = 'Login Gagal';
        echo json_encode($response);
    }
    else {
        $response['value'] = '1';
        $response['message'] = 'Login Berhasil';
        while ($fetchdata0 = mysqli_fetch_array($hasil)) {
            $response['id_user'] = $fetchdata0['id_user'];
            $response['role'] = $fetchdata0['tipe_user'];
            $response['username'] = $fetchdata0['username'];
            $response['email'] = $fetchdata0['email'];
            
        }
        
        echo json_encode($response);
    } 
}

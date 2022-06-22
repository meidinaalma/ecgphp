<?php

require "koneksi.php";

if($_SERVER['REQUEST_METHOD']=="POST"){

    $image = $_POST['image'];
    $file_name = $_POST['file_name'];

    $path_server_save = 'img/profile/'.$file_name;
    $realImage = base64_decode($image);
    file_put_contents($path_server_save, $realImage);

    $path_image = 'img/profile/'.$file_name;

    $response   = array();
    $nama_lengkap = $_POST['nama_lengkap'];
    $username   = $_POST['username'];
    $email      = $_POST['email'];
    $password   = $_POST['password'];
    $tipe_user  = $_POST['tipe_user'];
    $jenis_kelamin  = $_POST['jenis_kelamin'];
    $tanggal_lahir  = $_POST['tanggal_lahir'];
    $no_telepon  = $_POST['no_telepon'];
    $no_identitas  = $_POST['no_identitas'];
    $alamat  = $_POST['alamat'];
    
    $query_insert= "INSERT INTO `user_pasien` SET `name`='$nama_lengkap', `username`='$username', `email`='$email', `password`='$password', `foto_profil`='$path_image', `tipe_user`='$tipe_user', `jenis_kelamin`='$jenis_kelamin', `tanggal_lahir`='$tanggal_lahir', `phone`='$no_telepon', `no_identitas`='$no_identitas', `alamat`='$alamat'";

   $hasil      = mysqli_query($con, $query_insert);
   if(!$hasil){
       printf("error : %s\n", mysqli_error($con));
       exit();
   }
    if(isset($hasil)){
	     $response['value'] = '1';
         $query_pasien   = "SELECT * FROM `user_pasien` WHERE `email` ='$email' and `password` = '$password'";
            $hasil_pasien   = mysqli_query($con, $query_pasien);
            while ($fetchdata = mysqli_fetch_array($hasil_pasien)) {
                $response['id_pasien'] = $fetchdata['id_pasien'];
                $response['tipe_user'] = $fetchdata['tipe_user'];
                $response['username'] = $username;
                $response['name'] = $fetchdata['name'];
                $response['foto_profil'] = $fetchdata['foto_profil'];
                $response['tanggal_lahir'] = $fetchdata['tanggal_lahir'];
                $response['phone'] = $fetchdata['phone'];
                $response['alamat'] = $fetchdata['alamat'];
                $response['email'] = $email;
                $response['role'] = '0';
            }
        echo json_encode($response);
    }else{
        $response['value'] = '0';
        echo json_encode($response);
    }
}
 
?>
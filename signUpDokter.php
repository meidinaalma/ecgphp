<?php

require "koneksi.php";

if($_SERVER['REQUEST_METHOD']=="POST"){
    $response   = array();
    
    $image = $_POST['image'];
    $images_camera = $_POST['file_name'];

    $path_server_save = 'img/profile/'.$images_camera;
    $realImage = base64_decode($image);
    file_put_contents($path_server_save, $realImage);

    $path_image = 'img/profile/'.$images_camera;

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
    ///////////
    $image_sertif = $_POST['image_sertif'];
    $images_name_sertif = $_POST['images_sertif_name'];

    $path_server_save_sertif = 'img/sertif/'.$images_name_sertif;
    $realImage_sertif = base64_decode($image_sertif);
    file_put_contents($path_server_save_sertif, $realImage_sertif);

    $path_image_sertif = 'img/sertif/'.$images_name_sertif;
    
    ///////////
    $image_surat = $_POST['image_surat'];
    $images_name_surat = $_POST['images_surat_name'];

    $path_server_save_surat = 'img/surat/'.$images_name_surat;
    $realImage_surat = base64_decode($image_surat);
    file_put_contents($path_server_save_surat, $realImage_surat);

    $path_image_surat = 'img/surat/'.$images_name_surat;
    
    $query_insert= "INSERT INTO `user_dokter` SET `name`='$nama_lengkap', `username`='$username', `email`='$email', `password`='$password', `tipe_user`='$tipe_user', `foto_profil`='$path_image', `jenis_kelamin`= '$jenis_kelamin', `phone`='$no_telepon', `no_identitas`='$no_identitas', `tanggal_lahir`='$tanggal_lahir',`alamat`='$alamat', `sertifikat`='$path_image_sertif',`surat_izinpraktik`='$path_image_surat'";
    $hasil      = mysqli_query($con, $query_insert);


   if(!$hasil){
       printf("error : %s\n", mysqli_error($con));
       exit();
   }
    if(isset($hasil)){
        $response['value']= '1';
        $query_dokter   = "SELECT * FROM `user_dokter` WHERE `email` ='$email' and `password` = '$password'";
            $hasil_dokter   = mysqli_query($con, $query_dokter);
            while ($fetchdata = mysqli_fetch_array($hasil_dokter)) {
                $response['id_dokter'] = $fetchdata['id_dokter'];
                $response['tipe_user'] = $fetchdata['tipe_user'];
                $response['username'] = $username;
                $response['name'] = $fetchdata['name'];
                $response['foto_profil'] = $fetchdata['foto_profil'];
                $response['tanggal_lahir'] = $fetchdata['tanggal_lahir'];
                $response['phone'] = $fetchdata['phone'];
                $response['alamat'] = $fetchdata['alamat'];
                $response['email'] = $email;
                $response['role'] = '1';
            }
	   
        echo json_encode($response);
    }else{
        $response['value'] = '0';
        echo json_encode($response);
    }
}
 
?>

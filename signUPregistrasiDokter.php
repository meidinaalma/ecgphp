<?php

require "koneksi.php";

if($_SERVER['REQUEST_METHOD']=="POST"){
    $response   = array();
    $id_user   = $_POST['userid'];
    
    $image = $_POST['image'];
    $images_camera = $_POST['images_camera'];

    $path_server_save = 'img/profile/'.$images_camera;
    $realImage = base64_decode($image);
    file_put_contents($path_server_save, $realImage);

    $path_image = 'img/profile/'.$images_camera;

    $nama_lengkap= $_POST['namalengkap'];
    $gender     = $_POST['gender'];
    $dob        = $_POST['dob'];
    $phone      = $_POST['phone'];
    $alamat     = $_POST['alamat'];
    $no_identitas= $_POST['no_identitas'];
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
    
    
    
    $query_insert= "INSERT INTO `tabel_dokter` SET `id_user`='$id_user',`nama_lengkap`='$nama_lengkap', 
    `profilePicture`='$path_image', `jenis_kelamin`= '$gender', `no_telepon`='$phone', `no_identitas`='$no_identitas', 
    `tanggal_lahir`='$dob',`alamat`='$alamat',`image_sertif`='$path_image_sertif',`image_surat_izin`='$path_image_surat'";
   $hasil      = mysqli_query($con, $query_insert);
   if(!$hasil){
       printf("error : %s\n", mysqli_error($con));
       exit();
   }
    if(isset($hasil)){
        $response['value']= '1';
        $query_dokter   = "SELECT * FROM `tabel_dokter` WHERE `id_user` ='$id_user'";
            $hasil_dokter   = mysqli_query($con, $query_dokter);
            while ($fetchdata = mysqli_fetch_array($hasil_dokter)) {
                $response['id_user'] = $id_user;
                $response['role'] = $role;
                $response['id_dokter'] = $fetchdata['id_dokter'];
                $response['username'] = $username;
                $response['name'] = $fetchdata['nama_lengkap'];
                $response['foto_profil'] = $fetchdata['profilePicture'];
                $response['tanggal_lahir'] = $fetchdata['tanggal_lahir'];
                $response['phone'] = $fetchdata['no_telepon'];
                $response['alamat'] = $fetchdata['alamat'];
                $response['email'] = $email;
            }
	   
        echo json_encode($response);
    }else{
        $response['value'] = '0';
        echo json_encode($response);
    }
}
 
?>

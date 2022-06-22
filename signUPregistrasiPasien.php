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
    
    $query_insert= "INSERT INTO `tabel_pasien` SET `id_user`='$id_user',`nama_lengkap`='$nama_lengkap', 
    `profilePicture`='$path_image', `jenis_kelamin`= '$gender', `no_telepon`='$phone', `no_identitas`='$no_identitas', 
    `tanggal_lahir`='$dob',`alamat`='$alamat'";
   $hasil      = mysqli_query($con, $query_insert);
   if(!$hasil){
       printf("error : %s\n", mysqli_error($con));
       exit();
   }
    if(isset($hasil)){
       
             $response['value']= '1';
             $query_pasien   = "SELECT * FROM `tabel_pasien` WHERE `id_user` ='$id_user'";
            $hasil_pasien   = mysqli_query($con, $query_pasien);
            while ($fetchdata = mysqli_fetch_array($hasil_pasien)) {
                $response['id_user'] = $id_user;
                $response['role'] = $role;
                $response['id_pasien'] = $fetchdata['id_pasien'];
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

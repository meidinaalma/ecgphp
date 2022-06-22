<?php

require_once "koneksi.php";

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $response   = array();
    $email      = $_POST['email'];
    $password   = $_POST['password'];
    $query      = "SELECT * FROM `user_pasien` WHERE `email` ='$email' and `password` = '$password'";
    $hasil      = mysqli_query($con, $query);

    if(mysqli_num_rows($hasil)===0){
        $query      = "SELECT * FROM `user_dokter` WHERE `email` ='$email' and `password` = '$password'";
        $hasil      = mysqli_query($con, $query);
        if(mysqli_num_rows($hasil)===0){
            $response['value'] = '0';
            $response['message'] = 'Login Gagal';
            echo json_encode($response);
        } else{
            while($fetchdata = mysqli_fetch_array($hasil)){
                $response['id_dokter'] = $fetchdata['id_dokter'];
                $response['tipe_user'] = $fetchdata['tipe_user'];
                $response['username'] = $fetchdata["username"];
                $response['name'] = $fetchdata['name'];
                $response['foto_profil'] = $fetchdata['foto_profil'];
                $response['tanggal_lahir'] = $fetchdata['tanggal_lahir'];
                $response['phone'] = $fetchdata['phone'];
                $response['alamat'] = $fetchdata['alamat'];
                $response['email'] = $email;
                $response['role'] = '1';
                $response['value'] = '1';
            }
          echo json_encode($response);

        }
    } else{
        while ($fetchdata = mysqli_fetch_array($hasil)) {
            $response['id_pasien'] = $fetchdata['id_pasien'];
            $response['tipe_user'] = $fetchdata['tipe_user'];
            $response['username'] = $fetchdata["username"];
            $response['name'] = $fetchdata['name'];
            $response['foto_profil'] = $fetchdata['foto_profil'];
            $response['tanggal_lahir'] = $fetchdata['tanggal_lahir'];
            $response['phone'] = $fetchdata['phone'];
            $response['alamat'] = $fetchdata['alamat'];
            $response['email'] = $email;
            $response['role'] = '0';
            $response['value'] = '1';
        }
        echo json_encode($response);
    }

    // if(mysqli_num_rows($hasil)===0){
    //     $response['value'] = '0';
    //     $response['message'] = 'Login Gagal';
    //     echo json_encode($response);
    // }
    // else {
    //     $response['value'] = '1';
    //     $response['message'] = 'Login Berhasil';
    //     while ($fetchdata0 = mysqli_fetch_array($hasil)) {
    //         $id_user = $fetchdata0['id_user'];
    //         $role = $fetchdata0['tipe_user'];
    //         $username = $fetchdata0['username'];
    //         $email = $fetchdata0['email'];
            
    //     }
    //     if($role == 0){
    //         $query_pasien   = "SELECT * FROM `tabel_pasien` WHERE `id_user` ='$id_user'";
    //         $hasil_pasien   = mysqli_query($con, $query_pasien);
    //         while ($fetchdata = mysqli_fetch_array($hasil_pasien)) {
    //             $response['id_user'] = $id_user;
    //             $response['role'] = $role;
    //             $response['id_pasien'] = $fetchdata['id_pasien'];
    //             $response['username'] = $username;
    //             $response['name'] = $fetchdata['nama_lengkap'];
    //             $response['foto_profil'] = $fetchdata['profilePicture'];
    //             $response['tanggal_lahir'] = $fetchdata['tanggal_lahir'];
    //             $response['phone'] = $fetchdata['no_telepon'];
    //             $response['alamat'] = $fetchdata['alamat'];
    //             $response['email'] = $email;
    //         }
    //     }else{
    //         $query_dokter   = "SELECT * FROM `tabel_dokter` WHERE `id_user` ='$id_user'";
    //         $hasil_dokter   = mysqli_query($con, $query_dokter);
    //         while ($fetchdata = mysqli_fetch_array($hasil_dokter)) {
    //             $response['id_user'] = $id_user;
    //             $response['role'] = $role;
    //             $response['id_dokter'] = $fetchdata['id_dokter'];
    //             $response['username'] = $username;
    //             $response['name'] = $fetchdata['nama_lengkap'];
    //             $response['foto_profil'] = $fetchdata['profilePicture'];
    //             $response['tanggal_lahir'] = $fetchdata['tanggal_lahir'];
    //             $response['phone'] = $fetchdata['no_telepon'];
    //             $response['alamat'] = $fetchdata['alamat'];
    //             $response['email'] = $email;
    //         }
    //     }
    //     echo json_encode($response);
    // } 
}

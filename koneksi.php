<?php
define('HOST', 'localhost');
define('USER', 'u223061826_haloecgk');
define('PASS', 'Alma2905');
define('DB', 'u223061826_haloecgk');

$con = mysqli_connect('localhost', 'u223061826_haloecgk', 'Alma2905', 'u223061826_haloecgk');
if(!$con){
    echo("Gagal Terhubung ke Database!". mysqli_connect_error());
    die("Gagal Terhubung ke Database!". mysqli_connect_error());
} 
// else{
//     $response   = array();
//     $response['value'] = '1';
//     echo json_encode($response);
// }

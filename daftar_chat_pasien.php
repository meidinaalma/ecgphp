<?php
    require "koneksi.php";
    
    if($_SERVER['REQUEST_METHOD'] == "POST"){
        $response = array();
        $id_user = $_POST['id_user'];

        $query = "SELECT  DISTINCT A.doctor_name, B.hospital , B.profilePicture, B.id_user
                    FROM examinations A, users B
                    WHERE A.doctor_username = B.username
                    AND A.patient_code = '$id_user'";
        $hasil = mysqli_query($con,$query);

        if (!$hasil) {
            printf("Error: %s\n", mysqli_error($con));
            exit();
        }
        if(isset($hasil)){
            while ($fetchdata = mysqli_fetch_array($hasil)){
                $response[] = $fetchdata;      
            }
            echo json_encode($response);
        }
        else{
            echo json_decode('ERROR');
        }
    
    }
?>

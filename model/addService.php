<?php
require("../config/main.php");
$serviceName = $_POST['serviceName'];
$serviceDescription = $_POST['serviceDescription'];


$check = $db->query("SELECT * FROM services WHERE service_title = '$serviceName'")->fetchArray();
if(!$check){
     //add to db
    $save = $db->query("INSERT INTO services (service_title, service_description) VALUES ('$serviceName', '$serviceDescription')");
    if($save) echo 1;
    else echo 2;
}else{
   echo 3;
}

?>
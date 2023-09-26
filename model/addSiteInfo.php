<?php
require("../config/main.php");
$infoHeading = $_POST['infoHeading'];
$information = $_POST['information'];
$infoType = $_POST['infoType'];


$check = $db->query("SELECT * FROM information WHERE info_title='$infoHeading'")->fetchArray();
if($check){
    echo 3;
}else{
    //add to db
    $save = $db->query("INSERT INTO information (info_title, info_description, info_type) VALUES ('$infoHeading' ,'$information', '$infoType')");
    if($save) echo 1;
    else echo 2;
}

?>
<?php
require("../config/main.php");

$id = $_POST['id'];

$del =$db->query("delete FROM services WHERE services_id = '$id'");

if($del) echo 1;
else echo 2;
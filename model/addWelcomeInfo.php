<?php
require("../config/main.php");
$welcomeNote = $_POST['welcomeNote'];
$welcomeAnecdote = $_POST['welcomeAnecdote'];


$check = $db->query("SELECT * FROM welcome_notes WHERE notes_title='$welcomeNote'")->fetchArray();
if($check){
    echo 3;
}else{
    //add to db
    $save = $db->query("INSERT INTO welcome_notes (notes_id, notes_title, notes_description) VALUES (null ,'$welcomeNote', '$welcomeAnecdote')");
    if($save) echo 1;
    else echo 2;
}

?>
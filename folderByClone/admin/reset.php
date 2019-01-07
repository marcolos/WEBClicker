<?php
// CONTROLLO ACCESSO
include ('../../session.php');
$url = dirname(__FILE__);
$array = explode('/',$url);
$count = count($array);
$folder = $array[$count-2];
if ($folder!=$_SESSION['role']){
    header("location:/index.html");
}

// VIENE ESEGUITA QUESTA QUERY SE PREMO RESET ANSWERS
$idQuestion = $_POST['id'];
$conn->query("UPDATE QUESTIONS SET COUNTA='0',COUNTB='0',COUNTC='0',COUNTD='0',COUNTE='0' WHERE ID_QUESTION = '$idQuestion'");

?>
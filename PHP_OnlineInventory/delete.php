<?php

//Get values from view.php indicating current delete status and id of clicked dynamic link
$itemId=$_GET['id'];
$current=$_GET['info'];

//Connect to the Database
$secret = file('/home/int322_162a27/secret/topsecret.txt');
$dbobject = mysqli_connect(trim($secret[0]),trim($secret[1]),trim($secret[2]),trim($secret[3])) or die ("could not connect".mysqli_error($dbobject));

//Create query to change Delete data
if($current == 'n'){
$sql_query = "UPDATE inventory SET deleted='y' WHERE id= '$itemId'";
}
else{
$sql_query = "UPDATE inventory SET deleted='n' WHERE id= '$itemId'";
}

//Run our sql query
$result = mysqli_query($dbobject, $sql_query) or die('query failed'. mysqli_error($dbobject));

//Redirect to view.php
header("Location:http://zenit.senecac.on.ca/~int322_162a27/assign1/view.php");
?>

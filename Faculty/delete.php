<?php

require "../class/db.php";
session_start();

if(!isset($_SESSION['adminid']))
{
    header("location: ../login.php");
}

$id = $_GET['id'];

$sql = "Delete from tbl_faculty where fid=$id";

if($db->query($sql) == TRUE)
{
    echo"alert('Faculty successfully deleted!')";
    header("location: index.php");
}




?>
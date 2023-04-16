<?php

require "../class/db.php";
session_start();

if(!isset($_SESSION['adminid']))
{
    header("location: ../login.php");
}

$value = $_GET['item'];
$extract_id = explode(',' ,($_GET['checked']));

if($value=="delete")
{
    foreach($extract_id as $key=>$id)
    {
    $sql = "Delete from tbl_semester where semid=$id";
    $db->query($sql);
    }
}
else if($value=="active")
{
    foreach($extract_id as $key=>$id)
    {
    $sql = "Update tbl_semester set semStatus=1 where semid=$id";
    $db->query($sql);
    }
}
else if($value=="inactive")
{
    foreach($extract_id as $key=>$id)
    {
    $sql = "Update tbl_semester set semStatus=0 where semid=$id";
    $db->query($sql);
    }
}

header("location: index.php");

?>
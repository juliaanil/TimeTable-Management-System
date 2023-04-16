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
    $sql = "Delete from tbl_allocation where sid=$id";
    $db->query($sql);
    }
}
else if($value=="active")
{
    foreach($extract_id as $key=>$id)
    {
    $sql = "Update tbl_allocation set Status=1 where sid=$id";
    $db->query($sql);
    }
}
else if($value=="inactive")
{
    foreach($extract_id as $key=>$id)
    {
    $sql = "Update tbl_allocation set Status=0 where sid=$id";
    $db->query($sql);
    }
}

header("location: index.php");

?>
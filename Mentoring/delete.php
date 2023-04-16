<?php

require "../class/db.php";
session_start();

if(!isset($_SESSION['adminid']))
{
    header("location: ../login.php");
}

$id = $_GET['bid'];

// $sql1 = "Delete from tbl_mentoring where bid=$id";
// $sql2 = "Delete from tbl_mentoringfaculty where bid=$id";

// if($db->query($sql1) == TRUE and $db->query($sql2) == TRUE)
// {
//     echo"alert('Allocation successfully deleted!')";
//     header("location: index.php");
// }

$sql = "Delete from tbl_mentoring where bid=$id";


if($db->query($sql) == TRUE)
{
    echo"alert('Allocation successfully deleted!')";
    header("location: index.php");
}
$sql = "Delete from tbl_mentoringfaculty where bid=$id";


if($db->query($sql) == TRUE)
{
    echo"alert('Allocation successfully deleted!')";
    header("location: index.php");
}

?>
<?php
require "../class/db.php";
session_start();

if(!isset($_SESSION['adminid']))
{
    header("location: ../login.php");
}

if(!empty($_POST["semid"]))
{
    $sid = $_POST["semid"];
    $pid = $_POST["pid"];
    $sql_subject =  "select * from tbl_subject where pid=$pid and semid=$sid";
}

?>
<option value="">Select Subject</option>
<?php

$result_subject = $db->query($sql_subject);
if( $result_subject->num_rows > 0 )
{
    while( $subject_row = $result_subject->fetch_assoc())
    { ?>
    <option name="subid" value="<?php echo $subject_row['subid'];?>"><?php echo $subject_row['subname'];?></option>
    <?php
    }
}

?>
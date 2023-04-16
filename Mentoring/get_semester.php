<?php
require "../class/db.php";
session_start();

if(!isset($_SESSION['adminid']))
{
    header("location: ../login.php");
}

if(!empty($_POST["batchid"]))
{
    $bid = $_POST["batchid"];
    $sql_sem =  "select * from tbl_batch where bid=$bid";
}

?>
<option>Select Semester</option>
<?php

$result_sem = $db->query($sql_sem);
if( $result_sem->num_rows > 0 )
{
    while( $sem_row = $result_sem->fetch_assoc())
    { ?>
    <option name="semid" value="<?php echo $sem_row['bCurrentSem'];?>"><?php echo $sem_row['bCurrentSem'];?></option>
    <?php
    }
}

?>
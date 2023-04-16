<?php
require "../class/db.php";
session_start();

if(!isset($_SESSION['adminid']))
{
    header("location: ../login.php");
}

if(!empty($_POST["programid"]))
{
    $pid = $_POST["programid"];
    $sql_batch =  "select * from tbl_batch where pid=$pid";
}

?>

<option value="">Select Batch</option>

<?php

$result_batch = $db->query($sql_batch);
if( $result_batch->num_rows > 0 )
{
    while( $batch_row = $result_batch->fetch_assoc())
    { ?>
    <option name="bid" value="<?php echo $batch_row['bid'];?>"><?php echo $batch_row['bName'];?></option>
    <?php
    }
}

?>
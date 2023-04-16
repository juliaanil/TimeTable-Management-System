<?php

require "../class/db.php";

session_start();

if(isset($_SESSION['adminid']))
{
    //no need to do anything
}
else{
    header("location: ../login.php");
}
$sql_delete ="Delete from tbl_timetable";
$db->query($sql_delete);

$db->query("Alter table tbl_timetable auto_increment=0");

$sql_batch="Select * from tbl_batch where bStatus=1";
$batches=$db->query($sql_batch);
if($batches->num_rows>0)
{
    $batch_count=0;
    while($batch_row=$batches->fetch_assoc()) //for each batch row
    {
       
        //fetch batch, program and current semester
        $bid=$batch_row['bid'];
        $pid=$batch_row['pid'];
        $semid=$batch_row['bCurrentSem'];

        //fetch all subjects for that semester

        $sql_subject="Select * from tbl_allocation where bid=$bid and semid=$semid";
        $subjects = $db->query($sql_subject);
        $total_subjects = mysqli_num_rows($subjects); 

        //total number of subjects
        if($subjects->num_rows>0)
        {
            $sub = array();
            while($subject_row=$subjects->fetch_assoc())
            {
                $subid=$subject_row['subid'];
                $sub[] = $subid;
            }
        }
        else //if no subjects are allocated
        {
            continue;
        }
                                                                                        
        $daycount = 1;
        $hourcount = 1;

        $libday=$batch_count%5+1;
        $libcount=0;
        $mentoringday=$batch_count%5+1;
        $mentoringcount=0;

        while($daycount<=6) //initially $daycount=1
        {
            $s = $daycount-1; //initially $s=0  // echo $sub[$s];
            $hourcount = 1;                          //hr=1

            $day_array = array("1"=>"Monday","2"=>"Tuesday","3"=>"Wednesday","4"=>"Thursday","5"=>"Friday","6"=>"Saturday");
            $day = $day_array[$daycount];

            $libhour=3;
            $mentoringhour=4;
            while($hourcount<=6)
            {
               // allot library
                start:
                if($daycount==$libday && $hourcount==$libhour && $libcount<1)
                {

                    $sql_library = "Select * from tbl_library";
                    $library = $db->query($sql_library);
                    if($library->num_rows)
                    {
                        while($libraryrow=$library->fetch_assoc())
                        {
                            $libraryfid=$libraryrow['fid'];
                            $libraryid=$libraryrow['id'];
                        }
                    }
                    //select all faculties who are already allotted for that day and hour in other batches

                    $sql_currentfaculty="Select fid from tbl_timetable where day='$day' and hour=$hourcount and bid!=$bid"; 
                    $currentfaculty = $db->query($sql_currentfaculty);
                    if($currentfaculty->num_rows>0)
                    {
                        while($currentfaculty_row=$currentfaculty->fetch_assoc())
                        {
                            if($currentfaculty_row['fid'] == $libraryfid)
                            {
                                $libhour=$libhour+2;
                                goto start;
                            }
                            // else continue loop
                        }
                    }
                    $sql_insert = "Insert into tbl_timetable(bid,semid,day,hour,subid,fid) values ($bid,$semid,'$day',$hourcount,$libraryid,$libraryfid)";
                    $db->query($sql_insert);
                    $libcount+=1;
                    $hourcount=$hourcount+1;
                }

                startmentoring:
                if($daycount==$mentoringday && $hourcount==$mentoringhour && $mentoringcount<1)
                {

                    $sql_mentoring = "Select * from tbl_mentoringfaculty where bid=$bid";
                    $mentoring = $db->query($sql_mentoring);
                    if($mentoring->num_rows)
                    {
                        while($mentoringrow=$mentoring->fetch_assoc())
                        {
                            $mentoringfid=$mentoringrow['fid'];
                            
                        }
                    }
                    //select all faculties who are already allotted for that day and hour in other batches

                    $sql_currentfaculty="Select fid from tbl_timetable where day='$day' and hour=$hourcount and bid!=$bid"; 
                    $currentfaculty = $db->query($sql_currentfaculty);
                    if($currentfaculty->num_rows>0)
                    {
                        while($currentfaculty_row=$currentfaculty->fetch_assoc())
                        {
                            if($currentfaculty_row['fid'] == $mentoringfid)
                            {
                                $mentoringhour=$mentoringhour+2;
                                goto startmentoring;
                            }
                            // else continue loop
                        }
                    }
                    $sql_insert = "Insert into tbl_timetable(bid,semid,day,hour,subid,fid) values ($bid,$semid,'$day',$hourcount,2,0)";
                    $db->query($sql_insert);
                    $mentoringcount+=1;
                    $hourcount=$hourcount+1;
                }

                else //allot subjects
                {

                    
                    label1: 
                    if($s>$total_subjects-1)           //0 to 6 for 7 subjects
                    {
                    $s = $s%$total_subjects; //to go in circular fashion in array
                    } 
                    $currentsubid = $sub[$s];    
                             // 3
                    $sql_currentfid = "Select fid from tbl_allocation where subid=$currentsubid";
                    $subtype="Select subtype from tbl_subject where subid=$currentsubid";
                    $currentfids = $db->query($sql_currentfid); 
                    if($currentfids->num_rows>0)
                    {
                        while($currentfidrow=$currentfids->fetch_assoc())
                        {
                            $currentfid=$currentfidrow['fid'];   //select faculty for that subject
                        }
                    }

                    //select all faculties who are already allotted for that day and hour in other batches
                    // if($hourcount==1)
                    //     $sql_currentfaculty="Select fid from tbl_timetable where day!='$day' and hour=$hourcount and bid=$bid"; 
                    // else
                   if(($subtype==0)&&($hourcount!=1)&&($hourcount!=6))
                   {
                    $sql_currentfaculty="Select fid from tbl_timetable where day='$day' and hour=$hourcount and bid!=$bid"; 
                    $sql_currentfacultynext="Select fid from tbl_timetable where day='$day' and hour=$hourcount+1 and bid!=$bid";


                    $currentfaculty = $db->query($sql_currentfaculty);
                    $currentfacultynext = $db->query($sql_currentfacultynext);
                
                    if($currentfaculty->num_rows>0)
                    {
                        while($currentfaculty_row=$currentfaculty->fetch_assoc())
                        {
            
                            if($currentfaculty_row['fid'] == $currentfid)
                            {
                                $s=$s+1;
                                goto label1;
                            }
                            
                            // else continue loop
                        }
                    }
                
                    if($currentfacultynext->num_rows>0)
                    {
                        while($currentfaculty_row=$currentfaculty->fetch_assoc())
                        {
            
                            if($currentfaculty_row['fid'] == $currentfid)
                            {
                                $s=$s+1;
                                goto label1;
                            }
                            
                            // else continue loop
                        }
                    }
                
                    $sql_insert = "Insert into tbl_timetable(bid,semid,day,hour,subid,fid) values ($bid,$semid,'$day',$hourcount,$currentsubid,$currentfid)";
                    $db->query($sql_insert);
                    $sql_insert = "Insert into tbl_timetable(bid,semid,day,hour,subid,fid) values ($bid,$semid,'$day',$hourcount+1,$currentsubid,$currentfid)";
                    $db->query($sql_insert);
                    $hourcount=$hourcount+2;
                   }
                   else
                   {

                  
                        $sql_currentfaculty="Select fid from tbl_timetable where day='$day' and hour=$hourcount and bid!=$bid"; 

                    $currentfaculty = $db->query($sql_currentfaculty);
                
                    if($currentfaculty->num_rows>0)
                    {
                        while($currentfaculty_row=$currentfaculty->fetch_assoc())
                        {
                            if($currentfaculty_row['fid'] == $currentfid)
                            {
                                $s=$s+1;
                                goto label1;
                            }
                            // else continue loop
                        }
                    }
                    $sql_insert = "Insert into tbl_timetable(bid,semid,day,hour,subid,fid) values ($bid,$semid,'$day',$hourcount,$currentsubid,$currentfid)";
                    $db->query($sql_insert);
                    $hourcount=$hourcount+1;
                }
                   
                  
                    $s=$s+1;
                    
                }

               
            }

            $daycount=$daycount+1;
        }
        $batch_count+=1;
    }//end of batch row
}

$_SESSION['msg'] = "Timetable generated successfully!";
header("location: ../index.php");

?>
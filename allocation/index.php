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

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Timetable Management System</title>

    <!-- Custom fonts for this template-->
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../css/main.css" rel="stylesheet">
    <link href="../css/style.css" rel="stylesheet">
    <script type="text/javascript">

        function selectAll() {
        
            let main = document.getElementById("checkbox-main");
            let row = document.getElementsByClassName("checkbox-child");   // alert(row.length);
            
            for (let i = 0; i < row.length; i++) {
                if(main.checked==true)
                    row[i].checked=true;
                else 
                    row[i].checked=false;
            }
        }
        arr = [];
        function multipleSelect(clickedid) {
            let row = document.getElementsByClassName("checkbox-child");
            
            for (let i=0; i<row.length; i++) {
                if(row[i].checked==true)
                arr.push(row[i].value);
            }
            if(clickedid=='delete_multiple') {
                if(confirm("Are you sure you want to delete?")==true)
                window.location.href = "multiple-select.php?checked="+arr+"&item=delete";
            }
            else if(clickedid=='make-active') {
                if(confirm("Are you sure you want to change the status to Active?")==true)
                window.location.href = "multiple-select.php?checked="+arr+"&item=active";
            }
            else if(clickedid=='make-inactive') {
                if(confirm("Are you sure you want to change the status to Inactive?")==true)
                window.location.href = "multiple-select.php?checked="+arr+"&item=inactive";
            }

        }
    </script>

</head>


<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <div class=" sidebar-brand-text d-flex mt-3 justify-content-center">
                <image class="" src="../img/scms-logo.jpg" style="width:60px"></image>
            </div>
            <a class="sidebar-brand d-flex mb-3 align-items-center justify-content-center" href="index.html">
                <div class="sidebar-brand-text">Timetable Management System </div> 
            </a>
            
            
            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <li class="nav-item">
                <a class="nav-link" href="../timetable/index.php">
                    <i class="fas fa-fw fa-clock"></i> 
                    <span>Timetable</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">
            

            <li class="nav-item">
                <a class="nav-link" href="../program/index.php">
                    <i class="fas fa-fw fa-user-graduate"></i>
                    <span>Program</span>
                </a>
            </li>
           

            <!-- Divider -->
            <hr class="sidebar-divider my-0">
            

            <li class="nav-item">
                <a class="nav-link" href="../batch/index.php" >
                    <i class="fas fa-fw fa-users"></i>
                    <span>Batch</span>
                </a>
            </li>

             <!-- Divider -->
             <hr class="sidebar-divider my-0">
             
            <li class="nav-item">
                <a class="nav-link" href="../semester/index.php" >
                    <i class="fas fa-columns"></i>
                    <span>Semester</span>
                </a>
            </li>

             <!-- Divider -->
             <hr class="sidebar-divider my-0">

            <li class="nav-item">
                <a class="nav-link collapsed" href="../subject/index.php" >
                    <i class="fas fa-fw fa-book"></i>
                    <span>Subject</span>
                </a>
            </li>
           
            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <li class="nav-item">
                <a class="nav-link collapsed" href="../faculty/index.php" >
                    <i class="fas fa-fw fa-user"></i>
                    <span>Faculty</span>
                </a>
            </li>
            
            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <li class="nav-item">
                <a class="nav-link collapsed" href="index.php" >
                    <i class="fas fa-fw fa-tasks"></i>
                    <span>Subject Allocation</span>
                </a>
            </li>
            <hr class="sidebar-divider my-0">
            <li class="nav-item">
                <a class="nav-link collapsed" href="../invigilation/index.php" >
                    <i class="fas fa-diagnoses"></i>
                    <span>Invigilation</span>
                </a>
            </li>
            <hr class="sidebar-divider my-0">
            <li class="nav-item">
                <a class="nav-link collapsed" href="../mentoring/index.php" >
                <i class="fas fa-portrait"></i>
                    <span>Mentoring</span>
                </a>
            </li>
            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

         

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content" class="bg-gray-200">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Search -->
                    <!-- <form
                        class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                            <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..."
                                aria-label="Search" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form> -->

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown  -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                           
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-gray-200 border-0 small"
                                            placeholder="Search for..." aria-label="Search"
                                            aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>

                        <!-- Nav Item - Alerts -->
                        <li class="nav-item dropdown no-arrow mx-1">
                           
                        </li>

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Administrator</span>
                                <img class="img-profile rounded-circle"
                                    src="../img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                
                                <div class="dropdown-divider"></div>
                                <div class="dropdown-item">
                                <i class="fas fa-signout-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                <a class="text-decoration-none" href="../logout.php">Logout</a>
                                </div>
                                <!-- <input type="submit" value="Logout" name="logout" class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal"/> -->
                                    <!-- 
                                    Logout -->
                                 <!-- </input> -->
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                  <!-- Begin Page Content -->
                  <div class="container-fluid">

<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800 text-center">SUBJECT ALLOCATION</h1>
<div>
    <?php  
        if(isset($_SESSION['msg'])) {
            echo "<div class='message'>".$_SESSION['msg']."</div>";
            unset($_SESSION['msg']);
    }
    ?>
</div>
<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header">

        <form action="add.php" method="POST">
        <div style="float:right;" class="font-weight-bold text-right">
            <button type="submit" class="btn-sm btn-primary a-btn-slide-text">
            <span class="glyphicon glyphicon-edit fas fa-sm fa-plus" aria-hidden="true"></span>
            <span width=400><strong>New</strong></span>
            </a>
        </div>
        </form>

        <div style="float:left;" class="font-weight-bold text-left">
            <button class="btn-sm btn-danger a-btn-slide-text" id="delete_multiple" onclick=multipleSelect(this.id)>
            <span class="glyphicon glyphicon-edit  " aria-hidden="true"></span>
            <span width=400><strong>Delete</strong></span>
            </button>
        </div>
        <div style="float:left" class="ml-1 py-0 font-weight-bold text-primary text-left">
            <button class="btn-sm btn-primary a-btn-slide-text" id="make-active" onclick=multipleSelect(this.id)>
            <span class="glyphicon glyphicon-edit  " aria-hidden="true"></span>
            <span width=400><strong>Make Active</strong></span>
            </button>
        </div>
        <div style="float:left" class="ml-1 py-0 font-weight-bold text-primary text-left">
            <button class="btn-sm btn-primary a-btn-slide-text" id="make-inactive" onclick=multipleSelect(this.id)>
            <span class="glyphicon glyphicon-edit  " aria-hidden="true"></span>
            <span width=400><strong>Make Inactive</strong></span>
            </button>
        </div>

        
        
    </div>
    <div class="card-body">
        <div class="table-responsive">
        <?php
                        $sql1="select * from tbl_allocation";
						$result1=$db->query($sql1);
						if($result1->num_rows >0)
						{?>
                        
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <tbody>
                        <tr>
                            <!-- <th>
                            <b><input type='button' id="delete" value='Delete' name='delete'></b></th> -->
                            <th style="justify-content:center; text-align:center;" >
                            
                    
                            <input style='vertical-align:bottom;width:14px;height:15px;' name='checkbox-main' type='checkbox' value='Select All' id='checkbox-main' onclick=selectAll() >
                         
                            </th>
                            
                            <th style="text-align:center;width:1px"><b>Program</b></th>
                            <th style="text-align:center;"><b>Batch</b></th>
                            <th style="text-align:center;"><b>Faculty</b></th>
                            <th style="text-align:center;"><b>Semester</b></th>
                            <th style="text-align:center;"><b>Subject</b></th>
                            <th style="text-align:center;"><b>Status</b></th>
                            <th style="text-align:center;"><b>Edit</b></th>
                            <th style="text-align:center;"><b>Delete</b></th>
                            
                        </tr>
                        <?php 

						while($row = $result1->fetch_assoc())
						{   $sid=$row['sid'];
                            $subid=$row['subid'];
                            $bid=$row['bid'];
                            $semid=$row['semid'];
                            $pid=$row['pid'];
                            $fid=$row['fid'];
			            ?>

                        <tr>
                       <td style="justify-content:center; text-align:center" width="5%"> 
                            <input  type="checkbox"  style="vertical-align:bottom;width:14px;height:15px" class="checkbox-child" name="check_list[]"  value=<?php echo $row['sid']; ?> >
                                  
                        </td>
                        
                        </form>
                        
                        <!-- <td style="justify-content:center; text-align:center" width="70%"> <?php echo $row["sid"]; ?> </td>-->
                        
                        <?php  $sql2="select pName from tbl_program where pid in (select pid from tbl_allocation where sid=$sid)"; 
                       $result2=$db->query($sql2);
                       if($result2->num_rows>0)
                            {
                            while($row2 = $result2->fetch_assoc())
						{?>
                         <td style="justify-content:center; text-align:center" width="70%"> <?php echo $row2["pName"]; ?> </td>
                        <?php
                    }}
                    ?>
                      <?php  $sql2="select bName from tbl_batch where bid in (select bid from tbl_allocation where sid=$sid)"; 
                       $result2=$db->query($sql2);
                       if($result2->num_rows>0)
                            {
                            while($row2 = $result2->fetch_assoc())
						{?>
                         <td style="justify-content:center; text-align:center" width="70%"> <?php echo $row2["bName"]; ?> </td>
                        <?php
                    }}
                    ?>
                        
                        <?php  $sql2="select fName from tbl_faculty where fid in (select fid from tbl_allocation where sid=$sid)"; 
                       $result2=$db->query($sql2);
                       if($result2->num_rows>0)
                            {
                            while($row2 = $result2->fetch_assoc())
						{?>
                         <td style="justify-content:center; text-align:center" width="70%"> <?php echo $row2["fName"]; ?> </td>
                        <?php
                    }}
                    ?>
                       
                       
                        
                        <td style="justify-content:center; text-align:center" width="70%"> <?php echo $row["semid"]; ?> </td>
                        <?php  $sql2="select subname from tbl_subject where subid in (select subid from tbl_allocation where sid=$sid)"; 
                       $result2=$db->query($sql2);
                       if($result2->num_rows>0)
                            {
                            while($row2 = $result2->fetch_assoc())
						{?>
                         <td style="justify-content:center; text-align:center" width="70%"> <?php echo $row2["subname"]; ?> </td>
                        <?php
                    }}
                    ?>
                       
                        <td style="justify-content:center; text-align:center" width="10%"> 
                            <?php 
                                if($row["Status"]==1) {?>
                                <span style="color:green" class="glyphicon glyphicon-edit fas fa-md mt-1 py-2 fa-check " aria-hidden="true"></span> 
                            <?php
                                }
                                else if($row["Status"]==0) { ?> 
                                <span style="color:maroon" class="glyphicon glyphicon-edit fas fa-lg mt-1 py-2 fa-times" aria-hidden="true"></span>
                            <?php } ?>
                        </td>
                      <!-- Edit button -->
                      <td style="justify-content:center; text-align:center" width="10%"> 
                            <a href="edit.php?sid=<?php echo $row['sid']?>"  style="background-color:white;" class="btn btn-light a-btn-slide-text">
                            <span style="color:orange" class="glyphicon glyphicon-edit fas fa-pencil-alt" aria-hidden="true"></span>
                            </a>
                        </td>
                        <!--<td><?php echo $row["sid"]; ?></td>-->
                        <!-- Delete button -->
                        <td style="justify-content:center; text-align:center" width="10%"> 
                            <a href="delete.php?id=<?php echo $row['sid']; ?>" onclick="return confirm('Are you sure you want to delete?')" 
                              style="background-color:white;" class="btn btn-light a-btn-slide-text">
                            <span style="color:red" class="glyphicon glyphicon-edit fas fa-md fa-trash" aria-hidden="true"></span>
                            </a>
                        </td>

                       
                        </tr>
                        
                        <?php
                            }
                        }?>
						
                </tbody>
                
            </table>
        </div>
    </div>
</div>

</div>
<!-- /.container-fluid -->

</div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class=" sticky-footer bg-white ">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; SSTM 2022</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>



    <!-- Bootstrap core JavaScript-->
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="../vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="../js/demo/chart-area-demo.js"></script>
    <script src="../js/demo/chart-pie-demo.js"></script>
   
</body>

</html>
<?php 
	error_reporting(0);
	session_start();
	
	require "../class/db.php";

    if(!isset($_SESSION['adminid'])) 
    {
        header("location: ../login.php");
    }
    $invid = $_GET['invid'];
    $sql1="select * from tbl_invigilation where invid=$invid";
    
    $result1=$db->query($sql1);
    if($result1->num_rows >0)
    { 
        while($row =$result1->fetch_assoc())
        {
        
            $invid=$row['invid'];  
            $fid=$row['fid'];
            $date=$row['date'];
            $day=$row['day'];
            $status=$row['status'];
            $session=$row['session'];
          
          
        }
    }
   
    
	if (isset($_POST["submit"]))
	{    
            
       
            //$newinvid=$_POST['invid']; 
           // $newpid=$_POST['pName'];
            $newfid=$_POST['fName'];
            $newdate=$_POST['date'];
            $newday=$_POST['day'];
            $newsession=$_POST['session'];
          
            
                $sql = "update tbl_invigilation set fid = '$newfid',date = '$newdate',day = '$newday',session= '$newsession' where invid = '$invid'";
                if($db->query($sql) == TRUE)
                { 
                $_SESSION['msg'] = "Invigilation duty updated successfully!";
                header("location: index.php");
                }
                else
                {  
                ?> 
                <script> alert("Error!!"); </script>
                <?php
                echo " ".$db->error; 
                }  
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
                <a class="nav-link" href="../index.php">
                    <i class="fas fa-fw fa-clock"></i> 
                    <span>Timetable</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">
            

            <li class="nav-item">
                <a class="nav-link" href="../program/index.php" >
                    <i class="fas fa-fw fa-user-graduate"></i>
                    <span>Program</span>
                </a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">
            

            <li class="nav-item">
                <a class="nav-link" href="index.php" >
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
                <a class="nav-link collapsed" href="../allocation/index.php" >
                    <i class="fas fa-tasks"></i>
                    <span>Subject allocation</span>
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
                <div  class="main-panel align-middle ">
			<div style="min-height: 77vh;" class="bg-light content">

			
			

				<div class="col-md-12 ">
					<div class="card mt-4 bg-white">
						<div class="card-header">
						<div class="card-title"> 
							<!--<h3 style="font-size: 30px; display: inline-block;"> Program </h3>-->
						</div>
						</div>
						<div class="card-body">
							<div class="col-md-5 mr-auto ml-auto ">
								<div class="card mt-4  bg-white	">
									<div class="card-header">
										<div class="card-title">
											 Edit invigilation duty
                                            
										</div>
									</div>
									<div class="card-body">
                                   
										<form action="" method="POST">
                                        
                                        <div class="form-group">
												<label for="exampleInputEmail1">Enter faculty</label>
                                               
                                                <select name="fName" class="form-control" required>
                                                   
                                                    <?php 
													$sql="select * from tbl_faculty where fStatus=1";
                                                                    $result=$db->query($sql);
                                                                    if($result->num_rows >0)
                                                                    { while($row =$result->fetch_assoc())
                                                                    {
                                                        ?>
                                                        <option value="<?php echo $row["fid"]; ?>" <?php if($row['fid']==$pid){ ?>selected="selected"<?php } ?>> <?php echo $row["fName"] ;?> </option>
                                                        <?php
                                                        }
                                                        }
                                                    ?>  
												</select> 
                                                
												<!--<p style = "color: red;"><?php echo $errMsg; ?></p>  --> 
											</div>
                                          
											<div class="form-group">
												<label for="exampleInputEmail1">Enter Date</label>
                                               <!-- <input type="text" autofocus name="bName" class="form-control" placeholder="<?php echo $date; ?>" required />-->
                                                <input type="date" autofocus name="date" class="form-control"  required value="<?php echo $date; ?>"/>
												<!--<p style = "color: red;"><?php echo $errMsg; ?></p>  --> 
											</div>
                                            <div class="form-group">
												<label for="exampleInputEmail1">Day</label>
                                                <select name="day" class="form-control" required>
                                                    <option value="<?php echo $day?>"><?php echo $day?></option>
                                                    <?php
                                                        $nday=array("monday","tuesday","wednesday","thursday","friday","saturday");
                                                        foreach ($nday as $val)
                                                        {
                                                            if($val!=$day)
                                                            { ?>
                                                                <option value="<?php echo $val?>"><?php echo $val?></option>
                                                        <?php }
                                                        }
                                                    ?>
                                                </select>
											</div>
                                            </div>
                                            <div class="form-group">
												<label for="exampleInputEmail1">Session</label>
                                                <select name="session" class="form-control" required>
                                                    <option value="<?php echo $session?>"><?php echo $session?></option>
                                                    <?php
                                                        $nsession=array("morning","afternoon");
                                                        foreach ($nsession as $val)
                                                        {
                                                            if($val!=$session)
                                                            { ?>
                                                                <option value="<?php echo $val?>"><?php echo $val?></option>
                                                        <?php }
                                                        }
                                                    ?>
                                                </select>
											</div>
                                            <!-- <div class="form-group">
												<label for="exampleInputEmail1">Select day</label>
                                               <select name="day" class="form-control" required>
                                              
                                               <option value="">Day</option>
                                                <option value="monday">Monday</option>
                                                <option value="tuesday">Tuesday</option>
                                                <option value="wednesday">Wednesday</option>
                                                <option value="thursday">Thursday</option>
                                                <option value="friday">Friday</option>
                                                <option value="saturday">Saturday</option>
                                                </select>
											</div>
                                            <div class="form-group">
												<label for="exampleInputEmail1">Select session</label>
                                                <select name="session" class="form-control" required>
                                            
                                                <option value="">Session</option>
                                                <option value="morning">Morning</option>
                                                <option value="afternoon">Afternoon</option>
                                                </select>
											</div> -->
                                            <!-- <div class="form-group">
												<label for="exampleInputEmail1">Session</label>
                                                <input type="text" autofocus name="session" class="form-control"  required value="<?php echo $session; ?>" />
											</div> -->
											<div class="form-group">
											<button name="submit" type="submit" class="btn btn-primary ml-3 float-right">Submit</button>
											<a href="index.php"><input type="button" value="Back" class="btn btn-danger float-right"></a>
                                            </div>
										</form>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
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
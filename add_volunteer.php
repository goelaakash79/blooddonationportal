<?php
session_start();
$redirect6 = (isset($_REQUEST['redirect'])) ? $_REQUEST['redirect'] :
'notfound.html';

if(!isset($_SESSION['id'])||($_SESSION['type']!='UA'))
{
  header("Refresh:0;URL=".$redirect6);
	die();
}
else
{
?>
<!DOCTYPE html>
<html lang="en">
<head>
   
     <meta charset="UTF-8" />
    <title>Uddeshhya Admin</title>
     <meta content="width=device-width, initial-scale=1.0" name="viewport" />
	<meta content="" name="description" />
	<meta content="" name="author" />
	<link rel="stylesheet" href="assets/plugins/bootstrap/css/bootstrap.css" />
    <link rel="stylesheet" href="assets/css/main.css" />
    <link rel="stylesheet" href="assets/css/theme.css" />
    <link rel="stylesheet" href="assets/css/MoneAdmin.css" />
    <link rel="stylesheet" href="assets/plugins/Font-Awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/plugins/Font-Awesome/css/font-awesome.css" />
	<link href="assets/plugins/dataTables/dataTables.bootstrap.css" rel="stylesheet" />
    <script>
	function check()
	{
		return confirm("Sure To Delete..??");
	}
	</script>
   </head>
<body class="padTop53 " >  
    <div id="wrap">    
       <?php include 'dynamictop.php';
				include 'dynamicleft.php'	   ?>

        <div id="content">

            <div class="inner" style="min-height:1200px;">
                <div class="row">
                    <div class="col-lg-12">

                        <h2>Add Uddeshhya Admin</h2>

                    </div>
                </div>
<hr />

                              <table class="table table-striped table-hover" id="dataTables-example">
                                <thead>
                                  <tr>
                                    <th><div class="col-lg-1"><center>#</center></div>
									<div class="col-lg-3"><center>Name</center></div>
									<div class="col-lg-1"><center>Contact</center></div>
									<div class="col-lg-1"><center>Alternate<br>Contact</center></div>
									<div class="col-lg-2"><center>Email Id</center></div>
									<div class="col-lg-2"><center>Assigned State</center></div>
									<div class="col-lg-2"><center>View Detail</center></div></th>
                                  </tr>
                                </thead>
                                <tbody>
                     <?php $i=1;
							$query="Select Email,Id from login where Type='NA'";
							$res=mysql_query($query)or die(mysql_error());
							while($row=mysql_fetch_assoc($res))
							{
								$email=$row['Email'];
								$id=$row['Id'];
								$qry="Select * from members where User_Id='$id'";
								$res1=mysql_query($qry)or die(mysql_error());
								$row1=mysql_fetch_assoc($res1);
								$name=$row1['Name'];
								$Age=$row1['Age'];
								$s=$row1['Sex'];
								if($s=='M')
									$sex='Male';
								if($s=='F')
									$sex='Female';
								$a=$row1['Address'];
								$b=$row1['City'];
								$c=$row1['State'];
								$qry2="Select State_Name from state where id='$c'";
								$res2=mysql_query($qry2) or die(mysql_error());
								$row2=mysql_fetch_assoc($res2);
								$c=$row2['State_Name'];
								$pin=$row1['Pincode'];
								$phone=$row1['phone'];
								$ap=$row1['Alternate_Phone'];
								$sta=$row1['Assign_State'];
								$aa=$row1['scan'];
								$check=0;
								if($sta=='')
									$check=1;
								$st1=explode('_',$sta);
								$st=array();
								for($k=0;$k<count($st1);$k++)
								{
								$qry1="Select State_Name from state where id='$st1[$k]'";
								$res1=mysql_query($qry1) or die(mysql_error());
								$row1=mysql_fetch_assoc($res1);
								$st[$k]=$row1['State_Name'];
								}
								?>
							<tr>
                                    <td><div class="col-lg-1"><center><?php echo $i++; ?></center></div>
									<div class="col-lg-3"><center><?php echo $name; ?></center></div>
									<div class="col-lg-1"><center><?php echo $phone; ?></center></div>
									<div class="col-lg-1"><center><?php echo $ap; ?></center></div>
									<div class="col-lg-2"><center><?php echo $email; ?></center></div>
									<div class="col-lg-2"><center><?php 
									if($check==1)
									{
										echo '----';
									}
								else{
									for($k=0;$k<count($st);$k++)
										echo ($k+1).'. '.$st[$k].'<br>'; 
								}
								?></center></div>
                                  <div class="col-lg-2"><center><button class="btn btn-success btn-rounded" data-toggle="modal" data-target=".bs-example-modal-sm<?php echo $i; ?>">View Detail</button></center></div>
								  </td></tr>
								  <div class="modal fade bs-example-modal-sm<?php echo $i; ?>" tabindex="-1" role="dialog">
									<div class="modal-dialog modal-sm">
									  <div class="modal-content">
										  <div class="modal-header">
											  <button aria-hidden="true" data-dismiss="modal" class="close" type="button">&times;</button>
											  <h4 class="modal-title"><?php echo $name; ?></h4>
										  </div>
										  <div class="modal-body">
										  <form action="delete_ua.php" method="post">
										  <?php echo '<center><b>Age </b> : '.$Age.' &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<b>Gender: </b> '.$sex.'</center><br>';
										  echo '<center><b>Address: </b> '.$a.'<br>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp'.$b.'-'.$pin.'</center><br>';
										  echo '<center><b>State: </b> '.$c.'</center><br>';
										  echo '<center><b>Phone: </b> '.$phone.' <br><b>Alternate phone: </b>'.$ap.'</center><br><br>';
										  if($_SESSION['type']=='A')
										  echo '<center><a target="_blank" href="images/'.$aa.'"><b>Click Here To Download Id Card </b></a></center><br>';
										  echo '<center><a href="answers.php?id='.$id.'"><b>Click Here To View Answers </b></a><br><br>';
										  echo '<center><b>Email-Id: </b> '.$email.'</center><br>';
										  ?></form></div>
									  </div>
									</div>
								</div>
								  <?php
								  }
									?>
								  </tbody>
                                 </table>
						</div>




        </div>
       <!--END PAGE CONTENT -->


    </div>

     <!--END MAIN WRAPPER -->

   <!-- FOOTER -->
    <div id="footer">
        <p>&copy;  Uddeshhya &nbsp;<?php echo date('Y'); ?> &nbsp;</p>
    </div>
    <!--END FOOTER -->
     <!-- GLOBAL SCRIPTS -->
    <script src="assets/plugins/jquery-2.0.3.min.js"></script>
     <script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/plugins/modernizr-2.6.2-respond-1.1.0.min.js"></script>
    <!-- END GLOBAL SCRIPTS -->
	<script src="assets/plugins/dataTables/jquery.dataTables.js"></script>
    <script src="assets/plugins/dataTables/dataTables.bootstrap.js"></script>
     <script>
         $(document).ready(function () {
             $('#dataTables-example').dataTable();
         });
    </script>
</body>
    <!-- END BODY-->
    
</html>
<?php } ?>

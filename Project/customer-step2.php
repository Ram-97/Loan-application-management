<?php
   include('session.php');
   $cus_id=$row['id'];
   $sql="Select * from documents where cus_id='$cus_id'";
   $res=mysqli_query($db,$sql);
   $row1=mysqli_fetch_array($res,MYSQLI_ASSOC);
?>

<html>
<head>
<title>LR bank</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="images/customer.jpg" rel="icon" type="image/jpg"/>
</head>

<body bgcolor="lightgrey" > 
<div class="container-fluid">  
    <nav class="navbar navbar-dark bg-primary">
        <div class="container-fluid">
            <div class="navbar-header">
                <div class="navbar-brand " >Welcome <?php echo $login_session; ?></div>
            </div>
            <ul class="nav navbar-nav navbar-right">
            <li> 
                <a class="btn btn-primary" data-toggle="modal" data-target="#myModal">Track status</a>
                    <div class="modal fade" id="myModal" role="dialog">
                          <div class="modal-dialog">
                              <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title text-primary">Status</h4>
                              </div>
                              <div class="modal-body">  
                                        <div class="progress">
                                             <div class="progress-bar progress-bar-striped" role="progressbar" style="width:<?php if($row1['percentage']!='')  {echo $row1['percentage'];} else { echo '20%';} ?>" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100">
                                             <?php if($row1['percentage']!='')  {echo $row1['percentage'];} else { echo '20%';} ?>
                                            </div>
                                        </div>
                                        <?php
                                         if($row1['bankerresult']!=''){
                                            echo '<h5 class="text-center text-warning">Your Application '.$row1['bankerresult'].'</h5>';
                                         }
                                        ?>
                                        <table class="table table-responsive table-hover text-center text-info">
                                            <tr> <td> 20% </td> <td> Account Approved </td>
                                            <tr> <td> 50% </td> <td> Phase 1 Completed </td>
                                            <tr> <td> 80% </td> <td> Phase 2 Completed </td>
                                            <tr> <td> 100% </td> <td> Loan Approved </td>
                                        </table>
                              </div>  
                              </div>
                            </div>
                    </div>
                </li>
                <li><a href = "customer-settings.php" class="btn btn-primary"> <span class="glyphicon glyphicon-wrench"></span> Settings</a></li>
                <li> <a href = "logout.php" class="btn btn-primary"> <span class="glyphicon glyphicon-log-out "></span> Sign Out</a>  </li>
            </ul>
        </div>
    </nav>
    <br/>
   <div class="col-md-10 col-md-offset-1">   
        <ul class="nav nav-tabs nav-justified">
            <li><a href="customer-Welcome.php">Step 1</a></li>
            <li class="active"><a href="customer-step2.php">Step 2</a></li>
            <li><a href="customer-step3.php">Step 3</a></li>
        </ul>
        <br/>

        <div class="panel panel-info">
        <div class="panel-heading">
                <h5 class="text-center"> Upload Documents </h5>
        </div>
        <div class="panel-body">
            <div>
            <?php
                if($row1['accept']=='Accepted')
                {
                    echo' <p class="alert alert-success text-center text-capitalize"> you have submitted successfully </p>';
                }
            ?>
            </div>
        <form action="customer-upload.php" method="post" enctype="multipart/form-data" class="form-group">
               <div class="col-md-2 col-md-offset-1"> </div> <div class="col-md-2"> <label>Amount Needed:</label>  </div>
               <div class="col-md-5"><input type="text" name="amount_needed" class="form-control" placeholder="Enter the amount" value="<?php echo $row1['amount_needed'];?>" required/> </div>
               <br/><br/>
               <div class="col-md-2 col-md-offset-1"> </div> <div class="col-md-2"> <label>Income Certificate No:</label> </div>
               <div class="col-md-5"> <input type="text" name="income_no" class="form-control" placeholder="Enter income certificate no" value="<?php echo $row1['income_no'];?>" required/> </div>
               <br/><br/><br/>
               <div class="col-md-2 col-md-offset-1"> </div> <div class="col-md-2"> <label>Birth Certificate No:</label> </div>
               <div class="col-md-5"> <input type="text" name="birth_no" class="form-control" placeholder="Enter birth certificate no" value="<?php echo $row1['birth_no'];?>" required/> </div>
               <br/><br/><br/>
               <div class="col-md-2 col-md-offset-1"> </div> <div class="col-md-2"> <label>Aadhaar No:</label> </div>
               <div class="col-md-5"> <input type="text" name="aadhar_no" class="form-control" placeholder="Enter your Aadhaar no" value="<?php echo $row1['aadhar_no'];?>" required/> </div>
                <br/><br/>
                <div class="col-md-2 col-md-offset-1"> </div> <div class="col-md-2"> <label>Upload Documents:<br/> (like property/bank balance proof)</label> </div>
                <br/>
                <div class="col-md-5"> <input type="file" name="myfile"  required/> <h6 class="text-danger">Note that: Uploaded file name doesn't contain special characters and white space. If you upload the file like sample 1,sample#1 then banker never gets your document.</h6> </div>
                <br/><br/><br/><br/>
               
               <input type="submit" name="submit" value="Next" class="btn btn-success center-block"/>

            </form>
            

                
        </div>
    </div>
</div>
</body>
</html>
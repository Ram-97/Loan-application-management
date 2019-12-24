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
                                             <div class="progress-bar progress-bar-striped " role="progressbar" style="width:<?php if($row1['percentage']!='')  {echo $row1['percentage'];} else { echo '20%';} ?>" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100">
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
            <li class="active"><a href="customer-Welcome.php">Step 1</a></li>
            <li><a href="#">Step 2</a></li>
            <li><a href="#">Step 3</a></li>
        </ul>
        <br/>
        <pre>  <div class="text-danger text-center"> <span class="glyphicon glyphicon-info-sign"></span>If You don't have the account in our bank.<br/>Then contact our bank to get account and continue the steps.</div>  </pre>
        <div class="panel panel-info">
        <div class="panel-heading">
                <h5 class="text-center"> Account Details </h5>
        </div>
        <div class="panel-body">
        <?php
                if($row1['accept']=='Accepted')
                {
                    echo' <p class="alert alert-success text-center text-capitalize"> you have submitted successfully </p>';
                }
        ?>
                    
        <form  method="post" action="customer-step1.php">
                <div class="col-md-2 col-md-offset-1"> </div> <div class="col-md-2"> <label>Account No:</label>  </div>
                <div class="col-md-5"> <input type="text" name="ac_no" placeholder="Enter account no" value="<?php echo $row1['ac_no'];?>" class="form-control" required/> </div>
            <br/><br/>
                <div class="col-md-2 col-md-offset-1"> </div> <div class="col-md-2"> <label>Account Holder:</label> </div>
                <div class="col-md-5"> <input type="text" name="ac_name" placeholder="Enter account holder name" value="<?php echo $row1['ac_name'];?>"  class="form-control" required/>  </div>
            <br/><br/>                
                <div class="col-md-2 col-md-offset-1"> </div> <div class="col-md-2"><label>Bank Branch:</label> </div>
                <div class="col-md-5"> <input type="text" name="ac_branch" placeholder="Enter your bank branch"  value="<?php echo $row1['ac_branch'];?>"  class="form-control" required/>   </div>
            <br/><br/>
            <div class="col-md-2 col-md-offset-5">
                <input type="submit" value="Next" class="btn btn-success "/>
            </div>
        </form>  
        </div>
    </div>
</div>
</body>
</html>
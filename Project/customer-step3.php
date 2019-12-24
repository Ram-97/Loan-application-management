<?php
   include('session.php');
   $cus_id=$row['id'];
   $sql="Select * from documents where cus_id='$cus_id'";
   $res=mysqli_query($db,$sql);
   $row1=mysqli_fetch_array($res,MYSQLI_ASSOC);

   $sql1="select * from policies";
   $res1=mysqli_query($db,$sql1);
?>

<html>
<head>
<title>LR bank</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="images/customer.jpg" rel="icon" type="image/jpg"/>
<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
      <script type="text/javascript">
        $(document).ready(function(){
              $('input[type="checkbox"]').click(function(){
                  if($(this).prop("checked") == true){
                    $("#strikout_msg").hide();
                     $("#display_msg").show();
                  }
                  else if($(this).prop("checked") == false){
                    $("#display_msg").hide();
                     $("#strikout_msg").show();
                      
                  }
              });
          });
</script>
<style>
      .done-true {
        text-decoration: line-through;
        color: grey;
      }
</style>

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
            <li><a href="customer-step2.php">Step 2</a></li>
            <li class="active"><a href="customer-step3.php">Step 3</a></li>
        </ul>
        <br/>

        <div class="panel panel-info">
        <div class="panel-heading">
                <h5 class="text-center"> Terms and Policies </h5>
        </div>
        <div class="panel-body">
        <form action="customer-finish.php" method="post"  class="form-group">
        <div class="table-responsive">
                    <table class="table table-hover">
                    <tbody>
                        <?php
                        while($row2=mysqli_fetch_array($res1,MYSQLI_ASSOC))
                        {
                        $path=$row2['path'];
                        echo "<tr>
                                <td class='text-center'>Before Accepting our Terms and Policies. Know about our Policies </td>
                                <td>
                                <a href='download.php?dow=$path' class='btn btn-info btn-lg'>
                                    <span class='glyphicon glyphicon-download-alt'></span> Download
                                </a>
                                </td>
                                </tr>";
                        }
                        ?>
                    </tbody>
                    </table>
        </div>


        <?php
                if($row1['accept']=='Accepted')
                {
                    echo' <p class="alert alert-success text-center text-capitalize"> you have submitted successfully </p>';
                }
                else if($row1['amount_needed']!=''){

                    echo '
                        <h5 class="text-center text-primary text-capitalize">
                        <input type="checkbox" id="check1" name="accept_policy" value="Accepted"  required/>
                        <span class="done-true" id="strikout_msg" required>I accept the Terms and Policies</span>
                        <span id="display_msg" style="display:none" required>I accept the Terms and Policies</span>
                        </h5>
                        <input type="submit" name="submit" value="Finish" class="btn btn-success center-block"/>';
                }
                else{
                    echo' <p class="alert alert-danger text-center text-capitalize"> Please complete the step 2  </p>';

                }


        ?>
        </form>       
        </div>
    </div>
</div>
</body>
</html>
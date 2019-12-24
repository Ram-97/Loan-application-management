<?php
   include('session.php');
?>

<html>
<head>
<title>LR bank</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="scriptjs.js" type="text/javascript"> </script>
<script src="../js/bootstrap.min.js"></script>
<link href="../css/bootstrap.min.css" rel="stylesheet">
<link href="../images/verify.jpeg" rel="icon" type="image/jpeg"/>
</head>

<body > 
    <div class="container-fluid">  
    <nav class="navbar navbar-dark bg-primary">
        <div class="container-fluid">
            <div class="navbar-header">
                <div class="navbar-brand " >Welcome <?php echo $login_session; ?></div>
            </div>
            <ul class="nav navbar-nav navbar-right">
                <li><a href = "banker-settings.php" class="btn btn-primary"> <span class="glyphicon glyphicon-wrench"></span> Settings</a></li>
                <li> <a href = "logout.php" class="btn btn-primary"> <span class="glyphicon glyphicon-log-out"></span> Sign Out</a>  </li>
            </ul>
        </div>
    </nav>
  
   <div class="col-md-10 col-md-offset-1">   

      <ul class="nav nav-tabs nav-justified">
          <li><a href="banker-Welcome.php">Home</a></li>
          <li><a href="banker-customer.php">Agree/Disagree</a></li>
          <li class="active"><a href="banker-verify.php">Verify Documents</a></li>
      </ul>
      <br/>

      <div id="error-div" class="alert alert-danger" role="alert" style="display:none;" align="center">
            <span class="glyphicon glyphicon-exclamation-sign" id="error-glyphicon" aria-hidden="true"></span>
            <span id="error-span"></span>
      </div>

      <h5 class="alert alert-warning">Pending  <br/>
      <div class="table-responsive">
      <table class="table table-hover">
      <thead>
      <tr>
          <th width="3%">ID</td>
          <th>A/c Name</th>
          <th>A/c No</th>
          <th>A/c Branch</th>
          <th>Fund Needed</th>
          <th>Income Certificate</th>
          <th>Birth Certificate</th>
          <th>Aadhaar No</th>
          <th width="5%">Property Proof</th>
          <th>Accept/Reject</th>
      </tr>
      </thead>
      <tbody>
        
            <?php
                  $sql=mysqli_query($db,"SELECT * FROM documents");
                  
                  while($row = mysqli_fetch_array($sql))
                  {
                  $id=$row['cus_id'];
                  $path=$row['path'];
                  if($row['accept']=='Accepted' && $row['bankerresult']=='')
                  {
                    echo '<tr>
                          <td>'.$row['cus_id'].'</td>
                          <td>'.$row['ac_name'].'</td>
                          <td>'.$row['ac_no'].'</td>
                          <td>'.$row['ac_branch'].'</td>
                          <td>'.$row['amount_needed'].'</td>
                          <td>'.$row['income_no'].'</td>
                          <td>'.$row['birth_no'].'</td>
                          <td>'.$row['aadhar_no'].'</td>';
                    echo "<td> <a href=../$path target='_blank' class='btn'>
                          <span class='glyphicon glyphicon-download-alt'></span> 
                          </a>
                          </td>";
                    echo  '<td><a class="btn btn-warning"  href="banker-remove-doc.php?id='.$row['cus_id'].'"><span class="glyphicon glyphicon-trash" title="Remove" aria-hidden="true"></span></a>
                            <a class="btn btn-success" href="banker-accept-doc.php?id='.$row['cus_id'].'"><span class="glyphicon glyphicon-ok" ></span></a>
                            </td> </tr>';
                  }
                  }

              ?>
          
      </tbody>
    </table>
  </div>
  </h5>
<br/>
<br/>
  <h5 class="alert alert-info">Completed <br/>
  <div class="table-responsive">
      <table class="table table-hover">
      <thead>
      <tr>
          <th width="3%">ID</td>
          <th>A/c Name</th>
          <th>A/c No</th>
          <th>A/c Branch</th>
          <th>Fund Needed</th>
          <th>Income Certificate</th>
          <th>Birth Certificate</th>
          <th>Aadhaar No</th>
          <th>Status</th>
      </tr>
      </thead>
      <tbody>
        
            <?php
                  $sql=mysqli_query($db,"SELECT * FROM documents");
                  
                  while($row = mysqli_fetch_array($sql))
                  {
                  if($row['bankerresult']!='')
                  {
                    echo '<tr>
                          <td>'.$row['cus_id'].'</td>
                          <td>'.$row['ac_name'].'</td>
                          <td>'.$row['ac_no'].'</td>
                          <td>'.$row['ac_branch'].'</td>
                          <td>'.$row['amount_needed'].'</td>
                          <td>'.$row['income_no'].'</td>
                          <td>'.$row['birth_no'].'</td>
                          <td>'.$row['aadhar_no'].'</td>
                          <td>'.$row['bankerresult'].'</td>
                          ';
                  }
                  }

              ?>
          
      </tbody>
    </table>
  </div>
  </h5>
</div> 
  <?php
        $msg="";
        if(isset($_GET['error'])){
          $msg=$_GET['error'];
          if(strcmp($msg,"connection")==0){
            $msg = "Connection problem. Please try again later.";
          }
          else if(strcmp($msg,"invalidRemove")==0){
            $msg = "No such detail exists.";
          }
          else if(strcmp($msg,"noneRemove")==0){
            $msg = "Rejected";
          }
          else if(strcmp($msg,"Updated")==0){
            $msg = "Accepted";
          }



          if(strcmp($msg,"Accepted")==0||strcmp($msg,"Rejected")==0){
            echo "<script>
              document.getElementById('error-div').className = 'alert alert-success';
              document.getElementById('error-div').style.display = 'block';
              document.getElementById('error-glyphicon').className = 'glyphicon glyphicon-ok';
              document.getElementById('error-span').innerHTML = '".$msg."';
            </script>";
          }
          else if(strcmp($msg,"")!=0){
            echo "<script>
              document.getElementById('error-div').style.display = 'block';
              document.getElementById('error-span').innerHTML = '".$msg."';
            </script>";

          }
        }
      ?>


</body>
</html>
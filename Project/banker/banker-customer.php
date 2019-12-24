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
<link href="../images/accept_user.jpg" rel="icon" type="image/jpg"/>
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
          <li class="active"><a href="banker-customer.php">Agree/Disagree</a></li>
          <li><a href="banker-verify.php">Verify Documents</a></li>
      </ul>
      <br/>

      <div id="error-div" class="alert alert-danger" role="alert" style="display:none;" align="center">
            <span class="glyphicon glyphicon-exclamation-sign" id="error-glyphicon" aria-hidden="true"></span>
            <span id="error-span"></span>
      </div>

      <div class="table-responsive">
      <table class="table table-hover">
      <thead>
        <tr>
          <th>Name</th>
          <th>Gender</th>
          <th>Address</th>
          <th>Email</th>
          <th>Phone no</th>
          <th>Type of loan</th>
          <th>PAN No</th>
          <th>Accept/Reject</th>
        </tr>
      </thead>
      <tbody>
        
            <?php
                  $sql=mysqli_query($db,"SELECT * FROM customer");
                  
                  while($row = mysqli_fetch_array($sql))
                  {
                  echo "<tr><td>".$row['FirstName']." ";
                  echo $row['LastName']." ";
                  echo $row['SurName']."</td>";
                  echo "<td>".$row['gender']."</td>";
                  echo "<td>".$row['address']."<br/>";
                  echo $row['district']."<br/>";
                  echo $row['state']."<br/>";
                  echo $row['country']."</td>";
                  echo "<td>".$row['email']."</td>";
                  echo "<td>".$row['phone']."</td>";
                  echo "<td>".$row['loan']."</td>";
                  echo "<td>".$row['pan']."</td>";
                  echo  '<td><a class="btn btn-warning" href="banker-remove-customer.php?id='.$row['id'].'"><span class="glyphicon glyphicon-trash" title="Remove" aria-hidden="true"></span></a>
                          <a class="btn btn-success" href="banker-accept-customer.php?id='.$row['id'].'"><span class="glyphicon glyphicon-ok" ></span></a>
                          </td> </tr>';

                  }

              ?>
          
      </tbody>
    </table>
  </div>
</div> 
  <?php
        $msg="";
        if(isset($_GET['error'])){
          $msg=$_GET['error'];
          if(strcmp($msg,"connection")==0){
            $msg = "Connection problem. Please try again later.";
          }
          else if(strcmp($msg,"invalidRemove")==0){
            $msg = "No such customer detail exists.";
          }
          else if(strcmp($msg,"noneRemove")==0){
            $msg = "Delete successful.";
          }
          else if(strcmp($msg,"Updated")==0){
            $msg = "Added successful.";
          }



          if(strcmp($msg,"Added successful.")==0||strcmp($msg,"Delete successful.")==0){
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
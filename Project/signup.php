<?php
$con=mysqli_connect("localhost","root","","loan");

if(!$con)
{
 die("ERROR:Could not connect.".mysqli_connect_error());
}
extract($_POST);
$FirstName=$_POST['FirstName'];
$LastName=$_POST['LastName'];
$SurName=$_POST['SurName']; 
$address=$_POST['address']; 
$bday=$_POST['bday']; 
$gender=$_POST['gender']; 
$country=$_POST['country']; 
$state=$_POST['state']; 
$district=$_POST['district'];
$email=$_POST['email'];
$phone=$_POST['phone'];
$loan=$_POST['loan']; 
$pan=$_POST['pan']; 

$sql="INSERT INTO customer (FirstName,LastName,SurName ,bday ,gender ,country ,state,district,address ,email ,phone ,loan ,pan ) VALUES ('$FirstName','$LastName','$SurName','$bday','$gender','$country','$state','$district','$address','$email','$phone','$loan','$pan')";

if(!mysqli_query($con,$sql))
{
echo"<h1>Error:Could not able to execute $sql</h1>".mysqli_error($con);

}
else{
    //echo "<h1>success</h1>";
    header("location:index.html");
}


?>



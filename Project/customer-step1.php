<?php
   include('session.php');

if(!$db)
{
 die("ERROR:Could not connect.".mysqli_connect_error());
 //header('location:admin-settings.php?error=connection');
    //echo "db";
}
$cus_id=$row['id'];

extract($_POST);
$ac_no=$_POST['ac_no'];
$ac_name=$_POST['ac_name'];
$ac_branch=$_POST['ac_branch']; 

$sql="Select * from documents where cus_id='$cus_id'";
$res=mysqli_query($db,$sql);
$row=mysqli_fetch_array($res,MYSQLI_ASSOC);
if($row['cus_id']==$cus_id)
{
    $sql2="update documents set ac_no='$ac_no',ac_name='$ac_name',ac_branch='$ac_branch' where cus_id='$cus_id'";
    if(!mysqli_query($db,$sql2))
    {
    echo"<h1>Error:Could not able to execute $sql2</h1>".mysqli_error($db);
    
    }
    else{
        //echo "<h1>success</h1>";
        header("location:customer-step2.php");
    }

    
}
else
{
    $sql1="INSERT INTO documents (ac_no, ac_name ,ac_branch ,cus_id,percentage) VALUES ('$ac_no','$ac_name','$ac_branch','$cus_id','50%')";
    if(!mysqli_query($db,$sql1))
    {
    echo"<h1>Error:Could not able to execute $sql1</h1>".mysqli_error($db);
    
    }
    else{
        //echo "<h1>success</h1>";
        header("location:customer-step2.php");
    }

}
?>



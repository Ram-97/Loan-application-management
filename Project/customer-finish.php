<?php
include('session.php');
$cus_id=$row['id'];
 
if (!$db)
  {
echo "error in connecting database";
}


if(isset($_POST['submit']))
{
    $accept_policy = $_POST['accept_policy'];
    $query = "update documents set accept='$accept_policy',percentage='80%' where cus_id='$cus_id'";
    if(!mysqli_query($db,$query))
    {
    echo"error";
    }
    else{
        header('Location:customer-welcome.php');

    }
}


?>

<?php
include('session.php');
$cus_id=$row['id'];
 
if (!$db)
  {
echo "error in connecting database";
}


if(isset($_POST['submit']))
{
    $amount_needed = $_POST['amount_needed'];
    $income_no = $_POST['income_no'];
    $birth_no = $_POST['birth_no'];
    $aadhar_no = $_POST['aadhar_no'];
    $name = $_FILES['myfile']['name'];
    $tmp_name = $_FILES['myfile']['tmp_name'];

    if($name ){
        $Location ="documents/$name";
        move_uploaded_file($tmp_name,$Location);
        $query = "update documents set amount_needed='$amount_needed',income_no='$income_no',birth_no='$birth_no', aadhar_no='$aadhar_no',path='$Location'  where cus_id='$cus_id'";
        if(!mysqli_query($db,$query))
        {
        echo"error";
        }
        else{
            header('Location:customer-step3.php');

        }
    }
    else
    {
        die("Please select a file");
    }



}

?>

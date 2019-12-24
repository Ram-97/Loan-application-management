<?php
    include('config.php');


	if(isset($_GET['id'])){
		$id = mysql_real_escape_string(stripslashes($_GET['id']));
		$query = mysqli_query($db,"select * from documents where cus_id='$id'");
		if(mysqli_num_rows($query)==1){
			$query = mysqli_query($db,"update documents set bankerresult='Rejected' where cus_id='$id'");
			if($query){
                //echo 'remove';
				header("location:banker-verify.php?error=noneRemove");
			}
			else{
                //echo 'conn error';
				header('location:banker-verify.php?error=connection');
			}
			
		}
		else{
            //echo 'query error';
			header('location:banker-verify.php?error=invalidRemove');
		}
	}
	
?>
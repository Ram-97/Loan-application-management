<?php
    include('config.php');
  	if(isset($_GET['id'])){
		$id = mysql_real_escape_string(stripslashes($_GET['id']));
		$query = mysqli_query($db,"select * from customer_login where id='$id'");
		if(mysqli_num_rows($query)==1){
			$query = mysqli_query($db,"delete from customer_login where id='$id'");
			$query = mysqli_query($db,"delete from documents where cus_id='$id'");
			if($query){
                //echo 'remove';
				header("location:banker-welcome.php?error=noneRemove");
			}
			else{
                //echo 'conn error';
				header('location:banker-welcome.php?error=connection');
			}
			
		}
		else{
            //echo 'query error';
			header('location:banker-welcome.php?error=invalidRemove');
		}
	}
	
?>
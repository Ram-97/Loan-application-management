<?php
    include('config.php');
 
	if(isset($_GET['id'])){
		$id = mysql_real_escape_string(stripslashes($_GET['id']));
        $query = mysqli_query($db,"select * from  documents where cus_id='$id'");
        $row=mysqli_fetch_array($query,MYSQLI_ASSOC);
		if(mysqli_num_rows($query)==1){	
    		$query = mysqli_query($db,"update documents set bankerresult='Accepted' ,percentage='100%' where cus_id='$id'");
			if($query){
                //echo 'updated';
				header("location:banker-verify.php?error=Updated");
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
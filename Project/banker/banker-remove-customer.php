<?php
    include('config.php');
    if(session_id()==""){
		session_start();
	}
	if(!isset($_SESSION['login_user'])){
		header('location:index.html');
	}
	if(isset($_SESSION['login_user'])&&strcmp($_SESSION['login_user'],"banker")!=0){
		header('location:index.html');
	}
	if(isset($_GET['id'])){
		$id = mysql_real_escape_string(stripslashes($_GET['id']));
		$query = mysqli_query($db,"select * from customer where id='$id'");
		if(mysqli_num_rows($query)==1){
			$query = mysqli_query($db,"delete from customer where id='$id'");
			if($query){
                //echo 'remove';
				header("location:banker-customer.php?error=noneRemove");
			}
			else{
                //echo 'conn error';
				header('location:banker-customer.php?error=connection');
			}
			
		}
		else{
            //echo 'query error';
			header('location:banker-customer.php?error=invalidRemove');
		}
	}
	
?>
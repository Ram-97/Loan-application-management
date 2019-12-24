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
        $row=mysqli_fetch_array($query,MYSQLI_ASSOC);
		if(mysqli_num_rows($query)==1){
			$FirstName=$row['FirstName'];
			$LastName=$row['LastName'];
			$SurName=$row['SurName']; 
			$address=$row['address']; 
			$bday=$row['bday']; 
			$gender=$row['gender']; 
			$country=$row['country']; 
			$state=$row['state']; 
			$district=$row['district'];
			$email=$row['email'];
			$phone=$row['phone'];
			$loan=$row['loan']; 
			$pan=$row['pan'];
			$pass1=$row['FirstName'].$row['pan'];
			$sql="INSERT INTO customer_login (FirstName,LastName,SurName ,bday ,gender ,country ,state,district,address ,email ,phone ,loan ,pan,password ) VALUES ('$FirstName','$LastName','$SurName','$bday','$gender','$country','$state','$district','$address','$email','$phone','$loan','$pan','$pass1')";
			$query = mysqli_query($db,$sql);
			$query = mysqli_query($db,"delete from customer where id='$id'");
			if($query){
                //echo 'updated';
				header("location:banker-customer.php?error=Updated");
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
<?php
	require_once('mysqldb.php');

	$name = $_REQUEST['fname'];
	$gender = $_REQUEST['gender'];
	$email = mysqli_escape_string($conn, $_REQUEST['email']);
	$phone = $_REQUEST['phone'];
	$address = $_REQUEST['address'];
	$password = mysqli_escape_string($conn, $_REQUEST['password']);
	$msg="";
	$msg1="";

		$query = mysqli_query($conn, "SELECT * FROM `user_info` WHERE user_id='$email'");
		$nn = mysqli_num_rows($query);
		if($nn == 0 && !preg_match('/^ *$/', $name))
		{
			$sql1 ="INSERT INTO `login` (user_id, email, pass, acctype) 
			VALUES ('$email','$email', '$password', 'User')";
			if(!mysqli_query($conn, $sql1))
				{
					echo "Error in login: " . $sql1. "<br>" . mysqli_error($conn);
				}
			
			$sql = "INSERT INTO `user_info`(`user_id`,`name`,`email`,`gender`,`phone`,`address`) 
			VALUES ('$email', '$name', '$email', '$gender', '$phone', '$address')";
			if(!mysqli_query($conn, $sql))
				{
					echo "Error in user_info: " . $sql . "<br>" . mysqli_error($conn);
				}
			else
			  {
			  	$msg= '<script> alert ("SignUp Successfully"); window.location = "login.php"; </script>';
			  }
		}
		else
			$msg1= '<script> alert ("Invalid input or Email already exist"); window.location = "signup.php"; </script>';	
?>

    <?php
		echo $msg;
		echo $msg1;
	?>
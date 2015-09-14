<?php

	//Connect to the database
	
	$db_host = "localhost";
	$db_user = "root";
	$db_pass = "";
	$db_name = "mainroot";
	$conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name)  or die('cant connect to the database');
	
	$sql = "SELECT * FROM studentusers";
	$query = mysql_query($sql);
	$user_ids = array();
	$emails = array();
	while($num_rows = mysql_fetch_array($query,MYSQL_ASSOC)){
		array_push($user_ids, $num_rows['id']);
		array_push($emails, $num_rows['email']);
	}
	
	// --------Sending emails to all the existed users--------
	
	for($i=0;;$i++){
		$to = $emails[$i];
		$subject = 'sample email';
		$header = 'From: noreply@nitster.com';
		$id = md5($user_ids[$i]);
		$message = '<a href="www.nitster.com/mail.php?en='.$id.'">click this link</a>';
		if(mail($to, $subject, $message, $header))
		{
			echo 'success';
		}
		else
		{
			echo 'error';
		}
		if(isset($_GET['en']))
		{
			if($_GET['en'] == $id)
			{
				echo 'confirmed';
			}
			else
			{
				echo ' ';
			}
		}
	}
	
		
?>
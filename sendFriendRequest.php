<?php
	session_start();
	if(!isset($_SESSION['userID'])){
		header('Location:index.html');
	}
	else{
		require 'server.php';
		$user2ID=$_GET['userID'];
		$user1ID=$_SESSION['userID'];
		echo $user2ID;
		$q="INSERT INTO friends(user1ID,user2ID,status,actionuserID) values($user1ID,$user2ID,'0',$user1ID)";
		$result=@mysqli_query($conn,$q);
		if(mysqli_affected_rows($conn)==1){
			@mysqli_close($conn);
			echo '<script>alert("Friend Request Sent successfully!!");window.location="friends.php";</script>';
		}
		else{
			@mysqli_close($conn);
			echo '<script>alert("Friend Request could not be sent.Sorry for inconvenience!!");window.location="friends.php";</script>';
		}
	}
?>
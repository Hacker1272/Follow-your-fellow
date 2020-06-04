<?php
	session_start();
	if(!isset($_SESSION['userID'])){
		header('Location:index.html');
	}
	else{
		require 'server.php';
		$userID1=$_SESSION['userID'];
		$userID2=$_GET['userID'];
		$q="UPDATE friends SET status = '2', actionuserID=$userID1 WHERE user1ID =$userID2 AND user2ID=$userID1";
		@mysqli_query($conn,$q);
		if(mysqli_affected_rows($conn)==1){
			echo '<script>alert("Operation Done Successfully!!");window.location="friends.php"</script>';
		}
		else{
			echo '<script>alert("System Error occured. Sorry For inconvenience.!!");window.location="friends.php"</script>';
		}
	}
?>
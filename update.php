<?php
	session_start();
	if(!isset($_SESSION['userID'])){
		header("Location:index.html");
	}
	else{
		if(isset($_POST['post'])){
			require 'server.php';
			$post=mysqli_real_escape_string($conn,strip_tags(trim($_POST['update'])));
			$id=$_SESSION['userID'];
			$q="INSERT INTO updates(userID, updates, updateTime) values($id, '$post', now())";
			@mysqli_query($conn,$q);
			if(mysqli_affected_rows($conn)==1){
				echo '<script>alert("Update Posted successfully!!");window.location="users.php";</script>';
			}
			else{
				echo '<script>alert("System error occured!!.Sorry for inconvenience."); window.location="users.php";</script>';
			}
		}
		else{
			header("Location:index.html");
		}
	}
?>
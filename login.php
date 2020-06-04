<?php
	if(isset($_POST['login'])){
		require 'server.php';
		$username=mysqli_real_escape_string($conn,strip_tags(trim($_POST['username'])));
		$pwd=mysqli_real_escape_string($conn,strip_tags(trim($_POST['password'])));
		$q="SELECT * FROM users WHERE username='$username' AND password=sha1('$pwd')";
		$result=@mysqli_query($conn,$q);
		if(@mysqli_num_rows($result)==1){
			$row=@mysqli_fetch_assoc($result);
			session_start();
			$_SESSION=$row;
			$url='users.php';
			header('Location: '.$url);
			exit();
			@mysqli_close($conn);
		}
		else{
			@mysqli_close($conn);
			echo "<script>alert('Either Usename or Password Incorrect! if you are a new user Register.');window.location='index.html';</script>";
		}
	}
	else if(isset($_POST['signup'])){
		require 'server.php';
		$username=mysqli_real_escape_string($conn,strip_tags(trim($_POST['username'])));
		$pwd=mysqli_real_escape_string($conn,trim($_POST['password']));
		$pwd=sha1($pwd);
		$q="SELECT * FROM users WHERE username='$username'";
		$result=@mysqli_query($conn,$q);
		if(mysqli_num_rows($result)<1){
			$q="INSERT INTO users(username,password) values('$username','$pwd')";
			@mysqli_query($conn,$q);
			if(mysqli_affected_rows($conn)==1){
				echo'<script>alert("You have been successfully registerd. You may now log in to your account using username and password.");window.location="index.html";</script>';
				@mysqli_close($conn);
				
			}
			else{
				echo "<script>alert('System error ocurred. Sorry for inconvenience.');window.location='index.html';</script>";
				@mysqli_close($conn);
			}
		}
		else{ 
			echo "<script>alert('This username is not available. Try a different one.');window.location='index.html';</script>";
			@mysqli_close($conn);
		}
		@mysqli_close($conn);
	}
	else{
		echo '<script>alert("Restricted Page");window.location="index.html";</script>';
	}
?>
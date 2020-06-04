<?php
	session_start();
	if(!isset($_SESSION['userID'])){
		header('Location:index.html');
	}
?>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
	<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
	<link rel="stylesheet" href="mainstyle.css">
</head>
<body>
<div class="container">
<hr>
<div class="card bg-light">

	<h4 class="card-title mt-3 text-center">Profile Page</h4>
	<div class="row">
		<div class="col-4">
			<a href="users.php"><button class="btn btn-alert btn-block"><?php echo $_SESSION['username'];?> </button></a>
		</div>
		<div class="col-4">
			<a href="friends.php"><button class="btn btn-alert btn-block"> Friends </button></a>
		</div>
		<div class="col-4">
			<a href="logout.php"><button class="btn btn-alert btn-block"> Logout </button></a>
		</div>
	</div>
	<div class="card-body">
	<hr>
		<form action="update.php" method="POST">
		<div class="row">
			<div class="col-6">
				<?php
					require 'server.php';
					$userID=$_SESSION['userID'];
					$q="SELECT * from friends WHERE (user1ID=$userID OR user2ID=$userID) AND status='1'";
					$result=@mysqli_query($conn,$q);
					if(mysqli_num_rows($result)>0){
						while($row=mysqli_fetch_assoc($result)){
							if($row['user1ID']!=$_SESSION['userID']){
								$showID=$row['user1ID'];
							}
							else if($row['user2ID']!=$_SESSION['userID']){
								$showID=$row['user2ID'];
							}
							$q="SELECT * FROM updates WHERE userID=$showID ORDER BY updateTime DESC";
							$result=@mysqli_query($conn,$q);
							if(mysqli_num_rows($result)>0){
								$name="SELECT username FROM users WHERE userID=$showID";
								$nameresult=@mysqli_query($conn,$name);
								$namerow=@mysqli_fetch_assoc($nameresult);
								echo '<div>update from '.$namerow['username'].'</div>';
								while($row=mysqli_fetch_assoc($result)){
									echo '<div>'.$row['updates'].'</div>';	
								}
							}
						}
					}
				?>
			</div>
			<div class="col-6">
				<div class="form-group">
					<textarea name="update"class="form-control" rows="5" placeholder="Update your friends."></textarea>
				</div>

			    <div class="form-group">
			        <button type="submit" class="btn btn-primary btn-block" name="post"> Post </button>
			    </div> <!-- form-group// -->      
			</div>
		</div>
		</form>
	</div>
</div> <!-- card.// -->

</div> 
<!--container end.//-->
<br><br>
</body>
</html>

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

	<h4 class="card-title mt-3 text-center">Friends Page</h4>
	<div class="row">
		<div class="col-4">
			<a href="users.php"><button class="btn btn-alert btn-block"><?php echo $_SESSION['username'];?></button></a>
		</div>
		<div class="col-4">
			<a href="friends.php"><button class="btn btn-alert btn-block"> Friends </button></a>
		</div>
		<div class="col-4">
			<a href="logout.php"><button class="btn btn-alert btn-block" > Logout </button></a>
		</div>
	</div>
	<div class="card-body">
	<hr>
		<div class="row">
			<div class="col-4">
				<p>Friend Requests</p>
				<?php
					require 'server.php';
					$user1ID=$_SESSION['userID'];
					$q="SELECT * FROM friends WHERE (user1ID = $user1ID  OR user2ID = $user1ID) AND status = '0' AND actionuserID !=$user1ID";
					$result=@mysqli_query($conn,$q);
					if(mysqli_num_rows($result)>0){
						while($row=mysqli_fetch_assoc($result)){
							if($row['user1ID']!=$_SESSION['userID']){
								$showID=$row['user1ID'];
							}
							else if($row['user2ID']!=$_SESSION['userID']){
								$showID=$row['user2ID'];
							}
							$q="SELECT * FROM users WHERE userID=$showID";
							$result=@mysqli_query($conn,$q);
							if(mysqli_num_rows($result)==1){
								$row=mysqli_fetch_assoc($result);
								echo '<div class="row"><div class="col-4">'.$row['username'].'</div><div class="col-4"><a href="acceptRequest.php?userID='.$row['userID'].'">Accept</a></div><div class="col-4"><a href="rejectRequest.php?userID='.$row['userID'].'">Decline</a></div></div>';
							}

						}
					}
					@mysqli_close($conn);
				?>
				
			</div>
			<div class="col-4">
				<p>Friend List</p>
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
							$q="SELECT username FROM users WHERE userID=$showID";
							$result=@mysqli_query($conn,$q);
							if(mysqli_num_rows($result)==1){
								$row=mysqli_fetch_assoc($result);
								echo '<div>'.$row['username'].'</div>';
							}
						}
					}
					@mysqli_close($conn);
				?>
			</div>
			<div class="col-4">
				<p>All Users</p>
				<?php
					require 'server.php';
					$userID=$_SESSION['userID'];
					$newq="SELECT * FROM friends WHERE (user1ID=$userID OR user2ID=$userID) AND status='1'";
					$newresult=@mysqli_query($conn,$newq);
					$friendID=array();
					if(mysqli_num_rows($newresult)>0){
						$newrow=@mysqli_fetch_assoc($newresult);
						if($newrow['user1ID']!=$_SESSION['userID']){
							$showID=$newrow['user1ID'];                              
						}
						if($newrow['user2ID']!=$_SESSION['userID']){
							$showID=$newrow['user2ID'];                              
						}
						array_push($friendID,$showID);
					}
					$q="SELECT * from users";
					$result=mysqli_query($conn,$q);
					if(mysqli_num_rows($result)>1){  //greater than 1. means there should be an extra member.
						while($row=mysqli_fetch_assoc($result)){
							if(!in_array($row['userID'], $friendID) and $row['userID']!=$_SESSION['userID']){
								echo '<div class="row"><div class="col-6">'.$row['username'].'</div><div class="col-6"><a href="sendFriendRequest.php?userID='.$row['userID'].'">Send Friend Request</a></div></div>';
							}
						}
					}
					@mysqli_close($conn);
				?>
			</div>
		</div>
	</div>
</div> <!-- card.// -->

</div> 
<!--container end.//-->
<br><br>
</body>
</html>

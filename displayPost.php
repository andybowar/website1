<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"/>
	<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Week 4 Project</title>
	<link href="https://fonts.googleapis.com/css?family=Lato:300" rel="stylesheet"> <!-- Link to font style -->
	<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css">
	<link href="css/bootstrapOverride.css" rel="stylesheet" type="text/css">
	
	
	
</head>
<body>
<div class="container">


	<div class="sr-only">
		<ul>
			
		</ul>
	</div>
<br>

<!-- Title is below. ROW 1 -->
	<div class="row">
		<header>
		<nav class="navbar navbar-inverse" role="navigation">	
			<div class="navbar-header" id="headertext">
				<a class="navbar-brand" href="index.php">User View</a>
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
            </button>
			</div>
			<!--	Navigation -->
			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
			<ul class="nav navbar-nav navbar-right">
				<li><a href="photographypage.html">Photography</a></li>
				<li><a href="displayPost.php">Posts</a></li>
				<li><a href="addPost.php">Add Post</a></li>
				<li><a href="contact.html">Contact</a></li>
			</ul>
			</div>
		</nav>
		</header>
	</div>
<!-- END OF ROW 1 -->
	<hr />
	
	<?php
	
	//Set up connection constants			
	define("SERVER_NAME","localhost");
	define("DBF_USER_NAME", "root");
	define("DBF_PASSWORD", "mysql");
	define("DATABASE_NAME", "blogPost");
		
	// Create connection object
	$conn = new mysqli(SERVER_NAME, DBF_USER_NAME, DBF_PASSWORD);
	
	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	} 
	
	$conn->select_db(DATABASE_NAME);
	
	$sql = "SELECT author, title, body, img_URL, timestamp FROM post ORDER BY timestamp DESC";
	$result = $conn->query($sql);
	
	
	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			echo "<div class='row'>
				  <div class='col-lg-12'>";
			
			echo "<h3>Title: " . $row["title"] . "</h3>"; 
			if ($row["img_URL"]) {
			echo "<img class='thumbnail' style='width: 25%; float: right;' src='" . $row["img_URL"] . "' />";
			}
			echo $row["body"] ."<br><br>";
			echo "<strong>Author: </strong>" . $row["author"] . "<br>";
			echo "Posted on: " . $row["timestamp"];
			
			echo "</div></div><hr />";
		//$result = $conn->query($sql);
		}
	} else {
		echo "No posts.";
	}
	
	//var_dump($row);
	
	
	
	
	
	
	?>
	<!-- ROW 2 -->
	<div class="row">
	
	
	
	
	
	</div>
	
</div>

<!-- (1) jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/
1.12.0/jquery.min.js"></script>
<!-- (2) Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/
bootstrap.min.js"></script>
<!-- (4) Bring in local JavaScript functions -->
<script src="js/bootstrap.js"></script>

</body>
</html>

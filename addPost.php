<!DOCTYPE html>
<html>
<!-- Read me page. Works as a template for every other page -->
<head>
	<meta charset="utf-8"/>
	<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Week 4 Project</title>
	<link href="https://fonts.googleapis.com/css?family=Lato:300" rel="stylesheet"> <!-- Link to font style -->
	<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css">
	<link href="css/bootstrapOverride.css" rel="stylesheet" type="text/css">
	
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
	
	//Silently create the database and table if this is a first time visit
	$sql = "CREATE DATABASE IF NOT EXISTS " . DATABASE_NAME;
	if ($conn->query($sql)) {
		$sql = "CREATE DATABASE IF NOT EXISTS " . DATABASE_NAME;
	}
	
	//Select Database
	$conn->select_db(DATABASE_NAME);
	
	$sql = "CREATE TABLE IF NOT EXISTS post (
        id_post INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
        author     	VARCHAR(25) NOT NULL,
        title     	VARCHAR(25) NOT NULL,
        body    	VARCHAR(2000),
        img_url		VARCHAR(200),
		timestamp	timestamp
        )";
	runQuery($sql, "Table:post", false);
	
	function runQuery($sql, $msg, $echoSuccess) {
		global $conn;
		
		// run the query
		if ($conn->query($sql) === TRUE) {
			if($echoSuccess) {
				echo $msg . " successful.";
			}
		} else {
		echo "Error when: " . $msg . " using SQL: " . $sql . $conn->error;
		}   
	} 
	
	
	if(isset($_POST['txtAuthor'])) {
		$txtAuthor = $_POST['txtAuthor'];
	}
	
	if(isset($_POST['txtTitle'])) {
		$txtTitle = $_POST['txtTitle'];
	}
	
	if(isset($_POST['txtBody'])) {
		$txtBody = $_POST['txtBody'];
	}
	
	if(isset($_POST['txtURL'])) {
		$txtURL = $_POST['txtURL'];
	}
	
	// Insert values in post form into database upon clicking "submit"
	if (isset($_POST['btnSubmit'])) {
		$sql = "INSERT INTO post (id_post, author, title, body, img_url)
				VALUES (NULL, '" 
				. $txtAuthor . "', '" 
				. $txtTitle . "', '"
				. $txtBody . "', '"
				. $txtURL . "')";
		$result = $conn->query($sql); 
	} 
	
	$conn->close();
		
	?>
</head>
<body>
<div class="container">
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
				<li><a href="postsCode.php">Posts Code</a></li>
				<li><a href="contact.html">Contact</a></li>
			</ul>
			</div>
		</nav>
		</header>
	</div>
<!-- END OF ROW 1 -->

	
	<!-- ROW 2 -->
	<div class="row">
		<div class="col-md-6 col-md-offset-3">
			<div id="form" style="padding-bottom: 2%;">
				<form id="post" 
					  action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>"
					  method="POST"
					  name="postForm"
					  id="postForm">
					<h3>Create a post</h3>
					<div class="form-group">
						<h4>Author:</h4>
						<input class="form-control" style="color: black;" type="text" name="txtAuthor" id="txtAuthor" placeholder="Author Name" required>
					</div>
					
					<div class="form-group">
						<h4>Post Title:</h4>
						<input class="form-control" style="color: black;" type="text" name="txtTitle" id="txtTitle" placeholder="Post Title" required>
					</div>
					
					<div class="form-group">
						<h4>Body:</h4>
						<textarea rows="5" cols="40" style="color: black;" class="form-control" name="txtBody" id="txtBody" required></textarea>
					</div>
					
					<div class="form-group">
						<h4>Image URL:</h4>
						<input class="form-control" style="color: black;" type="text" name="txtURL" id="txtURL" placeholder="Enter image URL here">
					</div>
					
					<input type="submit" onclick="this.form.submit();" class="btn btn-primary" name="btnSubmit">
					<br><br>
					<?php
					
					if( $txtAuthor && $txtTitle && $txtBody) 
					{
						echo "<p>Your post has been submitted.</p>";
						echo "<h3>";
						echo "Title: ". $txtTitle . "</h3><br>";
						if ($txtURL) {
							echo "<img class='thumbnail' style='width: 50%; margin: 0 auto;' src='" . $txtURL . "' /><br>";
						}
						echo $txtBody . "<br>";
						echo "</p>";
						echo "<p><strong>";
						echo "Author: </strong>". $txtAuthor . "<br><br>";
					}
					
					?>
				</form>
			</div>
		</div>
	</div>
	<!-- END OF ROW 2 -->

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
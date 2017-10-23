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
</head>
<body>
<div class="container">
<br>
<!-- Title is below. ROW 1 -->
	<div class="row">
		<header>
		<nav class="navbar navbar-inverse" role="navigation">	
			<div class="navbar-header" id="headertext">
				<a class="navbar-brand" href="index.html">Andy Bowar Photography</a>
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
	<hr />
	
	<!-- Content -->
	
	<!-- ROW 2 -->
	<div class="row">
		<div class="col-lg-12">
			<h3>Code for creating the database</h3>
			<p>This code will reside on the page used for entering in blog posts.
			Part of the code on this page will silently create the database if it doesn't
			already exist.</p>
			<pre>
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

// Create database
$sql = "CREATE DATABASE IF NOT EXISTS " . DATABASE_NAME;
if ($conn->query($sql) === TRUE) {
    echo "The database " . DATABASE_NAME . " exists or was created successfully!";
} else {
    echo "Error creating database " . DATABASE_NAME . ": " . $conn->error;
}

// Select the database
$conn->select_db(DATABASE_NAME);


/*******************************
 * Create Table
 *******************************/
// Create Table:post
$sql = "CREATE TABLE IF NOT EXISTS post (
        id_post INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
        author     	VARCHAR(25) NOT NULL,
        title     	VARCHAR(25) NOT NULL,
        body    	VARCHAR(500),
        img_url		VARCHAR(200),
		timestamp	timestamp
        )";
runQuery($sql, "Table:runner", false);

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
} 			</pre>
		</div>
	</div>
	
	<div class="row">
		<div class="col-lg-12">
			<h3>Code for capturing data from forms</h3>
			<pre>
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
if(isset($_POST['btnSubmit'])) {
	$sql = "INSERT INTO post (id_post, author, title, body, img_url)
			VALUES (NULL, '" 
			. $_POST['txtAuthor'] ."', '" 
			. $_POST['txtTitle'] ."', '"
			. $_POST['txtBody']) ."', '"
			. $_POST['txtURL']."')";
	$result = $conn->query($sql);
}			</pre>
		</div>
	</div>

	<div class="row">
		<div class="col-lg-12">
			<h3>Code to retrieve data and build posts</h3>
			<p>Here, we will have code that will create all the 
			necessary divs, headers, and text blocks to display the data
			in an aesthetically pleasing way.</p>
			<pre>
if ($result-&gt;num_rows &gt; 0) {
	while($row = $result-&gt;fetch_assoc()) {
		echo "&lt;div class='row'&gt;
			  &lt;div class='col-lg-12'&gt;";
		
		echo "&lt;h3&gt;Title: " . $row["title"] . "&lt;/h3&gt;"; 
		if ($row["img_URL"]) {
		echo "&lt;img class='thumbnail' style='width: 25%; float: right;' src='" . $row["img_URL"] . "' /&gt;";
		}
		echo $row["body"] ."&lt;br&gt;&lt;br&gt;";
		echo "&lt;strong&gt;Author: &lt;/strong&gt;" . $row["author"] . "&lt;br&gt;";
		echo "Posted on: " . $row["timestamp"];
		
		echo "&lt;/div&gt;&lt;/div&gt;&lt;hr /&gt;";
	//$result = $conn-&gt;query($sql);
	}
} else {
	echo "No posts.";
}		</pre>
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
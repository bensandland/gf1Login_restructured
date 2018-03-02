<!--  -->

<?php
    // This document acts as a template
	// - it only contains the main design of the site (header, menu, stylesheets and 'body' tags)

	// Make sure database-connection and session is active on every site
	include_once "../cfg/sessConn.php";
	include_once "../cfg/dbConn.php";

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width">
	<meta name="description" content="">
	<meta name="keywords" content="">
	<meta name="author" content="">
	<title>Mercantec | Velkommen</title>
  	<link rel="stylesheet" href="../css/style.css">
  	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
	<div id="wrapper">
	<header>
		<div class="container">
			<div id="branding">
	          	<a href="../main/overview.php">
				<h1><span class="highlight">Mercantec</span> Viborg</h1>
			</div>
			<nav>
				<ul>
					<li class="knap3"><k>Hej </k><?php echo $_SESSION['username']; ?></li>
					<li class="knap2"><a href="../main/overview.php">Elev-oversigt</a></li>
					<li class="knap1"><a href="../login/logout.php">Logud</a></li>
				</ul>
			</nav>
		</div>
	</header>
	
<!-- Icon-bar located underneath header/menu - maybe change paths when pushed to live? To prevent incorrect file paths -->
	<div class="icon-bar">
		<a title="Opret Elev" href="../admin/createStudent.php"><i class="fa fa-plus"></i></a> 
		<a href="/image.php"><i class="fa fa-vcard"></i></a> 
		<a title="Afsluttet Elever" href="../admin/finishedStudents.php"><i class="fa fa-vcard"></i></a> 
		<a href="#"><i class="fa fa-question"></i></a>
		<a title="Opret Lærer" href="../admin/createTeacher.php"><i class="fa fa-plus"></i></a> 
	</div>
<!-- This document acts as a template - it's very much alike 'mainTempl.php' except it doesnt contain body tags & stylesheets -->

<?php
	// Make sure database-connection and session is active
	include_once "../cfg/dbConn.php";
	include_once "../cfg/sessConn.php";

?>

<!-- Body tag will be around this in file it's included from -->
<header>
	<div class="container">
		<div id="branding">
          	<a href="../overview.php"> <h1>
			<h1><span class="highlight">Mercantec</span> Viborg</h1>
		</div>
		<nav>
			<ul>
				<li class="knap3"><k>Hej </k><?php echo $_SESSION['username']; ?></li>
				<li class="knap2"><a href="../overview.php">Elev-oversigt</a></li>
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
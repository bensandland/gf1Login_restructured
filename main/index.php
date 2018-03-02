<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width">
  <meta name="description" content="">
  <meta name="keywords" content="">
  <meta name="author" content="">
  <title>Mercantec | Velkommen</title>
  <link rel="stylesheet" href="./css/style.css">
</head>
  <body>
    <header>
      <div class="container">
        <div id="branding">
        <h1><span class="highlight">Mercantec</span> Viborg</h1>
        </div>
        <nav>
          <ul>
            <?php 
            	require "Login/loginSystem.php";
            ?>
          </ul>
        </nav>
        <nav>
          </ul>
          	<a href="login/ElevLogin.php" value="Elev Login"><i class="btn btn-primary"></i></a>
          </ul>
        </nav>
      </div>
    </header>
    <body>
    <div class="slide" style="max-width:500px">
        <img class="mySlides" src="img/Viborg.jpg" height="983" width="1920">
        </div>
        <?php require "js/slide.php"; ?>
  </body>

</html>
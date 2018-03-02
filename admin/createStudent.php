<?php
// Initialize the session
session_start();
 
// If session variable is not set it will redirect to login page
if(!isset($_SESSION['username']) || empty($_SESSION['username'])){
  header("location: ..//index.php");
  exit;
}
?>


<!DOCTYPE html> 

<head class="head">
    <title>Login system</title>
    <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="../css/student.css">
</head>

<body>

        <form id="regForm" action="php1.php" method="post">
                
          <h1>Tilføj elev:</h1>
                
                <div class="">Navn:
                  <p><input placeholder="Fornavn..." name="Fornavn" oninput="this.className = ''"></p>
                  <p><input placeholder="Efternavn..." name="Efternavn" oninput="this.className = ''"></p>
                </div>

                <br></br>

                <div class="">Kontakt information:
                  <p><input placeholder="E-mail..." name="Mail" oninput="this.className = ''"></p>
                  <p><input placeholder="Telefon-nummer..." name="Nummer" oninput="this.className = ''"></p>
                </div>

                <br></br>

                <div class="">Adresse:
                  <p><input placeholder="H.C.Andersensvej 7" name="Adresse" oninput="this.className = ''"></p>
                  <p>Post-Nummer:</p>
                  <p><input placeholder="8800" name="Postnummer"oninput="this.className = ''"></p>
                  <p>By:</p>
                  <p><input placeholder="Viborg" name="By" oninput="this.className =''"></p>
                  <p>Land:</p>
                  <p><input placeholder="Danmark" name="Land" oninput="this.className =''"></p>
                </div>
                
                <br></br>
                
                <div class="">Fødselsdag:
                  <p><input placeholder="Fx. 2000-04-21" name="BDag" oninput="this.className = ''"></p>
                </div>

                <br></br>
                
                <div class="">Tilknytninger:
                  <p><input placeholder="Hold..." name="Hold" oninput="this,className = ''"></p>
                  <p><input placeholder="Mentor..." name="Mentor" oninput="this.className = ''"></p>
                  <p><input placeholder="Sagsbehandler..." name="Sagsbehandler" oninput="this.className = ''"></p>
                </div>

                <br></br>

                <div class="">Skoleophold start:
                  <p><input placeholder="2018-04-21" name="Skolestart" oninput="this.className = ''"></p>
                  <p>Forventet skoleophold slut:</p>
                  <p><input placeholder="2018-09-21" name="Skoleslut" oninput="this.className = ''"></p>
                </div>

                <br></br>
				
                  <p>Billede:</p>
                  <p><form action="upload.php" method="POST" enctype="multipart/form-data">
						<input type="file" name="file">
   				  </p>
                </div>

                <br></br>
                    
                <div class="">Elevens login:
                  <p><input placeholder="Brugernavn..." type="text" name="Brugernavn" oninput="this.className = ''"></p>
                  <p><input placeholder="Adgangskode..." type="password" id="myInput"  name="Adgangskode" oninput="this.className = ''"></p>
                  Vis Adgangskode<input type="checkbox" class="box1" onclick="myFunction()">
                </div>

                <br></br>

                <div class="">Særlige oplysninger:
                  <p><input type="text" name="Beskrivelse" oninput="this.className = ''"></p>
                </div>
                
                <br></br>

                <div class="">Andet:
                  <p><input placeholder="Kortnummer..." name="Kortnummer" oninput="this.className = ''"></p>
                  <p>Kortdata - Bip kort - Eleven gemmes automatisk efter kortbip!<p>
                  <p><input placeholder="Indlæs kort..." name="Kortdata" oniput="this.className = ''"></p> 

		
                  </p> Tryk færdig, så gemmes eleven, og du kan oprette en ny elev.</p> 

                <br></br>

                <div style="overflow:auto;">
                  <div style="float:right;">
                    <input href="gf1login.hotskp.dk" type="submit" value="Færdig" id="nextBtn" name="submit"/>
                  </div>
                </div>
                
                <!-- Circles which indicates the steps of the form: 
                <div style="text-align:center;margin-top:40px;">
                  <span class="step"></span>
                  <span class="step"></span>
                  <span class="step"></span>
                  <span class="step"></span>
                  <span class="step"></span>
                  <span class="step"></span>
                  <span class="step"></span>
                  <span class="step"></span>
                  <span class="step"></span>
                </div> -->
                
        </form>
                
  <!-- <script src="script-opretElever.js"></script> -->
  
</body>    
<script>
  function myFunction() {
      var x = document.getElementById("myInput");
      if (x.type === "password") {
          x.type = "text";
      } else {
          x.type = "password";
      }
  }
</script>

     
<!--  -->


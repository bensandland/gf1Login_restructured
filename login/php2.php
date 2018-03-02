<?php
// Initialize the session
session_start();
 
// If session variable is not set it will redirect to login page
if(!isset($_SESSION['username']) || empty($_SESSION['username'])){
  header("location: index.php");
  exit;
}
?>

<?php
include_once "konfigurations-filer/conn.php";

// Insætter i opret elever (tabel)

if (isset($_POST['submit'])) { 

    $Fornavn = $_POST ['LærerFornavn'];
    $Efternavn = $_POST ['LærerEfternavn'];
    $Brugernavn = $_POST ['LærerBrugernavn'];
    $Adgangskode = $_POST ['LærerAdgangskode'];
    // $sql = "Select elev from elever where ElevFirstname"
    
    $tabeldata = "INSERT INTO adminLogin (fornavn, efternavn, username, password)
        VALUES ('$Fornavn', '$Efternavn', '$Brugernavn', '$Adgangskode')";

    $resultat = mysqli_query($conn, $tabeldata);
    if (!$resultat){ 
        echo "data er ikke blevet uploadet";
        echo mysqli_error($conn);  
    }else {
        $tabeldata = "SELECT ElevId FROM elever Where ElevFirstname = '".$Fornavn."' AND ElevLastname='".$Efternavn."'";
        echo mysqli_error($conn);   
        
        $resultat = mysqli_query($conn, $tabeldata);
      
    if(!$resultat){
        echo "donno";
    }
}
if ($resultat) {
   
    echo "\n Lærer blev reistreret";

}

else {
    echo "\n FEJL - Lærer blev ikke oprettet!";
}
    

}
else {
    echo "\n Fejl - Du trykkede ikke på færdig";
}

mysqli_close($conn);

?>

<br></br>
<html>

<body>
<a class="button" href="http://gf1login.hotskp.dk/-opretLærer.php">Opret ny lærer</a> 
<br></br>
<a class="button" href="http://gf1login.hotskp.dk/oversigt.php">Oversigt</a>
</body>

</html>

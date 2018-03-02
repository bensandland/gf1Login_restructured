<?php
// Initialize the session
session_start();
 
// If session variable is not set it will redirect to login page
if(!isset($_SESSION['username']) || empty($_SESSION['username'])){
  header("location: index.php");
  exit;
}
?><?php

include_once "../cfg/dbConn.php";


$encryptionMethod = "AES-256-CTR";
$secretHash = "key";
// while ($info = mysqli_fetch_array($data))
//     {

// echo "Elev fornavn:" . $info['ElevFirstname'] . "<br/>";
// echo "Elev efternavn:" . $info['ElevLastname'] . "<br/>";
// //echo "Elev kortnummer:" . $info['ElevCardNum'] . "<br/>";
// echo "Elev billede:" . $info['ElevImage'] . "<br/>";
// //echo "Elev adresse:" . $info['ElevAdresse'] . "<br/>";
// //echo "Elev postnummer:" . $info['ElevPostNr'] . "<br/>";
// //echo "Elev by:" . $info['ElevBy'] . "<br/>";
// //echo "Elev land:" . $info['ElevLand'] . "<br/>";
// //echo "Elev mail:" . $info['ElevMail'] . "<br/>";
// //echo "Elev telefon:" . $info['ElevTelefon'] . "<br/>";
// //echo "Elev fødselsdag:" . $info['ElevBDag'] . "<br/>";
// //echo "Elev fødseslmåned:" . $info['ElevBMonth'] . "<br/>";
// //echo "Elev fødselsår:" . $info['ElevBYear'] . "<br/>";
// //echo "Elev IGMU-Spor:" . $info['ElevIgmu'] . "<br/>";
// //echo "Elev mentor:" . $info['ElevMentor'] . "<br/>";
// //echo "Elev sagsbehandler:" . $info['ElevSagsbehandler'] . "<br/>";
// //echo "Elev skole start:" . $info['ElevSkoleStart'] . "<br/>";
// //echo "Elev skole slut:" . $info['ElevSkoleSlut'] . "<br/>";
// //echo "Elev brugernavn:" . $info['ElevLoginNavn'] . "<br/>";
// //echo "Elev adgangskode:" . $info['ElevLoginKode'] . "<br/>";
// //echo "Elev ID-nummer:" . $info['ElevId'] . "<br><br/>"; 

// //echo '<img src="data:image/jpeg;base64,'.base64_encode( $result['image'] ).'"/>';      -- Skal muligvis bruges senere - Indsætelse af billede


//     }
// Insætter i opret elever (tabel)

if (isset($_POST['submit'])) { 

    $Fornavn = $_POST ['Fornavn'];
    $Efternavn = $_POST ['Efternavn'];
    $Kortnummer = $_POST ['Kortnummer'];
    $Kortdata = $_POST ['Kortdata'];
    $Image = $_POST ['file'];
    $Adresse = $_POST ['Adresse'];
    $Postnummer = $_POST ['Postnummer'];
    $By = $_POST ['By'];
    $Land = $_POST ['Land'];
    $Mail = $_POST ['Mail'];
    $Telefon = $_POST ['Nummer'];
    $Fødselsdag = $_POST ['BDag'];
    //$Fødselsmåned = $_POST ['BMåned'];
    //$Fødselsår = $_POST ['BÅr'];
    $Hold = $_POST ['Hold'];
    $Mentor = $_POST ['Mentor'];
    $Sagsbehandler = $_POST ['Sagsbehandler'];
    $Skolestart = $_POST ['Skolestart'];
    $Skoleslut = $_POST ['Skoleslut'];
    $Brugernavn = $_POST ['Brugernavn' ];
    $Adgangskode = password_hash($_POST ['Adgangskode'],PASSWORD_DEFAULT);
    $Beskrivelse = $_POST ['Beskrivelse'];
    // $sql = "Select elev from elever where ElevFirstname"
    
    $tabeldata = "INSERT INTO elever (ElevFirstname, ElevLastname, ElevCardNum, ElevKortData, ElevImage, ElevAdresse, ElevPostNr, ElevBy, ElevLand, ElevMail, ElevTelefon, ElevBDag, ElevIgmu, ElevMentor, ElevSagsbehandler, ElevSkoleStart, ElevSkoleSlut, username, password, ElevBeskrivelse)
        VALUES ('$Fornavn', '$Efternavn', '$Kortnummer', '$Kortdata', '$Image', '$Adresse', '$Postnummer', '$By', '$Land', '$Mail', '$Telefon', '$Fødselsdag', '$Hold', '$Mentor', '$Sagsbehandler', '$Skolestart', '$Skoleslut', '$Brugernavn', '$Adgangskode', '$Beskrivelse')";

    $resultat = mysqli_query($conn, $tabeldata);
    if (!$resultat){ 
        echo "data er ikke blevet uploadet: ";
        echo mysqli_error($conn);  
    }else {
        $tabeldata = "SELECT ElevId FROM elever Where ElevFirstname = '".$Fornavn."' AND ElevLastname='".$Efternavn."'";
        echo mysqli_error($conn);   
        
        $resultat = mysqli_query($conn, $tabeldata);
      
    if(!$resultat){
        echo "donno";
    }else {
        $row = mysqli_fetch_assoc($resultat);
        echo $row['ElevId'];
        $sql = "Insert Into fleks (ElevId,ElevKortData) Values(".$row['ElevId'].",".$Kortdata.")";
        $result = mysqli_query($conn,$sql);
    }
}
if ($resultat) {
   
    echo "\n Elev blev reistreret";

}

else {
    echo "\n FEJL - Elev blev ikke oprettet!";
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
<a href="./-opretElever.php">Opret ny elev</a> 
<br></br>
<a href="../oversigt.php">Oversigt over oprettet elever</a>
</body>

</html>

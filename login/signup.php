<?php
$server = "localhost";
$brugernavn = "root";
$kode = "1234";
$con = mysqli_connect('localhost', 'root', '1234');
$db = "login1";

mysqli_connect( $server , $brugernavn , $kode) or die();

echo "Forbundet til mysql server.<br><br/>";

mysqli_select_db($con, $db) or die();

echo "Forbundet til database.<br><br/>";

$data = mysqli_query($con, "SELECT * FROM elever") or die();

while ($info = mysqli_fetch_array($data))
    {

echo "Elev fornavn:" . $info['ElevFirstname'] . "<br/>";
echo "Elev efternavn:" . $info['ElevLastname'] . "<br/>";
//echo "Elev kortnummer:" . $info['ElevCardNum'] . "<br/>";
echo "Elev billede:" . $info['ElevImage'] . "<br/>";
//echo "Elev adresse:" . $info['ElevAdresse'] . "<br/>";
//echo "Elev postnummer:" . $info['ElevPostNr'] . "<br/>";
//echo "Elev by:" . $info['ElevBy'] . "<br/>";
//echo "Elev land:" . $info['ElevLand'] . "<br/>";
//echo "Elev mail:" . $info['ElevMail'] . "<br/>";
//echo "Elev telefon:" . $info['ElevTelefon'] . "<br/>";
//echo "Elev fødselsdag:" . $info['ElevBDag'] . "<br/>";
//echo "Elev fødseslmåned:" . $info['ElevBMonth'] . "<br/>";
//echo "Elev fødselsår:" . $info['ElevBYear'] . "<br/>";
//echo "Elev IGMU-Spor:" . $info['ElevIgmu'] . "<br/>";
//echo "Elev mentor:" . $info['ElevMentor'] . "<br/>";
//echo "Elev sagsbehandler:" . $info['ElevSagsbehandler'] . "<br/>";
//echo "Elev skole start:" . $info['ElevSkoleStart'] . "<br/>";
//echo "Elev skole slut:" . $info['ElevSkoleSlut'] . "<br/>";
//echo "Elev brugernavn:" . $info['ElevLoginNavn'] . "<br/>";
//echo "Elev adgangskode:" . $info['ElevLoginKode'] . "<br/>";
//echo "Elev ID-nummer:" . $info['ElevId'] . "<br><br/>"; 

//echo '<img src="data:image/jpeg;base64,'.base64_encode( $result['image'] ).'"/>';      -- Skal muligvis bruges senere - Indsætelse af billede


    }
// Insætter i opret elever (tabel)

if (isset($_POST['submit'])) { 

    $Fornavn = $_POST ['Fornavn'];
    $Efternavn = $_POST ['Efternavn'];
    $Kortnummer = $_POST ['Kortnummer'];
    $Kortdata = $_POST ['Kortdata'];
    $Image = $_POST ['Myfile'];
    $Adresse = $_POST ['Adresse'];
    $Postnummer = $_POST ['Postnummer'];
    $By = $_POST ['By'];
    $Land = $_POST ['Land'];
    $Mail = $_POST ['Mail'];
    $Telefon = $_POST ['Nummer'];
    $Fødselsdag = $_POST ['BDag'];
    $Fødselsmåned = $_POST ['BMåned'];
    $Fødselsår = $_POST ['BÅr'];
    $Hold = $_POST ['Hold'];
    $Mentor = $_POST ['Mentor'];
    $Sagsbehandler = $_POST ['Sagsbehandler'];
    $Skolestart = $_POST ['Skolestart'];
    $Skoleslut = $_POST ['Skoleslut'];
    $Brugernavn = $_POST ['Brugernavn'];
    $Adgangskode = $_POST ['Adgangskode'];
    $Beskrivelse = $_POST ['Beskrivelse'];


    $tabeldata = "INSERT INTO login1.elever (ElevFirstname, ElevLastname, ElevCardNum, ElevKortData, ElevImage, ElevAdresse, ElevPostNr, ElevBy, ElevLand, ElevMail, ElevTelefon, ElevBDag, ElevBMonth, ElevBYear, ElevIgmu, ElevMentor, ElevSagsbehandler, ElevSkoleStart, ElevSkoleSlut, ElevLoginNavn, ElevLoginKode, ElevBeskrivelse) 
        VALUES ('$Fornavn', '$Efternavn', '$Kortnummer', '$Kortdata', '$Image', '$Adresse', '$Postnummer', '$By', '$Land', '$Mail', '$Telefon', '$Fødselsdag', '$Fødselsmåned', '$Fødselsår', '$Hold', '$Mentor', '$Sagsbehandler', '$Skolestart', '$Skoleslut', '$Brugernavn', '$Adgangskode', '$Beskrivelse')";

    $resultat = mysqli_query($con, $tabeldata);

    $tabeldata = "INSERT INTO login1.fleks (ElevKortData)
        VALUES ('$Kortdata')";

    $resultat = mysqli_query($con, $tabeldata);

    if ($resultat) {
        echo "Bruger blev reistreret";
    }

    else {
        echo "FEJL - Bruger blev ikke oprettet!";
    }


}

else {
    echo "Fejl - Du trykkede ikke på færdig";
}

mysqli_close($con);

?>

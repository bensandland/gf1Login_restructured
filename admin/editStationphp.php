<?php 
include "../konfigurations-filer/conn.php";


$_POST['ElevKortDataOld'];

$sql = "UPDATE elever SET ElevTelefon = ".trim($_POST['ElevTelefon'])."
, ElevAdresse = '".trim($_POST['ElevAdresse'])."'
, ElevMail = '".trim($_POST['ElevMail'])."'
, ElevBDag = '".trim($_POST['ElevBDag'])."'
, ElevMentor = '".trim($_POST['ElevMentor'])."'
, ElevSagsbehandler = '".trim($_POST['ElevSagsbehandler'])."'
, ElevBeskrivelse = '".trim($_POST['ElevBeskrivelse'])."'
, ElevCardNum = ".trim($_POST['ElevCardNum'])."
, ElevKortData ='".trim($_POST['ElevKortData'])."'
, ElevSkoleStart ='".trim($_POST['ElevSkoleStart'])."'
, ElevSkoleSlut ='".trim($_POST['ElevSkoleSlut'])."'
WHERE ElevId = ".trim($_POST['id'])."";


if ($conn->query($sql) === TRUE) {
    echo "Record updated Successfully";
} else {
    echo "well fuck";
}

echo $sql;

header('location:../oversigt.php') ;
?>
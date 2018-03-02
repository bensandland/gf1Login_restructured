<?php
session_start();

// If session variable is not set it will redirect to login page
if(!isset($_SESSION['username']) || empty($_SESSION['username'])){
 header("location: index.php");
 exit;
}


include_once "../konfigurations-filer/conn.php";





 $sql = "SELECT * FROM kortlog WHERE Kortdata ='".$_POST['studentId']."' AND dag ='".$_POST['date']."'";
$result = mysqli_query($conn,$sql);

$row = mysqli_fetch_assoc($result);



if ($row['areYouSick'] !== 3){ 
    $sql = "UPDATE kortlog SET areYouSick =3 WHERE Kortdata ='".$_POST['studentId']."' AND dag ='".$_POST['date']."'";
    $result = mysqli_query($conn,$sql);
    echo " Du er syg";
   
    if($row['areYouSick'] == null)
    { 
        
        echo $sql = "INSERT INTO kortlog (tid, dag, Kortdata,tidTimeStamp,Kommentar, areYouSick) VALUES ( '".date('H.i.s')."', '".$_POST['date']."', '".$_POST['studentId']."','".date('Y-m-d H:m:s')."','dood', 3 )";
        $result = mysqli_query($conn,$sql);  
    }
}


if ($row['areYouSick'] == 3){
    $sql = "UPDATE kortlog SET areYouSick =0 WHERE Kortdata ='".$_POST['studentId']."' AND dag ='".$_POST['date']."'";
    $result = mysqli_query($conn,$sql);  
    echo "Du er ikke syg";
    
    if($row['Kommentar']=="dood"){ 
        echo $sql = "DELETE FROM kortlog Where Kortdata ='".$_POST['studentId']."' AND dag ='".$_POST['date']."' AND Kommentar = 'dood'";
        $result = mysqli_query($conn,$sql);
    }
}

$id =  $_POST['id'];
 header("Location:showstation.php?elevid=".$id);
 


?>
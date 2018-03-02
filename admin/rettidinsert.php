<?php
$error = 0;
include_once "../cfg/dbConn.php";
if (isset($_GET['delete'])) $getTime = "oldtime" . (string)$_GET['delete'];


if (isset($_GET['new'])) {
    $sql = "INSERT INTO `kortlog` (`Tid`, `dag`, `Kortdata`,`areYouSick`) VALUES ('00.00.00','".$_POST['date']."','".$_POST['studentId']."','0')";
    if ($conn->query($sql) === TRUE) {
        echo "Record updated Successfully";
    } else {
        echo "well fuck";
        
    }
    header('Location: showStudent.php?elevid='.$_POST['id']);
}

else if (isset($_GET['delete'])) {
    $sql = "DELETE FROM `kortlog` WHERE `Tid` ='".$_POST[$getTime]."' and `Kortdata` = '".$_POST['studentId']."' and `dag` ='". $_POST['date']."'";
    if ($conn->query($sql) === TRUE) {
        echo "Record updated Successfully";
    } else {
        echo "well fuck";
    }
    header('Location: showStudent.php?elevid='.$_POST['id']);

} else if (isset($_GET['ret'])) {
    $count = $_POST['count'];
    $kort = $_POST['studentId'];
    $date = $_POST['date'];

    for ($i = 0; $i < $count; $i++) {
        $selecter = "time" . (string)$i;
        $selecter2 = "oldtime" . (string)$i;
        $sql = "UPDATE `kortlog` SET `Tid`='".$_POST[$selecter]."' WHERE `dag` = '".$date."' and `Kortdata` = '".$kort."' and `Tid`= '".$_POST[$selecter2]."'";
        $pattern = "/(.:|\.)/";

        // Find dot's in time
        if (preg_match($pattern, $_POST[$selecter])) {
            if ($conn->query($sql) === TRUE) {
                echo "Record updated Successfully";
            } else {
                echo "Something went wrong with the database-query!";
            }
        }
        else {
            echo "Indtast venligst et tidspunkt med . eller : i";
            $error = 1;
        }
    } // End of for-loop

    $conn->close();

    if ($error == 1){
        header('Location: showStudent.php?elevid='.$_POST['id'].'&error=1');
    }
    else {
        header('Location: showStudent.php?elevid='.$_POST['id']);
    }
}
?>
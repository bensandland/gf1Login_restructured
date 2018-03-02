
<?php 

//  lefunctions
function  dateReverse($sdate){
  
  $date = strtotime($sdate);
  echo date("d-m-y", $date);

}
  
function bindestregFormatering($itid, &$bool ,$tid){


  $tid = substr($itid,0, 5)." ";
  if($bool % 2 == 0){
    $tid .="-";

  } else {
    $tid .= "<br>";

  }
  $bool++;

  return $tid;  
  
}
function tidErIMellem($start, $slut, $ankomstTid){

$timestirng = str_replace(".",":",$ankomstTid);
$tidFormatering =  substr($timestirng,0,5);

$dagMorgenOpen = new DateTime($start);
$dagMorgenClose = new DateTime($slut);
$AnkomstTid= new DateTime($tidFormatering);


if($AnkomstTid >= $dagMorgenOpen && $AnkomstTid <=$dagMorgenClose){
  $erDuKommet = true;
  

} else{ 
  $erDuKommet = false;

}
return $erDuKommet;
}

function colorCode($date,$conn,$elevKortData, $morningStart, $morningEnd, $schoolStart, $schoolEnd){

  $sql3 = "SELECT dag, tid, areYouSick from kortlog  where dag = '".$date."' and Kortdata = '".$elevKortData."'";
  $result3 = mysqli_query($conn,$sql3);

  $sql4 = "SELECT * FROM `elever` WHERE `ElevKortData` = '".$elevKortData."'";
  $result4 = mysqli_query($conn,$sql4);

  while($row4 = mysqli_fetch_assoc($result4)) {
    $skoleStart = $row4['ElevSkoleStart'];
  }
  
  $skoleStart = str_replace("-","",$skoleStart);
  $dateToCompare = str_replace("-","",$date);
  $date;
  $result3 = mysqli_query($conn, $sql3);
  $erDuKommet = false;
  $erDuTagetHjem = false;
  $tid = null;
  $bool = 0;
  $comment = "";
  $tdColor = "<td>";
  $sick = 0;
  
  
  // ------------------------------------------------------------------------------------------------------------------------
  // farve kode, kode
    while($row3 = mysqli_fetch_assoc($result3))
    {
      if ($bool<1){
        $erDuKommet = tidErIMellem($morningStart,$morningEnd,$row3['tid']);
      }

      else
      {
        $erDuTagetHjem = tidErIMellem($schoolStart,$schoolEnd,$row3['tid']);
      }
      
      $tid .= bindestregFormatering($row3['tid'], $bool ,$tid);
      $sick=$row3['areYouSick'];
    }
    if ($skoleStart > $dateToCompare) {
      $tdColor = "<td class='colorCodeField' style='background-color: #ffffff'>";
      $comment = "Ikke startet";
    }
    else {

      if($erDuKommet)
      {  
        $tdColor = "<td class='colorCodeField' style='background-color: #44B3C2'>";

        if ($erDuTagetHjem ==false && $bool > 1 )
          {
            $tdColor = "<td class='colorCodeField' style='background-color: #F1A94E'>";
          }
      }

      if(date('Y-m-d') !== $date)
      { 
        $tdColor = "<td class='colorCodeField' style='background-color: #F1A94E'>";
      }
        
        
      if ($erDuTagetHjem)
      {
        $tdColor = "<td class='colorCodeField' style='background-color: #44B3C2'>";

        if($erDuKommet == false && $bool > 1)
        {
          $tdColor = "<td class='colorCodeField' style='background-color: #F1A94E'>";
        }
      }

      if($erDuKommet == false && $erDuTagetHjem == false) 
      {
        $tdColor = "<td class='colorCodeField' style='background-color: #F1A94E'>";
      }

      if($bool ==0)
      {
        $tdColor = "<td class='colorCodeField' style='background-color: #E45641'>";
        $comment=  "Fraværende";
      }
      $row3 = mysqli_fetch_assoc($result3);
        
        
      if ($sick== 1)
      {
        $tdColor = "<td class='colorCodeField' style='background-color: #F2EDD8'>";
        $comment = "syg";
        $tid = "";
      }
      if ($sick ==2)
      { 
        $tdColor = "<td class='colorCodeField' style='background-color: #7B8D8E'>";
        $comment = "Godkendt fravær";
      }
      if($sick == 3)
      {
        $tdColor = "<td class='colorCodeField' style='background-color: #5D4C46'>";
        $comment = "Praktik";
        $tid = "";
      }
    }

echo $tdColor;
echo "<center>".$comment. "</center>" ;
echo $tid; 

$tdColor = "";
$comment = "";
$tid = "";
  }

?>
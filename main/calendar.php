<?php

  include "../admin/attendanceFunc.php";
  include_once "../cfg/dbConn.php";

  $sql = 'SELECT * FROM elever';
  $result = mysqli_query($conn, $sql);

  ?>

<script type="text/javascript">
  function myFunction() {
    // Declare variables 
    var input, filter, table, tr, td, i;
    input = document.getElementById("myInput");
    filter = input.value.toUpperCase();
    table = document.getElementById("myTable");
    tr = table.getElementsByTagName("tr");

    // Loop through all table rows, and hide those who don't match the search query
    for (i = 0; i < tr.length; i++) {
      td = tr[i].getElementsByTagName("td")[0];
      if (td) {
        if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
          tr[i].style.display = "";
        } else {
          tr[i].style.display = "none";
        }
      } 
    }
  }
</script>



<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="../css/calender.css">
</head>

<!-- data table -->
<table id="myTable">
  <thead>
    <tr class="header">
      <td>ID</td>    
      <td>NAVN</td>
      <?php  
            $row = mysqli_fetch_assoc($result);

             $sql3 = "SELECT dag from kortlog Group by dag DESC" ;
             $inc = 0;
             $result3 = mysqli_query($conn, $sql3);
            //  dato loop
             while ($row3 = mysqli_fetch_assoc($result3))
             {
               if($inc < 10)
                {
                  mysqli_error($conn); 
                  echo"<td>". $row3['dag']; 
                }
              $inc ++;
              }
         "</td>";
         ?>
    </tr>
    
    </thead> 
    <tbody>
      <?php
        $result = mysqli_query($conn, $sql);
        // elevlogin tid'ers loop. 
        while($row = mysqli_fetch_assoc($result)){
        $sql2 = "SELECT * from elever  where ElevKortData ='".$row['ElevKortData']."'"; 
        $result2 = mysqli_query($conn, $sql2);
        
        
        while ($row2 = mysqli_fetch_assoc($result2) ){
          
        ?>
              <tr>
              <td> <?php echo $row['ElevId'] ?></td>
              <form action="../admin/showStudent.php" method="get">
                
                  <td class="elevNavnBox"><button class ="elevb" name="elevid" type="submit" value= <?php echo $row2['ElevId']?> ><?php  echo $row2['ElevFirstname'] ." ". $row['ElevLastname'];?></button></td>
                
              </form>
                <?php 
                
                $sqldate = "SELECT dag from kortlog Group by dag DESC" ;
                
                $result3 = mysqli_query($conn, $sqldate);
                $inc=0;
                // farve loop med dag variable  aka farverne er forskellige for hvad dag det er. 1 = mandag, 2 = tirsdag osv. udkommenter $day for at se hvilkedage er hvad. Farve loopet er i funktioner og ligner lort hehe xd
                while ($rowdate = mysqli_fetch_assoc($result3)){
                  if($inc < 10){
                    $day = $rowdate['dag'];
                    $day=strftime("%w",strtotime($day)); 
                    if($day == 1 || $day == 2 ||  $day == 3)
                    {
                      colorCode( $rowdate['dag'], $conn,$row['ElevKortData'],'6:00','8:30','14:15','18:00' );
                    //  echo $day;
                    }
                    if ($day == 4)
                    {
                      colorCode( $rowdate['dag'], $conn,$row['ElevKortData'],'6:00','8:30','13:00','18:00' );
                      // echo $day;
                    }
                    if ($day == 5)
                    {
                      colorCode( $rowdate['dag'], $conn,$row['ElevKortData'],'6:00','8:30','12:15','18:00' );
                      // echo $day;
                    }
                    if ($day == 6 || $day == 0)
                    {
                      colorCode( $rowdate['dag'], $conn,$row['ElevKortData'],'6:00','8:30','14:15','18:00') ;
                      // echo $day;
                    }
                ?>
                 
            <?php
          }
          $inc++;
        }
        echo "</tr></td>";
    }
    }
?>
    </tbody>
</table>
</html>

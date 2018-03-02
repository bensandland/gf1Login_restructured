<?php
  include_once "attendanceFunc.php";
  include "../templates/mainTempl.php";

$encryptionMethod = "AES-256-CTR";
$secretHash = "key";

?>

    <script src="../js/jquery-3.2.1.min.js"></script>
    <script type="text/javascript">

      $(document).ready(function() {
        $(".sickBtn").change(function() {
          if (this.checked) {
            $(this).data("previousColor", $(this).closest("td").siblings(".colorCodeField").css("background-color"));
            $(this).closest("td").siblings(".colorCodeField").css("background-color", "lightblue");
          }
          else {
            $(this).closest("td").siblings(".colorCodeField").css("background-color", $(this).data("previousColor"));
          }
        });
      });
    </script>
    <div class="container">
        <div class="spanTable">
          <div class= "flyttebox3">

          <?php
            $sql = "SELECT * from elever where Elevid = ".$_GET['elevid']."";
            $result = mysqli_query($conn,$sql);
            $row = mysqli_fetch_assoc($result);
            $sqldate = "SELECT dag from kortlog  group by dag DESC";
            $resultdate = mysqli_query($conn,$sqldate);

            if (isset($_GET['error'])) {
              echo "<p style='color:red; font-weight:bold;'>Indtast venligst et tidspunkt med . eller : i!</p>";
            }

            echo "<br><h1>".  $row['ElevFirstname']." ".  $row['ElevLastname'].  "</h1><br>";
          ?>

            <table id="table">
              <tr>
                </th>
              </tr>
            </table>
            <table>
                <th> Dato </th>
                <th> Justering </th>
                <th> Syg </th>
                <th> Godkendt fravær </th>
                <th> Praktik </th>
                <th> Ret tid </th>

                <?php
                  while ($rowdate = mysqli_fetch_assoc($resultdate))
                ?>
              </tr>
              <tr>
                <td>
                  <?php                     
                      dateReverse($rowdate['dag']);
                   ?>
                </td>
                
                  <?php
                    $day = $rowdate['dag'];
                    $day=strftime("%w",strtotime($day)); 
                    if($day == 1 || $day == 2 ||  $day == 3)
                    {
                      colorCode( $rowdate['dag'], $conn,$row['ElevKortData'],'6:00','8:30','14:15','18:00' );
                     //echo $day;
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
                <td>

                <label class="container">
                <form action="syg.php" method="POST">
                <center><input class="sickBtn" type="submit" value="Syg" style="background-color:#DB1616;"></center>
                <input name="studentId" type="hidden" value=<?php echo $row['ElevKortData'] ?>></input>
                <input name="date" type="hidden" value=<?php echo $rowdate['dag']?>></input>
                <input name="id" type="hidden" value= <?php echo $_GET['elevid']?>> </input>
                </form>
                <span class="checkmark"></span>
                </label>

                </td>
                <td>
                <form action="lovligtfravær.php" method="POST">
                <center><input class="sickBtn" type="submit" value="Godkendt fravær" style="background-color:#4CAF50;"></center>
                <input name="studentId" type="hidden" value=<?php echo $row['ElevKortData'] ?>></input>
                <input name="date" type="hidden" value=<?php echo $rowdate['dag']?>></input>
                <input name="id" type="hidden" value= <?php echo $_GET['elevid']?>> </input>
                </form>
                </td>
                <td>
                <form action="praktik.php" method="POST">
                <center><input class="sickBtn" type="submit" value="Praktik" style="background-color:#EE5F2D;"></center>
                <input name="studentId" type="hidden" value=<?php echo $row['ElevKortData'] ?>></input>
                <input name="date" type="hidden" value=<?php echo $rowdate['dag']?>></input>
                <input name="id" type="hidden" value= <?php echo $_GET['elevid']?>> </input>
                
                </form>
                </td>

                <!-- forsøg på oprettelse af ret tid funktion til database-->
                <td>

                <label class="container">
                <form action="rettid.php" method="POST">
                <center><input class="sickBtn" type="submit" value="Ret" style="background-color:#35424a;"></center>
                <input name="studentId" type="hidden" value=<?php echo $row['ElevKortData'] ?>></input>
                <input name="date" type="hidden" value=<?php echo $rowdate['dag']?>></input>
                <input name="id" type="hidden" value= <?php echo $_GET['elevid']?>> </input>
                </form>
                <span class="checkmark"></span>
                </label>

                </td>
              </tr>
            </table>
            </div>
          </div>
         <table class="personliginfo">
           <tr>
             <th>Telefon:</th>
             <td><?php echo chunk_split($row['ElevTelefon'], 2, ' ')."</p>"; ?></th>
          </tr>
          <tr>
            <th>Adresse:</th>
            <td><?php echo $row['ElevAdresse'].", ". $row['ElevPostNr']. " ". $row['ElevBy']. "</p>";?></th>
          </tr>
          <tr>
            <th>Mail:</th>
            <td><?php echo $row['ElevMail']?></th>
          </tr> 
          <tr>
            <th>Fødselsdag:</th>
            <td><?php echo  dateReverse($row['ElevBDag'])?></th>
          </tr>
          <tr>
            <th>Mentor:</th>
            <td><?php echo  $row['ElevMentor']?></th>
          </tr>
          <tr>
            <th>Sagsbehandler:</th>
            <td><?php echo  $row['ElevSagsbehandler']?></th>
          </tr>
          <tr>
            <th>IGMU Spor:</th>
            <td><?php echo  $row['ElevIgmu']?></th>
          </tr>
          <tr>
            <th>Kortnummer:</th>
            <td><?php echo  $row['ElevCardNum']?></th>
          </tr>
          <tr>
            <th>Skolestart:</th>
            <td><?php echo  $row['ElevSkoleStart']?></th>
          </tr>
          <tr>
            <th>Forventet afsluttet:</th>
            <td><?php echo  $row['ElevSkoleSlut']?></th>
          </tr>

          <tr>
            <th>Bemærkningsfelt:</th>
            <td><?php echo  $row['ElevBeskrivelse']?></th>
          </tr>  

        <form action="editStation.php" method="get">
          <td class="dude"><button name="elevid" type="submit" class="button" value="<?php echo $_GET['elevid'] ?>"> Rediger oplysninger </button></td>
        </form>
      </table>
    </div>
    </div>
<?php 
  include "../templates/footer.php";
?>
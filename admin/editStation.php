<?php

// MIGHT NEED THIS LATER - right now it needs to go a directory up to redirect correctly, since the sessConn file wont go a folder up
// if(!isset($_SESSION['username']) || empty($_SESSION['username'])){
// header("location: ..index.php");
// exit;
// }

// Including database-connection file is not required, since it's inside the template (menuHeader.php - underneath body tag)
  include_once "attendanceFunc.php";
  include "../templates/mainTempl.php";
?>
<div class="wraper">
  <div class="content">
    <div class="spanTable">

      <?php
        $sql = "SELECT * from elever where Elevid = ".$_GET['elevid']."";
        $result = mysqli_query($conn,$sql);
        $row = mysqli_fetch_assoc($result);
        $sqldate = "SELECT dag from kortlog  group by dag DESC";
        $resultdate = mysqli_query($conn,$sqldate);

        echo "<br><h1>".  $row['ElevFirstname']." ".  $row['ElevLastname'].  "</h1><br>";
      ?>

        <table>
          <tr>
            <th> Dato </th>
            <th> Justering </th>
            <th> Syg </th>
            <th> Godkendt fravær </th>
            <th> Praktik </th>

            <?php
                while ($rowdate = mysqli_fetch_assoc($resultdate)) {
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
                  if ($day == 6 || $day == 7)
                  {
                    colorCode( $rowdate['dag'], $conn,$row['ElevKortData'],'6:00','8:30','14:15','18:00') ;
                    // echo $day;
                  }                  
  
              ?>

              </td>
              <td>
                <label class="container">
                  <form action="syg.php" method="POST">
                    <center>
                      <input class="sickBtn" type="submit" value="Syg" style="background-color:#DB1616";>
                    </center>
                    <input name="studentId" type="hidden" value=<?php echo $row[ 'ElevKortData'] ?>></input>
                    <input name="date" type="hidden" value=<?php echo $rowdate[ 'dag']?>></input>
                    <input name="id" type="hidden" value=<?php echo $_GET[ 'elevid']?>> </input>
                  </form>
                  <span class="checkmark"></span>
                </label>
              </td>

              <td>
                <form action="lovligtfravær.php" method="POST">
                  <center>
                    <input class="sickBtn" type="submit" value="Godkendt fravær" style="background-color:#4CAF50;"">
                  </center>
                  <input name="studentId" type="hidden" value=<?php echo $row[ 'ElevKortData'] ?>></input>
                  <input name="date" type="hidden" value=<?php echo $rowdate[ 'dag']?>></input>
                  <input name="id" type="hidden" value=<?php echo $_GET[ 'elevid']?>> </input>
                </form>
              </td>
              <td>
                <form action="praktik.php" method="POST">
                  <center>
                    <input class="sickBtn" type="submit" value="Praktik" style="background-color:#EE5F2D;"">
                  </center>
                  <input name="studentId" type="hidden" value=<?php echo $row[ 'ElevKortData'] ?>></input>
                  <input name="date" type="hidden" value=<?php echo $rowdate[ 'dag']?>></input>
                  <input name="id" type="hidden" value=<?php echo $_GET[ 'elevid']?>> </input>
                </form>
              </td>
    <!--spantable-->


    </tr>
    <?php
        } // End of while loop
        ?>
      </tr>
        </table>
        </div>
        </div>
        </div>
        
        <div class="personliginfo">
          <form action="editStationphp.php " method="POST">
          <?php
            $sql = "select * from elever where Elevid = ".$_GET['elevid']."";
            $result = mysqli_query($conn,$sql);
            $row = mysqli_fetch_assoc($result);
          ?>
            <table>
              <tr>
                <th> telefon
                  <th>
                    <input type="text" name="ElevTelefon" value="<?php echo $row['ElevTelefon'] ?>"> </th>
              </tr>
              <tr>
                <th> adresse
                  <th>
                    <input type="text" name="ElevAdresse" value="<?php echo $row['ElevAdresse'] ?>"> </th>
              </tr>
              <tr>
                <th> E-mail
                  <th>
                    <input type="text" name="ElevMail" value="<?php echo $row['ElevMail'] ?>"> </th>
              </tr>
              <tr>
                <th> Fødselsdag
                  <th>
                    <input type="text" name="ElevBDag" value="<?php echo $row['ElevBDag'] ?>"> </th>
              </tr>
              <tr>
                <th> Mentor
                  <th>
                    <input type="text" name="ElevMentor" value="<?php echo $row['ElevMentor'] ?>"> </th>
              </tr>
              <tr>
                <th> Sagsbehandler
                  <th>
                    <input type="text" name="ElevSagsbehandler" value="<?php echo $row['ElevSagsbehandler'] ?>"> </th>
              </tr>
              <tr>
                <th> IGMU spor
                  <th>
                    <input type="text" name="ElevIgmu" value="<?php echo $row['ElevIgmu'] ?>"> </th>
              </tr>
              <tr>
                <th> Kortnummer
                  <th>
                    <input type="text" name="ElevCardNum" value="<?php echo $row['ElevCardNum'] ?>"> </th>
              </tr>
              <tr>
                <th> Skolestart
                  <th>
                    <input type="text" name="ElevSkoleStart" value="<?php echo $row['ElevSkoleStart'] ?>"> </th>
              </tr>
              <tr>
                <th> Forventet afsluttet:
                  <th>
                    <input type="text" name="ElevSkoleSlut" value="<?php echo $row['ElevSkoleSlut'] ?>"> </th>
              </tr>
              <tr>
                <th> Bemærkningsfelt:
                  <th>
                    <input type="text" name="ElevBeskrivelse" value="<?php echo $row['ElevBeskrivelse'] ?>"> </th>
              </tr>
              <tr>
                <th> KORTDATA
                  <th>
                    <input type="text" name="ElevKortData" value="<?php echo $row['ElevKortData'] ?>"> </th>
              </tr>

            </table>
            <input type="hidden" name="id" value="<?php echo $_GET['elevid'] ?>">
            <input type="hidden" name="ElevKortDataOld" value="<?php echo $row['ElevKortData'] ?>">
            <button type="submit">Save</button>

          </form>
        </div>
</div>

<?php 
  include "../templates/footer.php";
?>
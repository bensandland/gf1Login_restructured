<?php
    include_once "attendanceFunc.php";
    include "../templates/mainTempl.php";

    $encryptionMethod = "AES-256-CTR";
    $secretHash = "key";
?>
  <div class="wraper">
    <div class="content">
      <div class="spanTable">
        <div class= "flyttebox1">


        <?php
          $sql = "select * from elever where Elevid = ".$_GET['elevid']."";
          $result = mysqli_query($conn,$sql);
          $row = mysqli_fetch_assoc($result);
          
          $sql2 = "select dag, kortdata from kortlog  where kortdata ='".$row['ElevKortData']."' group by dag DESC"; 
          echo mysqli_error($conn);
          $result2 = mysqli_query($conn,$sql2);

        ?>
          <table id="table">
            <tr>
              <th class="dude">
                <?php  echo $row['ElevFirstname'] ." ". $row['ElevLastname'];?>
              </th>
            </tr>
          </table>
          <table>
            <tr>
              <th> dato </th>
              <th> justering</th>
              <th>beskrivelse </th>
              <?php
                while ($row2 = mysqli_fetch_assoc($result2)) { // Open first while-loop
              ?>
            </tr>
            <tr>
              <td>

                <?php 

                  dateReverse($row2['dag']);

                 ?>
              </td>
              <td>
                <?php
                  $sql3 = "select dag, tid from kortlog  where dag = '".$row2['dag']."' and Kortdata = '".$row['ElevKortData']."'";
                  $result3 = mysqli_query($conn,$sql3);
                  $tid = null;
                  $bool = 0;

                    while($row3 = mysqli_fetch_assoc($result3)){
                      bindestregFormatering($row3['tid'], $bool, $tid);
                    }
                 ?>
              </td>
              <td>
                <?php
                  $beskrivelse
                ?>
              </td>
            </tr>
            <?php
              } // Close first while-loop
            ?>
          </table>
          </div>
        </div>
            <div class="boks">
              <div class="elevinfo">
                  <?php
                    echo "<h1>".  $row['ElevFirstname']." ".  $row['ElevLastname'].  "</h1><br>"; 
                    echo "<p>- Telefon:". chunk_split($row['ElevTelefon'], 2, ' ')."</p>";
                    echo "<p>- Adresse: ". $row['ElevAdresse'].", ". $row['ElevBy']. "</p>";
                    echo "<p>- Mail: ". $row['ElevMail']."<br>"."- Fødselsdato: ";
                    echo  dateReverse($row['ElevBDag'])."<br><br></p>"; 
                    echo "<p>- Valgfag:<br></p>";
                    echo "<p>- Mentor: ".$row['ElevMentor']."<br></p>";
                    echo "<p>- Sagsbehandler ".$row['ElevSagsbehandler']."<br></p>";
                    echo "<p>- IGMU spor: <br></p>";
                    echo "<p>- Bemærkningsfelt: ".$row['ElevBeskrivelse']. "<br></p>";
                    echo "<p>- Fravær: workinpogress<br></p>";
                    echo "<p>- Kortnummer: ". $row['ElevCardNum']."</p><br>"; 
                  ?>
              </div>

              <div class="img">
                <img src="../img/img_avatar2.png" height="150" width="150">
              </div>
            </div>
    </div>

    <form action="editStation.php" method="get">
      <td class="dude"><button name="elevid" type="submit" value="<?php echo $_GET['elevid'] ?>"> Edit </button></td>
      </form>
<?php 
    include "../templates/footer.php";
?>
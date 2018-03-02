<html>
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="">
    <title>Mercantec | Velkommen</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/showstation.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

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
  </head>

  <body>
    <header>
      <div class="container">
        <div id="branding">
          <a href="../overview.php"> <h1>
            <span class="highlight">Mercantec</span> Viborg</h1></a>
        </div>
        <nav>
          <ul>
            <li>
            </li><li class="knap3"> </li>
            <li class="knap2"><a href="../overview.php">Elev-oversigt</a></li>
            <li class="knap1"><a href="../login/logout.php">Logud</a></li>
           </ul>
         </nav>
       </div>
     </header>

      
      <div class="icon-bar">
        <a title="Opret Elev" href="/Login-system/-opretElever.php"><i class="fa fa-plus"></i></a> 
        <a href="/image.php"><i class="fa fa-vcard"></i></a> 
        <a title="Afsluttet Elever" href="/afsluttetElever.php"><i class="fa fa-vcard"></i></a> 
        <a href="#"><i class="fa fa-question"></i></a>
        <a title="Opret Lærer" href="/Login-system/-opretL%C3%A6rer.php"><i class="fa fa-plus"></i></a> 
      </div>
      
    <div class="wrapper">
    <div class="content">
        
        
		<div id="editui">
		
		
		
<?php
  include_once "../cfg/dbConn.php";
  $count = 0;
  $line = "";
  $getForm = "";
  $sql = "SELECT * FROM kortlog WHERE dag = '".$_POST['date']."' and Kortdata = '".$_POST['studentId']."' order by tid asc";
?>

<h1> Dato: <?php echo $_POST['date'];?></h1>

<?php
    $line .= "<br>";
    $line .= "<form action='rettidinsert.php?ret=yes' method='POST'>";
    $result = mysqli_query($conn,$sql);

    while ($row = mysqli_fetch_assoc($result)) {
        $line .= "<input name='time".$count."' type='text' value='".substr($row['Tid'], 0,8)."'></input>";
        $line .= "<input name='delete' onclick='this.form.action=\"rettidinsert.php?delete=".$count."\"' type='submit' value='Slet'></input>";
        $line .= "<br>";
        $line .= "<input name='oldtime".$count."' type='hidden' value='".$row['Tid']."'></input>";
        $count++;
    }
    // MOM's SPAGHETTI
    $line .= "<input id='ud' type='submit' value='Opdatere'></input>";
    $line .= "<input name='count' type='hidden' value='".$count."'></input>";
    $line .= "<input name='studentId' type='hidden' value='".$_POST['studentId']."'></input>";
    $line .= "<input name='date' type='hidden' value='".$_POST['date']."'></input>";
    $line .= "<input name='id' type='hidden' value='".$_POST['id']."'></input>";
    $line .= "</form>";
    // PALMS ARE SWEATY
    $line .= "<form action='rettidinsert.php?new=yes' method='POST'>";
    $line .= "<input name='opret' type='submit' value = 'Opret ny'></input>";
    $line .= "<input name='studentId' type='hidden' value='".$_POST['studentId']."'></input>";
    $line .= "<input name='date' type='hidden' value='".$_POST['date']."'></input>";
    $line .= "<input name='id' type='hidden' value='".$_POST['id']."'></input>";
    $line .= "</form>";
    echo $line;
?>

<script>
function deleteFunction($whatToDelete) {

<?php 
    if ($whatToDelete == 0) { ?>

    document.getElementById("deleteForm0").submit();

<?php } ?>


}

</div>

</script>

      </div>
      </div> <!-- Close wrapper & content -->
        
  <footer>
        <p>Mercantec Copyright © 2017</p>
  </footer>
</body>
</html>


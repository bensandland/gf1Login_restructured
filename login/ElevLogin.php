<?php 
// Inkluder config filen

require_once '.konfigurations-filer/conn.php';// Definere variablerne
$username = $password = "";
$username_err = $password_err = "";
 
// Poster data fra form, når for er submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Tjekker om username er tom
    if(empty(trim($_POST["username"]))){
        $username_err = 'Indtast vevligst brugernavn.';
    } else{
        $username = trim($_POST['username']);
    }
    
    // Tjekker om password er tom
    if(empty(trim($_POST['password']))){
        $password_err = 'Indtast venligst adgangskode.';
    } else{
        $password = trim($_POST['password']);
    }
    
    // Validere indtastet
    if(empty($username_err) && empty($password_err)){
        
        $sql = "SELECT username, password FROM elever WHERE username=?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Binder variablerne til prepare statment som parameter
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Sætte parameters
            $param_username = $username;
            
            // Forsøg på at execute prepar statmentet
            if(mysqli_stmt_execute($stmt)){
                // Gemmer resultat
                mysqli_stmt_store_result($stmt);
                
                // Tjekker om brugernavn eksistere, hvis ja, validere password
                if(mysqli_stmt_num_rows($stmt) == 1){                    
                    // Bindeer result variablerne
                    mysqli_stmt_bind_result($stmt, $username, $hashed_password);
                    if(mysqli_stmt_fetch($stmt)){
                        if(password_verify($password, $hashed_password)){
                            /* Adgangskode er korrekt, der startes en sesion hvor brugernavn gemmes */
                            session_start();
                            $_SESSION['username'] = $username;      
                            header("location: /ElevSide.php");
                        } else{
                            // Viser en fejlmeddelse hvis adgangskode ikker er valideret
                            $password_err = 'Adgangskoden du indtastede var ikke korrekt';
                        }
                    }
                } else{
                    // Viser en fejlmeddelse hvis brugernavn ikke findes
                    $username_err = 'Ingen bruger fundet med det brugernavn';
                }
            } else{
                echo "Oops! Noget gik galt. Prøv igen senere.";
            }
        }
        
        //Lukker statmentet
        mysqli_stmt_close($stmt);
    }
    
    // Lukker forbindelse til database
    mysqli_close($link);
}
?>
 
<!DOCTYPE html>
<html lang="da">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" 
    href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif; }
        .wrapper{ width: 350px; padding: 20px; }
    </style>
</head>
<body>
    <div class="wrapper">
        <h2>Elev Login</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                <label>Brugernavn:<sup>*</sup></label>
                <input type="text" name="username"class="form-control" value="<?php echo $username; ?>">
                <span class="help-block"><?php echo $username_err; ?></span>
            </div>    
            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <label>Adgangskode:<sup>*</sup></label>
                <input type="password" name="password" class="form-control">
                <span class="help-block"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
            </div>
        </form>
    </div>    
</body>
<style>
    .btn-primary {
    color: #fff;
    background-color: #e8491d;
    border-color: #e8491d;
}</style>
</html>
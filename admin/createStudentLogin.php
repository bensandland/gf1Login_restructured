<?php
// Initialize the session
session_start();
 
// If session variable is not set it will redirect to login page
if(!isset($_SESSION['username']) || empty($_SESSION['username'])){
  header("location: index.php");
  exit;
}
?>
<?php

// Include config file
require_once 'conn.php';
 
// Definere variabler

$id = $username = $password = $confirm_password = "";
$id_err = $username_err = $password_err = $confirm_password_err = "";
 
// Produsere data når formen er submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
     // Tjekker id
     if(empty(trim($_POST["id"]))){
        $id_err = "Indtast venligst et Id";
    } else{
        // Gør select statment klar til senere brug
        $sql2 = "SELECT username FROM elevLogin WHERE id = ?";
        
        if($stmt = mysqli_prepare($link, $sql2)){
            //Binder variablerne til preapar statmentet
            mysqli_stmt_bind_param($stmt, "s", $param_id);
            
            // Sætter parametere
            $param_id = trim($_POST["id"]);
            
            // Forsøg på at excetuet prepar statmentet
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $id_err = "Der er allerede oprettet et login til dette Id";
                } else{
                    $id = trim($_POST["id"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    }

    // Tjekker brugernavn
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter a username.";
    } else{
        // Gør select statment klar til senere brug
        $sql = "SELECT id FROM elevLogin WHERE username = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            //Binder variablerne til preapar statmentet
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Sætter parametere
            $param_username = trim($_POST["username"]);
            
            // Forsøg på at excetuet prepar statmentet
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $username_err = "This username is already taken.";
                } else{
                    $username = trim($_POST["username"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    }
   
    
    // Validate password
    if(empty(trim($_POST['password']))){
        $password_err = "Please enter a password.";     
    } elseif(strlen(trim($_POST['password'])) < 6){
        $password_err = "Password must have atleast 6 characters.";
    } else{
        $password = trim($_POST['password']);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = 'Please confirm password.';     
    } else{
        $confirm_password = trim($_POST['confirm_password']);
        if($password != $confirm_password){
            $confirm_password_err = 'Password did not match.';
        }
    }
    
    // Tjekker indtatstet værdier, før der indsættes i database
    if(empty($username_err) && empty($id_err)&& empty($password_err) && empty($confirm_password_err)){
        
        // Insert statment gøres klar
        $sql = "INSERT INTO elevLogin (id, username, password) VALUES (?, ?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Binder variablerne til insert statmentet
            mysqli_stmt_bind_param($stmt, "sss", $param_id, $param_username, $param_password);
            
            // Set parameters
            $param_id = $id;

            $param_username = $username;
            
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            
            // Attempt to execute the prepared statement
            if( mysqli_stmt_execute($stmt)){
                // Redirect to login page
                header("location: login.php");
            } else{
                echo "Something went wrong. Please try again later.";
                echo mysqli_error($conn);
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Close connection
    mysqli_close($link);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign Up</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif; }
        .wrapper{ width: 350px; padding: 20px; position: center; margin: auto; box-sizing: border-box;}
        .btn-primary .badge{ color: #e8491d;}
    </style>
</head>
<body>
    <div class="wrapper">
        <h2>Opret login til elev</h2>
        <p></p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group <?php echo (!empty($id_err)) ? 'has-error' : ''; ?>">
                <lable>Id for eleven - Se evt. oversigten:<sup>*</sup></lable>
                <input type="text" name="id" class="form-control" value="<?php echo $id; ?>">
                <span class="help-block"><?php echo $id_err; ?></span>
            <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                <label>Brugernavn:<sup>*</sup></label>
                <input type="text" name="username"class="form-control" value="<?php echo $username; ?>">
                <span class="help-block"><?php echo $username_err; ?></span>
            </div>    
            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <label>Adgangskode:<sup>*</sup></label>
                <input type="password" name="password" class="form-control" value="<?php echo $password; ?>">
                <span class="help-block"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                <label>Bekræft Adgangskode:<sup>*</sup></label>
                <input type="password" name="confirm_password" class="form-control" value="<?php echo $confirm_password; ?>">
                <span class="help-block"><?php echo $confirm_password_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
                <input type="reset" class="btn btn-default" value="Reset">
            </div>
        </form>
    </div>    
</body>
</html>

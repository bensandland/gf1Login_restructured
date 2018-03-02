<?php 
// Include connection files
require_once "cfg/dbConn.php";

// Definere variablerne
$username = $password = "";
$username_err = $password_err = "";
 
// POST data from form when submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Check if username is empty
    if(empty(trim($_POST["username"]))){
        $username_err = 'Indtast vevligst brugernavn.';
    } else{
        $username = trim($_POST['username']);
    }
    
    // Check if password is empty
    if(empty(trim($_POST['password']))){
        $password_err = 'Indtast venligst adgangskode.';
    } else{
        $password = trim($_POST['password']);
    }
    
    // Validate input
    if(empty($username_err) && empty($password_err)){
        
        $sql = "SELECT username, password FROM adminLogin WHERE username =?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Binds variables as parameters for 'prepare' statement
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = $username;
            
            // Try to execute 'prepare' statement
            if(mysqli_stmt_execute($stmt)){
                // Store result
                mysqli_stmt_store_result($stmt);
                
                // Check if user exists, if yes - validate pass
                if(mysqli_stmt_num_rows($stmt) == 1){                    
                    // Bind 'result' variables
                    mysqli_stmt_bind_result($stmt, $username, $hashed_password);
                    if(mysqli_stmt_fetch($stmt)){
                        if(password_verify($password, $hashed_password)){
                            /* Password is correct, a new session is started */
                            session_start();
                            $_SESSION['username'] = $username;      
                            header("location: /overview.php");
                        } else {
                            // Shows error message if password is incorrect
                            $password_err = 'Adgangskoden du indtastede var ikke korrekt';
                        }
                    }
                } else {
                    // Error message for incorrect username
                    $username_err = 'Ingen bruger fundet med det brugernavn';
                }
            } 
            else {
                // Error message if something else goes wrong
                echo "Oops! Noget gik galt. Prøv igen senere.";
            }
        }
        
        //Close sql statement
        mysqli_stmt_close($stmt);
    }
    
    // Close db connection
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
        <!-- Styling -->
        body{ font: 14px sans-serif; }
        .wrapper{ width: 350px; padding: 20px; }
        
        .btn-primary {
            color: #fff;
            background-color: #e8491d;
            border-color: #e8491d;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <h2>Lærer Login</h2>
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
                <input type="submit" class="btn btn-primary" value="Login">
            </div>
        </form>
    </div>    
</body>
</html>
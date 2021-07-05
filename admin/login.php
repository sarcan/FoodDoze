<?php
// Session Start
session_start();
// print_r($_SESSION);
session_regenerate_id();

// Requires
require_once("includes/config.php");
require_once("includes/sessioncheck.php");
require_once("includes/functions.php");

// Errors
$hasError = false;
$messages = array();

// check if submit-button is clicked
if(isset($_POST["submit"])) {
    // if yes, desinfect user inputs
    $username = desinfect($_POST["username"]); 
    $password = desinfect($_POST["passwort"]);

    $varusername = $username;
    $varpassword = $password;

    // check if username or password field is empty
    if(empty($username) || empty($password)) {
        $hasError = true;
        $messages[] = "Bitte fülle alle Felder aus.";
    }
    
    if(!$hasError) {
        // search username in the database
        $queryLogin = "SELECT * FROM admins WHERE admin_email = ?";
        
        $stmt = mysqli_prepare($connection, $queryLogin);
        mysqli_stmt_bind_param($stmt, "s", $username); // 's' = 1 string: username
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $numRows = mysqli_num_rows($result); // count number of matches
        // print_r($numRows);

        if($numRows == 1) {
            $userdata = mysqli_fetch_assoc($result);
            // echo '<pre> User Data: ';
            // print_r($userdata);
            // print_r($password);
            // echo '</pre>';
            if(password_verify($password, $userdata["admin_password"])) {
                // echo "Passwort verifiziert";    
                        
                $_SESSION["isLoggedin"] = true; // login state
                $_SESSION["timestamp"] = time(); // for session limit time
                $_SESSION["userip"] = $_SERVER["REMOTE_ADDR"]; // user ip
                $_SESSION["useragent"] = $_SERVER['HTTP_USER_AGENT']; // user agent of the visitor's browser
                $_SESSION["adminemail"] = $username;
                $adminright = $userdata["admin_right"];
                $_SESSION["adminright"] = $adminright;
                // echo '<pre>';
                // print_r($_SESSION); 
                // echo '</pre>';
                
                // redirect to CMS Dashboard
                header("Location: index.php"); 
            } else {
                $hasError = true; // wrong password
                $messages[] = "Username oder Passwort ist leider inkorrekt.";
            }
        } else {
            $hasError = true; // wrong username
            $messages[] = "Username oder Passwort ist leider inkorrekt.";
        }     
    }        
} else {
	$varusername = "";
    $varpassword = "";
}

$sessionCheck = sessionCheck();

if(!$sessionCheck) {
    session_unset(); // clean up session data
	session_regenerate_id(); // replace current session id with a newly generated one
} else if ($sessionCheck) {
    $_SESSION['timestamp'] = time(); // refresh session time
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FoodDoze</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://use.typekit.net/ljh1ggm.css">
    <script src="https://kit.fontawesome.com/dc5d036448.js" crossorigin="anonymous"></script>
</head>
<body>
    <div class="admin-nav-logo">
            <img src="../img/logo/logo-1920.png" alt="Logo" >
    </div>

    <section class="formular login">

        <?php if( count($messages)>0 ){ ?> 
            <div class="error">
                <?php echo implode('<br>', $messages); ?>
            </div>
        <?php } ?>

        <form method="POST">

            <label for="fld_username"></label>
            <input type="text" name="username" id="username" value="<?=$varusername?>" placeholder="Username">

            <label for="fld_pw"></label>
            <input type="password" name="passwort" id="passwort" value="<?=$varpassword?>"  placeholder="Passwort">

            <button id="send" type="submit" name="submit">Abschicken</button>
        </form>

    </section>

<?php
// Footer
include('includes/html/footer.php'); 
?>
<?php
session_start();
/*Makes sure if items were submitted */
if(!empty($_POST['email']))
    $_SESSION['email'] = $_POST['email'];
if(!empty($_SESSION['password']))
    $_SESSION['password'] = md5(stripslashes($_POST['password']));

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" 
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Verify</title>

<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
</head>
    <body>
        <h2>Verify Memeber Login</h2>
        <?php
        /*Connects to the mysql db */
        $errors = 0;
        $DBConnect = @mysql_connect('localhost', 'DEV3708a',
'pass', 'GonePhishin');
        if ($DBConnect === FALSE){
            echo "<p>Unable to connect to the database server. Error code " . mysql_errno() . ": " . mysql_error() . "</p>\n";
            ++$errors;
        }/*Successful sign in gets list and table name */
        else{
            $DBName = "logins";
            $result = @mysql_select_db($DBName, $DBConnect);
        }
        $tableName = "logins";
        if ($errors == 0){
            $SQLstring = "SELECT login FROM $tableName where email='". stripcslashes($_POST['email']) . "'and password_md5='". md5(stripcslashes($_POST[ 'password'])). "'";
            $QueryResult = @mysql_query($SQLstring, $DBConnect);
            if(mysql_num_rows($QueryResult) == 0 ){
                echo "<p>The email/password combination entered is not valid.</p>\n";
                ++$errors;
            }
            else{/*Registers session information */
                $row = mysql_fetch_assoc($QueryResult);
                $_SESSION['login'] = $row['memberID'];
                $user = $row['login'];
                echo "<p>Welcome back, $user!</p>\n";
            }
        }
        
        if($errors > 0){/*Error */
            echo "<p>Please use your browsser's BACK button to return to the form and fix the errors indicated.</p>\n";
        }
        
        if ($errors == 0){/*Link back to main page */
            echo "<p><a href='index.php'>Return to main page</a></p>\n";
        }
        ?>
    </body>
</html>

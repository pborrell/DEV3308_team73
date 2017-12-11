<?php
session_start();
        
        ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" 
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Register</title>

<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
</head>
    <body>
        <h2>Memeber Registration</h2>
        <?php
        /*Validation for information entered into the registration form, first and last name are not validated */
        $errors = 0;
        $email = "";
        
         if(empty($_POST['login'])){
            echo "<p>You need to enter a user name.</p>";
             ++$errors;
             if (strlen($_SESSION['login']) < 5)
            echo "<p>User name must be atleast six characters long.</p>";
             ++$errors;
        }
        else{
            $user = stripslashes($_POST['login']);
          
        }
        
        if(empty($_POST['login'])){
            ++$errors;
            echo "<p>You need to enter an e-mail address.\n";
        }            
        
        if (empty ($_POST['password'])){
            ++$errors;
            echo "<p>You need to enter a password.</p>\n";
            $password = "";
        }
        else
            $password = stripslashes($_POST['password']);
        if(empty ($_POST['password2'])){
            ++$errors;
            echo "<p>You need to enter a confirmation password.</p>\n";
        }
        else
            $password2 = stripslashes($_POST['password2']);
        if((!(empty ($password))) && (!(empty ($password2)))){
            if (strlen($password) < 6){
                ++$errors;
                echo "<P>The password is too short.</p>\n";
                $password = "";
                $password2 = "";
            }
            if ($password <> $password2){
                ++$errors;
                echo "<p>The passwords do not match.</p>\n";
                $password = "";
                $password2 = "";
            }
        }
            
        
        if ($errors == 0){
          $DBConnect = @mysql_connect('localhost', 'DEV3708a',
'pass', 'GonePhishin');
            if ($DBConnect === FALSE){
                echo "<p>Unable to connect to the database servver. Error code " . mysql_errno() . ", " . myssql_error() . "</p>\n";
                ++$errors;
            }
        else{
            $DBName = "login";
             $result = @mysql_select_db($DBName, $DBConnect);
                if ($result === FALSE){
                    echo "<p>Unable to select the database. Error code" . mysql_errno($DBConnect) . ": " . mysql_error($DBConnect) . "</p>\n";
                    ++$errors;
                }
            }
        }
        /*Access table or makes it if the table does not exist */
        $tableName = "logins";
        
         if ($errors == 0){
            $SQLstring = "SELECT count(*) FROM $tableName where login=$login";
            $QueryResult = @mysql_query($SQLstring, $DBConnect);
            if ($QueryResult === FALSE){
                $SQLstring = "CREATE TABLE $tableName (memberID SMALLINT NOT NULL AUTO_INCREMENT PRIMARY KEY, email VARCHAR(50), password_md5 VARCHAR(32), "0;
                $QueryResult = @mysql_query($SQLstring, $DBConnect);
            }/*Checks to see if the email already exists */
            if ($QueryResult !== FALSE){
                $row = mysql_fetch_row($QueryResult);
                if ($row[0] > 0){
                    echo "<p>The email address entered (" . htmlentities($email) . )" is already registered.</p>\n";
                    $errors++;
                }
            }
        }
        
        if ($errors > 0){
            echo "<p>Please use your browser's BACK button to return to the form and fix the errors indicated.</p>\n";
        }
        
        /*writes infomration to data base*/
        if ($errors == 0){
           mysql_select_db($DBConnect, $DBName);
            $SQLstring = "INSERT INTO $tableName (login, password_md5, computer) VALUES ('$login', " . " '" . md5($password) . "')";
            $QueryResult = @mysql_query($SQLstring, $DBConnect);
            if ($QueryResult === FALSE){
                echo "<p>Unable to save your registration information. Error code" . mysql_errno($DBConnect) . ": " . mysql_error($DBConnect) . "</p>\n";
                ++$errors;
            }
            
            else{
                $_SESSION['memberID'] = mysql_insert_id($DBConnect);
            }
            mysql_close($DBConnect);
        }
        /*Gives esoteric member number that does not serve a function yet */
        if ($errors == 0){
            echo "<p> Thank you, $user. ";
            echo "Your new member ID is <strong>" . $_SESSION['memberID'] . "</strong></p>\n";
            echo "<p><a href='index.php'>Click to return to main page.</a></p>\n";
        }
        ?>
    </body>
</html>

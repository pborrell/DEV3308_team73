<?php
session_start();
if(isset($_SESSION['login']))
    $email = $_SESSION['login'];
if(isset ($_SESSION['password']))
    $password = $_SESSION['password'];
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" 
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Log-in</title>
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
</head>
    <body>
        <h2>Login/registration</h2>
        <p>New members, please complete the top form to register as a  user. Returning users, please complete the second form to log in.</p>
        <hr/>
        
        <h3>New Memmber Registration</h3>
        <form method="POST" action="register.php">
            
            <p>Enter your e-mail address:
            <input type="text" name="email" value="<?=$email ?>"/></p>
            <p>Enter a password for your account:
                <input type="text" name="password" value="<?=$password ?>"/></p>
            <p>Confirm your password:
            <input tpye="text" name="password2"/></p>
            <p><em>(Passwords are case-sensitive and must be atleast 6 characters long)</em></p>
            <input type="reset" name="reset" value="Reset Registration Form"/>
            <input type="submit" name="register" value="Register"/>
        </form>
    <hr/>
    
    <h3>Returning Memmber Login</h3>
    <form method="post" action="VerifyLogin.php">
        <p>Enter your Email Address:
            <input type="email" name="email" value="<?=$email ?>" /></p>
        <p>Enter your password:
        <input type="password" name="password" value="<?=$password ?>" /></p>
        <p><em>(Passwords are case-sensitive and must be at least 6 characters long)</em></p>
        <input type ="reset" name="reset" value="Reset Login Form"/>
        <input type="submit" name="login" value="Log in"/>
    </form>
    </body>
</html>

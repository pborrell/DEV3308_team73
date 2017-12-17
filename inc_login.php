<?php
session_start();
/* turns member into a variable*/
 $user = $_SESSION['login'];
        ?>

<!DOCTYPE html>    =
    
    <head>
<title></title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    </head>
  
    <body>  
 <div style='width: 20%; text-align: center; float: right;'>       
        <?php
        /*Tests to see if someone is logged in */
        if (strlen($user) < 5){
            /*If not signed in gives option to sign in or register within the frame */
         echo   "<form action='index.php' method='get'>
            <input type='submit' name='content' value='Log in or register'/><br />";
        }
        else{
            /*Tells user they are logged in and gives them an option to sign out */
            echo "Logged in as $user<br/>";
            echo "<a href='logout.php'>Log out?</a>";
       }
       ?>
      </div>
    </body>
</html>

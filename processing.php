<?php
$host = "127.0.0.1";
$usr = "root";
$pass = "pass";
$db = "GonePhishin";

$email = $_REQUEST['email'];
$donations = $_REQUEST['donations'];
$first_name = $_REQUEST['first_name'];
$last_name = $_REQUEST['last_name'];
$card = $_REQUEST['card'];
$emailCheck = FALSE;
$firstNameCheck = FALSE;
$lastNameCheck = FALSE;
$ITdeptEmail = "info@techguruhelpdesk.com";
$itMode = FALSE;



function validatecard($number)
 {
    global $type;

    $cardtype = array(
        "visa"       => "/^4[0-9]{12}(?:[0-9]{3})?$/",
        "mastercard" => "/^5[1-5][0-9]{14}$/",
        "amex"       => "/^3[47][0-9]{13}$/",
        "discover"   => "/^6(?:011|5[0-9]{2})[0-9]{12}$/",
    );

    if (preg_match($cardtype['visa'],$number))
    {
  $type= "visa";
        return TRUE;
  
    }
    else if (preg_match($cardtype['mastercard'],$number))
    {
  $type= "mastercard";
        return TRUE;
    }
    else if (preg_match($cardtype['amex'],$number))
    {
  $type= "amex";
        return TRUE;
  
    }
    else if (preg_match($cardtype['discover'],$number))
    {
  $type= "discover";
        return TRUE;
    }
    else
    {
        return false;
    } 
 }


$createCredit = "CREATE TABLE IF NOT EXISTS 'credit' (
  'key' INT(10) NOT NULL AUTO_INCREMENT,
  'card_present' tinyint(1) DEFAULT NULL,
    PRIMARY KEY ('key')
) ENGINE=MyISAM DEFAULT CHARSET=utf8";

$createDonations = "CREATE TABLE IF NOT EXISTS 'donations' (
  'key' INT(10) NOT NULL AUTO_INCREMENT,
  'donations' varchar(12) DEFAULT NULL,
    PRIMARY KEY ('key')
) ENGINE=MyISAM DEFAULT CHARSET=utf8";

$createEmails = "CREATE TABLE IF NOT EXISTS 'emails' (
  'key' INT(10) NOT NULL AUTO_INCREMENT,
   'email' varchar(120) NOT NULL,
  'trap' varchar(5) NOT NULL,
     PRIMARY KEY ('key')
) ENGINE=MyISAM DEFAULT CHARSET=utf8";

$createHeader = "CREATE TABLE IF NOT EXISTS 'header' (
  'id' int(10) NOT NULL,
  'css' varchar(5000) NOT NULL,
   PRIMARY KEY('id')
) ENGINE=MyISAM DEFAULT CHARSET=utf8";

$createName = "CREATE TABLE IF NOT EXISTS 'name' (
  'key' INT(10) NOT NULL AUTO_INCREMENT,
  'first' varchar(20) DEFAULT NULL,
  'last' varchar(45) DEFAULT NULL,
     PRIMARY KEY ('key')
) ENGINE=MyISAM DEFAULT CHARSET=utf8";

if (preg_match("/^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{3,}$/", $email) == TRUE){
  $emailCheck = TRUE;
}
if(preg_match(("/0-9]{16}/"), $card) == TRUE){
  $cardCheck = TRUE;
}
if(preg_match("/^[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]+$/u", $last_name) == TRUE){
  $lastNameCheck = TRUE;
}
if(preg_match("/^[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]+$/u", $first_name) == TRUE){
  $firstNameCheck = TRUE;
}


if(validatecard($card) == TRUE){
  $card = 1;
}
else{
  $card = 0;
}
$personalEmailMessage = wordwrap("$first_name,\n We regret to inform you that you have fallen for a phishing scam.\nA good way to watch out for them is to look to see if the site is secure before putting credit card information in a field. Chrome 60+ and Firefox gives a warning that the site is not secure. \nPlease be advised that the credit card you have entered is represented as $card and is not stored anywhere.\nThe only information we collected was your email, your name and if you donated.\nPlease attempt to do better in the future!\n Please read this website for more information on how to avoid attacks like this in the future:\n\n https://www.us-cert.gov/ncas/tips/ST04-014", 70);

$ITEmailMessage = wordwrap("Please be advised that $first_name $last_name, with the email, $email has fallen for a phishing attack. You should give them more training.",70);

if($emailCheck == TRUE && $lastNameCheck == TRUE && $firstNameCheck == TRUE){
  $conn = new mysqli("127.0.0.1", "root", "pass", "GonePhishin");



  if ($conn->connect_errno)
  {
    die('Connection failed: ' . $conn->connect_error);
  }
  else 
  {
    $conn->query($createCredit);
    $conn->query($createDonations);
    $conn->query($createEmails);
    $conn->query($createHeader);
    $conn->query($createName);
    $querySelect = "SELECT * FROM emails;";
    $queryEmail = "INSERT INTO emails (email) VALUES ('$email')";
    $queryDonate = 
    "INSERT INTO donations (donations) VALUES ('$donations')";
    $queryName =
    "INSERT INTO name (last, first) VALUES ('$last_name', '$first_name')";
    $queryCard =
    "INSERT INTO credit (card_present) VALUES ('$card')";
    
    $resultEmail = $conn->query($queryEmail);
    $resultSelect = $conn->query($querySelect);
    $resultDonate = $conn->query($queryDonate);
    $resultName = $conn->query($queryName);
    $resultCard = $conn->query($queryCard);
 
      #var_dump($conn);
      if ($resultEmail == TRUE)
      { 
        if($itMode){
          $email = $ITdeptEmail;
          $msg = $ITEmailMessage;
        }
        else{
          $msg = $personalEmailMessage;
        }
        mail($email, "You have made a grave mistake haven't you", $msg);
        include 'thankyou.php';
        exit();

      } 
      else 
      {

        echo "<p> There was an error when creating the article test</p>";
        die(mysqli_error($conn));
      }
      mysqli_close($conn);
  }			
}

else{
 $errors = "";
 if($email == FALSE){
  $errors = $errors . "email, ";
 }
 if($firstNameCheck == FALSE){
  $errors = $error . "First Name, ";
 }
 if($lastNameCheck == FALSE){
  $errors = $errors . "Last Name, ";
 }
 print "An error occured, make sure your $errors is valid.";
include 'index.php';
}
?>

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
if(!empty($card)){
  $card = 1;
}
else{
  $card = 0;
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

if (preg_match("/^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{3,}$/", $email) == TRUE)
{
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
print "An error occured, make sure your email is valid.";
include 'index.php';
}
?>

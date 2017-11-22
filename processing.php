<?php
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
if (preg_match("/^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,}$/", $email) == TRUE){
$connect = @mysqli_connect ('localhost', 'DEV3708a',
'pass', 'GonePhishin');
	$sql = "CREATE TABLE IF NOT EXISTS 'credit' (
  'key' INT(10) NOT NULL AUTO_INCREMENT,
  'email' varchar(120) NOT NULL,
  'card_present' tinyint(1) DEFAULT NULL,
    PRIMARY KEY ('key')
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS 'donations' (
  'key' INT(10) NOT NULL AUTO_INCREMENT,
  'donations' varchar(12) DEFAULT NULL,
    PRIMARY KEY ('key')
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS 'email' (
  'key' INT(10) NOT NULL AUTO_INCREMENT,
   'email' varchar(120) NOT NULL,
  'trap' varchar(5) NOT NULL,
     PRIMARY KEY ('key')
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS 'header' (
  'id' int(10) NOT NULL,
  'css' varchar(5000) NOT NULL,
   PRIMARY KEY('id')
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS 'name' (
  'key' INT(10) NOT NULL AUTO_INCREMENT,
  'first' varchar(20) DEFAULT NULL,
  'last' varchar(45) DEFAULT NULL,
     PRIMARY KEY ('key')
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
	";
	if ($connect->query($sql) == TRUE){
		$sql = "INSERT INTO 'email' ('key', 'email', 'trap') VALUES (null, '$email', '$id'); 
		INSERT INTO 'donations'('key', 'donations') VALUES (null, '$donations');
		INSERT INTO 'name'('key', 'last', 'first') VALUES (null, '$last_name', '$first_name');
		INSERT INTO 'credit' (key, 'card_present') VALUES (null, '$card');
		";
	}
		if ($connect->query($sql) == TRUE){
			include 'thankyou.php';
		}
}
print "An error occured, make sure your email is valid.";
include 'index.php';
?>
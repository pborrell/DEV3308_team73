<?php
$email = $_REQUEST['email'];
$donations = $_REQUEST['donations'];
$first_name = $_REQUEST['first_name'];
$last_name = $_REQUEST['last_name'];
$card = $_REQUEST['card'];

if (preg_match("/^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,}$/", $email) === TRUE){
$connect = @mysqli_connect ('localhost', 'DEV3708a',
'pass', 'GonePhishin');
	$sql = "CREATE TABLE IF NOT EXIST 'header' (
		'id' int(10) NOT NULL,
		'css' varchar(5000) NOT NULL
		PRIMARY KEY('id')
	)ENGINE = MyISAM DEFAULT CHARSET=utf8;

		CREATE TABLE IF NOT EXIST 'email' (
		'email' varchar(120) NOT NULL,
		'trap' varchar(5) NOT NULL
		PRIMARY KEY('email')
	)ENGINE = MyISAM DEFAULT CHARSET=utf8;

	CREATE TABLE IF NOT EXIST 'donations' (
		'email' varchar(120) NOT NULL,
		'donations' varchar(12)
		PRIMARY KEY('email')
	)ENGINE = MyISAM DEFAULT CHARSET=utf8;

	CREATE TABLE IF NOT EXIST 'name' (
		'email' varchar(120) NOT NULL,
		'first' varchar(20),
		'last' varchar(45)
		PRIMARY KEY('email')
	)ENGINE = MyISAM DEFAULT CHARSET=utf8;

	CREATE TABLE IF NOT EXIST 'credit'(
		'email' varchar(120) NOT NULL),
		'card_present' tinyint(1)
		PRIMARY KEY ('email')
		)ENGINE = MyISAM DEFAULT CHARSET=utf8;
	";
	if ($connect->query($sql) === TRUE){
		$sql = "INSERT INTO 'email' ('email', 'trap') VALUES ('$email', '$id'); 
		INSERT INTO 'donations'('email', 'donations') VALUES ('$email', '$donations');
		INSERT INTO 'name'('email', 'last', 'first') VALUES ('$email', '$last_name', '$first_name');
		INSERT INTO 'credit' ('email', 'card_present') VALUES ('$email', '$card');
		";
	}
		if ($connect->query($sql) === TRUE){
			include 'thankyou.php';
		}
}
print "An error occured, make sure your email is valid.";
include 'index.php';
?>

<?php 
	$host = "127.0.0.1";
	$usr = "root";
	$pass = "pass";
	$db = "GonePhishin";
	$conn = @mysqli_connect($host, $usr, $pass, $db);

	if ($conn->connect_errno)
  	{
    	die('Connection failed: ' . $conn->connect_error);
  	}
  	else{ 
  			?>
  			<form enctype="multipart/form-data" action="http://localhost/audits.php">
  			<!DOCTYPE html>
			<html lang="en">
			<p>Select what you want to see from database</p><br/>
			<select name="display">
			<option value=""> Select</option>
			<option value="email">  Email</option>
			<option value="cards"> Credit Cards</option>
			<option value="donations"> Donation Values</option>
			<option value="name"> Names</option>
			<option value="all"> All</option>
			</select>
			<br/>
			<br/>
			<input type="submit" value="Show" />
			</form>
			</html>
		<?php
		$display = $_REQUEST['display'];
		switch ($display) {
			case 'email':
				$query = "SELECT * FROM emails;";
				print "<pre>key  email                                     page</pre>";
				break;
			case 'cards':
				$query = "SELECT * FROM credit;";
				print "key card_present<br/>";
				break;
			case 'donations':
				$query = "SELECT * FROM donations;";
				print "key donations<br/>";
				break;
			case 'name':
				$query = "SELECT * FROM name;";
				print "<pre>key   first name          last name</pre>";
				break;
			case 'all':
				$query = "select credit.key, credit.card_present, donations.donations, emails.email, emails.trap, name.first, name.last from credit, donations, emails, name where donations.key = credit.key AND donations.key = emails.key AND donations.key = name.key";
				print "<pre>key   card_present   donations email                    page       first      last<br/></pre>";
				break;
		} 
		$results = mysqli_query($conn, $query);
		while ($row = mysqli_fetch_array($results, MYSQLI_NUM)) { 
			echo "<pre>".$row[0]."     ".$row[1]."                ".$row[2]."    ".$row[3]."   ".$row[4]."   ".$row[5] ."       "."$row[6]"."<br></pre>";
		}
	}
	$conn->close();
?>
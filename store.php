<header><script
src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js">
</script> </header>
<body>
<script>
$(document).ready(function(){
  $('.button').click(function(){
    var clickBtnName = $(this).attr('name');
    var ajaxurl = 'SQLDeleteHandler.php';
    var data = {'id': clickBtnName};
    $.post(ajaxurl, data, function(response) {
      window.location.href="store.php";
    });
  });
});
</script>
<?php
echo "<h1> MY STORE APPLICATION</h1>";
// Obtain a connection object by connecting to the db
$connection = @mysqli_connect ('localhost', 'DEV3708a',
'pass', 'lab6');
// please fill these parameters with the actual data
if(mysqli_connect_errno())
{
echo "<h4>Failed to connect to MySQL:
</h4>".mysqli_connect_error();
}
else
{
echo "<h4>Successfully connected to MySQL: </h4>";
}


$query = "SELECT * FROM store;";

$results = mysqli_query($connection, $query);

while ($row = mysqli_fetch_array($results, MYSQLI_NUM)) {
echo "<input type=\"submit\" class=\"button\" name=\"".$row[0]."\"
value=\"delete\"/>"; 
echo $row[0]." ".$row[1]." ".$row[2]." ".$row[3]."<br>";

}

?> 
<h1>Insert a new row into the "store" table</h1>
<form enctype="multipart/form-data"
action="http://localhost/SQLInsertHandler.php">
<p>Id:&nbsp <input type="text" name="Id" size="10" maxlength="11" /></p>
<p>Name:&nbsp <input type="text" name="Name" size="10" maxlength="20" /></p>
<p>Quantity:&nbsp <input type="text" name="Quantity" size="10" maxlength="30"
/></p>
<p>Price:&nbsp <input type="text" name="Price" size="10" maxlength="10" /></p>
<br>
<input type="submit" value="Add item" /> &nbsp <input type="reset" />
</form>
</body>
<?php
$user = "root";
$pass = "pass1";
try
{
    $db = new PDO('mysql:host=localhost;dbname=test', "$user", "$pass");

	$statement = $db->query('CREATE TABLE IF NOT EXISTS dane (id smallint auto_increment primary key,imie varchar(15), data datetime)');
	$statement -> execute();
	$statement -> closeCursor();

}
catch (PDOException $e)
{
    print "Error: " . $e->getMessage() . "<br/>";
    die();
}

echo"<div style='width:500px;padding-bottom:20px;border-right:1px dotted #cdcdcd;float:left'>
Data retrieved from the table \"dane\"<br /><br />";
$statement = $db->query('SELECT * FROM dane');
$count = $statement -> rowCount();

if($count < 1) { echo "<span style='color:red'>No record to display</span>"; }

foreach($statement as $row)
{
    echo("added by: <b>".$row['imie']."</b>  <i>".$row['data']."</i> <a href='delete.php?id=".$row['id']."' style='font-size:12px'>delete this record</a><br />");
}
$statement->closeCursor();
echo"</div>
<div style='width:400px;height:200px;padding-left:40px;float:left'>
Add your record to the database<br /><br />
<b>Your name:</b><br />
<form action='add.php' method='POST' style='display:inline'>
<input type='text' name='imie'><br />
<input type='submit' name='add' value='Submit'>
</form>
</div>";
?>

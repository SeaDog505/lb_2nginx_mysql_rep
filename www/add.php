<?php
$user = "root";
$pass = "pass1";
try
{
    $db = new PDO('mysql:host=localhost;dbname=test', "$user", "$pass");
}
catch (PDOException $e)
{
    print "Error: " . $e->getMessage() . "<br/>";
    die();
}

if(empty($_POST['imie'])) { $imie = "NULL"; } else { $imie = $_POST['imie']; }
$statement = $db->prepare('INSERT INTO dane SET imie = :imie, data = :data');
$statement -> BindValue(':imie',$imie,PDO::PARAM_STR);
$statement -> BindValue(':data',date("Y-m-d H:i:s"),PDO::PARAM_STR);
$statement -> execute();
$statement -> closeCursor();
header("Location:".$_SERVER['HTTP_REFERER']);
?>

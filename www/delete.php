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

$statement = $db->prepare('DELETE FROM dane WHERE id = :id');
$statement -> BindValue(':id',$_GET['id'],PDO::PARAM_INT);
$statement -> execute();
$statement -> closeCursor();
header("Location:".$_SERVER['HTTP_REFERER']);
?>

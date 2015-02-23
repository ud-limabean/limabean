<?php
$user='bbagbv2pilot';
$pass='';
try {
    $dbh = new PDO('mysql:host=localhost;dbname=bbagbv2pilot', $user, $pass);
	$result = $dbh->query('SELECT * from measurements');
    /* foreach($dbh->query('SELECT * from measurements') as $row) {
        print_r($row);
    } */
	var_dump($result);
    $dbh = null;
} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}
?>
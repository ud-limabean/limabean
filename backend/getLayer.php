<?php
//phpinfo();
/* run the following query against sqlite in a function, parameterize date
SELECT Avg(a.value) AS VALUE,a.date_measured,a.parameter,b.STATE_ABBR,b.geometry
  FROM  measurement AS a, states AS b
  WHERE ST_Intersects(a.geometry,b.geometry)=1
  AND date(a.date_measured) < date(042009)
  AND date(a.date_measured) > date(092009)
  GROUP BY b.STATE_ABBR, a.parameter; */
  
try {
    $dbh = new PDO('sqlite:limabean.sqlite');
	$sth = $dbh->prepare('SELECT * FROM measurement LIMIT 25');
	$sth->execute();
	
	//here using fetch ... if need to use later fetch_all would be better 
	while ($result = $sth->fetch(PDO::FETCH_ASSOC)) {
    echo 'Parameter: ' . $result['parameter'] . '  Value: ' . $result['value'];
	}
    $dbh = null;
} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}

?>
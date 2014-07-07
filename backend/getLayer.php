<?php
//phpinfo();
//exit();
/* run the following query against sqlite in a function, parameterize date, boudning box from map interface, and parameter
SELECT Avg(a.value) AS VALUE,a.date_measured,a.parameter,b.STATE_ABBR,b.geometry
  FROM  measurement AS a, 
  (SELECT STATE_ABBR, geometry FROM states WHERE ST_Intersects(geometry, PolyFromText('POLYGON((-75.8 38.4, -75.0 38.4, -75.0 39.85, -75.8 39.85))',4236))) AS b
  WHERE ST_Intersects(a.geometry,b.geometry)=1
  AND a.parameter = 'WIND SPEED'
  AND date(a.date_measured) < date(042009)
  AND date(a.date_measured) > date(092009)
  GROUP BY b.STATE_ABBR; */
  
$strParam='WIND SPEED';
$wktBounding='POLYGON((-75.8 38.4, -75.0 38.4, -75.0 39.85, -75.8 39.85))';
$dateMin='042009';
$dateMax='092009';
  
try {
    /*$query = "'SELECT Avg(a.value) AS VALUE,a.date_measured,a.parameter,b.STATE_ABBR,b.geometry
					FROM  measurement AS a, 
					(SELECT STATE_ABBR, geometry FROM states WHERE ST_Intersects(geometry, PolyFromText('$wktBounding',4236))) AS b
					WHERE ST_Intersects(a.geometry,b.geometry)=1
					AND a.parameter = '$strParam'
					AND date(a.date_measured) < date($dateMin)
					AND date(a.date_measured) > date($dateMax)
					GROUP BY b.STATE_ABBR;'"*/
	
	function getLayer ($strParam,$wktBounding,$dateMin,$dateMax) {
		$db = new SQLite3('limabean.sqlite');
		
		//$db->query("SELECT load_extension('libspatialite.dll');
		$db->loadExtension('libspatialite.dll');
		
		/* $rs = $db->query('SELECT spatialite_version()');
		while($row = $rs->fetchArray()){
			print "<h3>SQLite version: $row[0]</h3>";
		} */
		
	
		$query = "SELECT Avg(a.value) AS VALUE,a.date_measured,a.parameter,b.STATE_ABBR,b.geometry
					FROM  measurement AS a, 
					(SELECT STATE_ABBR, geometry FROM states ) AS b
					WHERE ST_Intersects(a.geometry,b.geometry)=1
					AND a.parameter = '$strParam'
					AND date(a.date_measured) < date($dateMin)
					AND date(a.date_measured) > date($dateMax)
					GROUP BY b.STATE_ABBR;";
		echo $query;
		
//$sth->execute();
		
		//here using fetch ... if need to use later fetch_all would be better 
		echo 'hello world';
		$st = $db->query($query);
		if (! $st) {
			$error = $db->errorInfo();
			print "Problem ({$error[2]})";
		}
		/* foreach ($st->fetchAll() as $result) {
			echo 'Parameter: ' . $result['parameter'] . '  Value: ' . $result['value'];
		} */
	}
	
    $dbh = null;
} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}

getLayer($strParam,$wktBounding,$dateMin,$dateMax);
echo 'hello world';

?>
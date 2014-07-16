<?php
//phpinfo();
//exit();
 
/* NEED TO HAVE THESE PARAMETERS PASSED, ELSE FALL BACK TO DEFAULTS (THESE FOR NOW) */ 
$strParam='WIND SPEED';
$wktBounding='POLYGON((-75.8 38.4, -75.0 38.4, -75.0 39.85, -75.8 39.85, -75.8 38.4))';
$dateMin='042009';
$dateMax='092009';
										
$query="SELECT Avg(a.value) AS VALUE,a.date_measured,a.parameter,b.STATE_ABBR,b.geometry
                                        FROM  measurement AS a, 
                                        (SELECT STATE_ABBR, geometry FROM states)  AS b
                                        WHERE
					a.state_abbr=b.STATE_ABBR
					AND ST_Intersects(b.geometry, PolyFromText('$wktBounding',4326))=1
                                        AND a.parameter = '$strParam'
                                        AND date(a.date_measured) < date($dateMin)
                                        AND date(a.date_measured) > date($dateMax)
                                        GROUP BY b.STATE_ABBR;";
  
try {
	
	function getLayer ($strParam,$wktBounding,$dateMin,$dateMax,$query) {
		$db = new SQLite3('limabean.sqlite');
		//$db->busyTimeout(80000);
		//loading spatialite extension
		$db->loadExtension('libspatialite.so.2');
	
	
		$st = $db->query($query);
		if (! $st) {
			$error = $db->errorInfo();
			print "Problem ({$error[2]})";
		
		}
		
		while ($res = $st->fetchArray(SQLITE3_ASSOC)){
			foreach ($res as $key => $value) {
				echo $key . ' = ' . $value . ",\n";
			}
		}
	}
	
    $dbh = null;
} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}

getLayer($strParam,$wktBounding,$dateMin,$dateMax,$query);
//echo 'hello world';

?>

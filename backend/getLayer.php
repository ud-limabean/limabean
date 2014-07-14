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
$wktBounding='POLYGON((-75.8 38.4, -75.0 38.4, -75.0 39.85, -75.8 39.85, -75.8 38.4))';
$dateMin='042009';
$dateMax='092009';
$query1="CREATE TABLE IF NOT EXISTS states_bounding AS
SELECT * FROM states WHERE ST_Intersects(geometry, PolyFromText('$wktBounding',4236))=1";
$query="SELECT Avg(a.value) AS VALUE,a.date_measured,a.parameter,b.STATE_ABBR,b.geometry
                                        FROM  measurement AS a, 
                                        (SELECT STATE_ABBR, geometry FROM states_bounding)  AS b
                                        WHERE ST_Intersects(a.geometry,b.geometry)=1
                                        AND a.parameter = '$strParam'
                                        AND date(a.date_measured) < date($dateMin)
                                        AND date(a.date_measured) > date($dateMax)
                                        GROUP BY b.STATE_ABBR;";
  
try {
	
	function getLayer ($strParam,$wktBounding,$dateMin,$dateMax,$query,$query1) {
		$db = new SQLite3('limabean.sqlite');
		//$db->busyTimeout(80000);
		//loading spatialite extension
		$db->loadExtension('libspatialite.so.2');
	
	
	/*	$query = "SELECT Avg(a.value) AS VALUE,a.date_measured,a.parameter,b.STATE_ABBR,b.geometry
                                        FROM  measurement AS a, 
                                        (SELECT STATE_ABBR, geometry FROM states) AS b
                                        WHERE ST_Intersects(a.geometry,b.geometry)=1
                                        AND a.parameter = '$strParam'
                                        AND date(a.date_measured) < date($dateMin)
                                        AND date(a.date_measured) > date($dateMax)
                                        GROUP BY b.STATE_ABBR;";
	
		$query = "SELECT Avg(a.value) AS VALUE,a.date_measured,a.parameter,b.STATE_ABBR,b.geometry
					FROM  measurement AS a, 
					(SELECT STATE_ABBR, geometry FROM states WHERE ST_Intersects(geometry, PolyFromText('$wktBounding',4236))=1) AS b
					WHERE ST_Intersects(a.geometry,b.geometry)=1
					AND a.parameter = '$strParam'
					AND date(a.date_measured) < date($dateMin)
					AND date(a.date_measured) > date($dateMax)
					GROUP BY b.STATE_ABBR;"; */
		echo $query;

		$st = $db->query($query1);
                if (! $st) {
                        $error = $db->errorInfo();
                        print "Problem ({$error[2]})";

                }
		
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

getLayer($strParam,$wktBounding,$dateMin,$dateMax,$query,$query1);
//echo 'hello world';

?>

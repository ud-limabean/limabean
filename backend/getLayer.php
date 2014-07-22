<?php

/* NEED TO HAVE THESE PARAMETERS PASSED, ELSE FALL BACK TO DEFAULTS (THESE FOR NOW) */ 
$strParam='WIND SPEED';
$strBounding='-86.484375,35.209721645221386,-70.13671875,41.409775832009565';
$dateMin='042009';
$dateMax='092009';

if (isset($_REQUEST['param'])){$strParam=$_REQUEST['param'];}
if (isset($_REQUEST['bounding'])){$strBounding=$_REQUEST['bounding'];}
if (isset($_REQUEST['min'])){$dateMin=$_REQUEST['min'];}
if (isset($_REQUEST['max'])){$dateMax=$_REQUEST['max'];}

//could be improved by using bounding box instead of intersection on polygon										
$query="SELECT Avg(a.value) AS value, a.date_measured as date,a.parameter as param,b.STATE_ABBR as state,b.jGeom as geom
                                        FROM  measurement AS a, 
                                        (SELECT STATE_ABBR, geometry, AsGeoJSON(geometry) as jGeom FROM states)  AS b
                                        WHERE
					a.state_abbr=b.STATE_ABBR
					AND ST_Intersects(b.geometry, BuildMbr($strBounding))=1
                                        AND a.parameter = '$strParam'
                                        AND date(a.date_measured) < date($dateMin)
                                        AND date(a.date_measured) > date($dateMax)
                                        GROUP BY b.STATE_ABBR;";
  
try {
	
	function getLayer ($strParam,$strBounding,$dateMin,$dateMax,$query) {
		$db = new SQLite3('limabean.sqlite');
		//$db->busyTimeout(80000);
		//loading spatialite extension
		$db->loadExtension('libspatialite.so');
	
		//echo $query;
		$st = $db->query($query);
		if (! $st) {
			$error = $db->errorInfo();
			print "Problem ({$error[2]})";
		
		}
	
		$data = array();		

		while ($res = $st->fetchArray(SQLITE3_ASSOC)){
			$data[]=$res;
		}
		echo json_encode(array("response"=>$data));
	}
	
    $dbh = null;
} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}

getLayer($strParam,$strBounding,$dateMin,$dateMax,$query);

?>

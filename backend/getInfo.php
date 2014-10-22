<?php

/* NEED TO HAVE THESE PARAMETERS PASSED, ELSE FALL BACK TO DEFAULTS (THESE FOR NOW) */ 
$strParam='WIND SPEED';
$dateMin='2009-04-01';
$dateMax='2009-09-01';
$field='29';

if (isset($_REQUEST['param'])){$strParam=$_REQUEST['param'];}
if (isset($_REQUEST['min'])){$dateMin=$_REQUEST['min'];}
if (isset($_REQUEST['max'])){$dateMax=$_REQUEST['max'];}
if (isset($_REQUEST['field'])){$field=$_REQUEST['field'];}

//could be improved by using bounding box instead of intersection on polygon										
/* $query="SELECT Avg(a.value) AS value, a.date_measured as date,a.parameter as param,b.STATE_ABBR as state,b.jGeom as geometry
                                        FROM  measurement AS a, 
                                        (SELECT STATE_ABBR, geometry, AsGeoJSON(geometry) as jGeom FROM states)  AS b
                                        WHERE
					a.state_abbr=b.STATE_ABBR
                                        AND a.parameter = '$strParam'
                                        AND date(a.date_measured) BETWEEN date('$dateMin') AND date('$dateMax')
                                        GROUP BY b.STATE_ABBR;"; */
										
//$query="select value, tom as date, parameter as param, '3434d' as geometry FROM v_measurement WHERE parameter = '$strParam' AND date(tom) BETWEEN date('$dateMin') AND date('$dateMax');";

/* $query="select field_id_1 as field_id, avg(value) as value, date(FROM_UNIXTIME(avg(UNIX_TIMESTAMP(date(tom))))) as date, parameter as param, CONCAT(longitude, ',',latitude)  as geometry FROM v_measurement 
WHERE parameter = '$strParam' AND date(tom) BETWEEN date('$dateMin') AND date('$dateMax')
GROUP BY geometry;"; */

$query="select field_id_1 as field_id, value as value, tom as date, parameter as param FROM v_measurement 
WHERE field_id_1 = $field and parameter = '$strParam' AND date(tom) BETWEEN date('$dateMin') AND date('$dateMax') ORDER BY field_id_1;";

//$query="select * FROM lb_fields;";

//adapted for mysql, geojson is for points, can construct in parser										
try {
	
	function getInfo ($strParam,$dateMin,$dateMax,$field,$query) {
		include 'credentials.php';
		//$db = new SQLite3('limabean.sqlite');
		//$db->busyTimeout(80000);
		//loading spatialite extension
		//$db->loadExtension('libspatialite.so');
		
		$db = new mysqli($host,$user,$pass,$schema);
	
		$result = $db->query($query);
		if (! $result) {
			printf("Errormessage: %s\n", $db->error);

		}
		
		/*$output = '';
		$rowOutput = '';

		 while ($row = $result->fetch_assoc()) {
    			$rowOutput = (strlen($rowOutput) > 0 ? ',' : '') . '{"type": "Feature", "geometry": {"type": "Point", "coordinates": [' . $row['geometry'] . ']}, "properties": {';
    			$props = '';
    			$id = '';
    			foreach ($row as $key => $val) {
        			if ($key != "geometry") {
            				$props .= (strlen($props) > 0 ? ',' : '') . '"' . $key . '":"' . $val . '"';
        			}
    			}
    
    			$rowOutput .= $props . '}';
    			$rowOutput .= '}';
    			$output .= $rowOutput;
		}
 
		$output = $lb_fields . ',{ "type": "FeatureCollection", "features": [' . $output . ' ]}'; */
		$arr_result = array();
		// while ($row = $result->fetch_assoc()) {
			// foreach ($row as $key => $val) {
					// if ($key == "field_id") {
        			// $arr_result[$key] = $val;
					// }
    			// }
		// }
		
		while ($row = $result->fetch_assoc()) {
			$arr_result[] = $row;
		}
		
		$arr_output['items'] = $arr_result;

		header('Content-Type: application/json');
		
		echo json_encode($arr_output);
		}
	
    $dbh = null;
} catch (Exception $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}

// Block below was on sqlite										
/* try {
	
	function getLayer ($strParam,$dateMin,$dateMax,$query) {
		$db = new SQLite3('limabean.sqlite');
		$db->loadExtension('libspatialite.so');
	
		$st = $db->query($query);
		if (! $st) {
			$error = $db->errorInfo();
			print "Problem ({$error[2]})";

		}

		# Build GeoJSON
		$output = '';
		$rowOutput = '';
 
		while ($row = $st->fetchArray(SQLITE3_ASSOC)) {
    			$rowOutput = (strlen($rowOutput) > 0 ? ',' : '') . '{"type": "Feature", "geometry": ' . $row['geometry'] . ', "properties": {';
    			$props = '';
    			$id = '';
    			foreach ($row as $key => $val) {
        			if ($key != "geometry") {
            				$props .= (strlen($props) > 0 ? ',' : '') . '"' . $key . '":"' . $val . '"';
        			}
    			}
    
    			$rowOutput .= $props . '}';
    			$rowOutput .= '}';
    			$output .= $rowOutput;
		}
 
		$output = '{ "type": "FeatureCollection", "features": [ ' . $output . ' ]}';


		header('Content-Type: application/json');
		echo $output;
		}
	
    $dbh = null;
} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
} */

getInfo($strParam,$dateMin,$dateMax,$field,$query);

?>

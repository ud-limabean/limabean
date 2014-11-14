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

$query="select field_id_1 as field_id, value as value, tom as date, parameter as param FROM v_measurement 
WHERE field_id_1 = $field and parameter = '$strParam' AND date(tom) BETWEEN date('$dateMin') AND date('$dateMax') ORDER BY field_id_1;";

//$query="select * FROM lb_fields;";

//adapted for mysql, geojson is for points, can construct in parser										
try {
	
	function getInfo ($strParam,$dateMin,$dateMax,$field,$query) {
		include 'credentials.php';
		
		$db = new mysqli($host,$user,$pass,$schema);
	
		$result = $db->query($query);
		if (! $result) {
			printf("Errormessage: %s\n", $db->error);

		}
		
		$arr_result = array();
		
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

getInfo($strParam,$dateMin,$dateMax,$field,$query);

?>

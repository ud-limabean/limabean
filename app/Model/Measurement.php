<?php
App::uses('AppModel', 'Model');
class Measurement extends AppModel {
	/* $conditions = array(
					"Measurement.field_id_1" => $this->request->params[0],
					"date(Measurement.tom) BETWEEN" => date($this->request->params[1]) AND date($this->request->params[2]),
					"Measurement.param" => $this->request->params[3]); */

	public function search($params) {
		$db = $this->getDataSource(); 
		$conditions = array(
					"Measurement.field" => $params['field'],
					"date(Measurement.tom) BETWEEN ? and ?" => array($db->expression("date('$params[min]')"), $db->expression("date('$params[max]')")),
					"Measurement.param" => $params['param']);
						
		/* $conditions = array(
					"Measurement.field" => '40',
					"date(Measurement.tom) BETWEEN" => "date('2009-01-01') AND date('2014-05-01')",
					"Measurement.param" => 'AirTemperature'); */
					
		// Example usage with a model:
		
		
		$first = $this->find('all', array('conditions' => $conditions, 'limit' => 100));
		return $first;
		//return $conditions;
		//$this->Measurement->find('first');
		
		//$this->set('measurements', $this->Measurement->find('all'));
		//echo print_r($this->request->params);
        //action logic goes here..
		//$this->request->params
    }
}

?>
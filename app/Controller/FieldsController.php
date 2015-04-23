<?php
App::uses('AppController', 'Controller');
/**
 * Fields Controller
 *
 * @property Field $Field
 * @property PaginatorComponent $Paginator
 */
class FieldsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');

	public $paginate = array('Field','Measurement'=>array('limit'=>5));


	public function checkFieldAuth($user, $field){
		$owners = array();
		$callback = function ($value,$key) use ($user, &$owners){
			if($key == 'user_id' && $user['id'] == $value){
                                $owners[] = $value;
                        }
		};
		
		array_walk_recursive($field['FieldOwnership'], $callback);
	
		if(!in_array($user['id'],$owners) && $user['role'] != 'admin' ){
			$this->redirect(array('controller'=> 'users', 'action' => 'view', $user['id']));
		}

		return true; 
	}



/**
 /* admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->Field->recursive = 0;
		$this->set('fields', $this->Paginator->paginate());
	}
	
/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */

        public function admin_view($id = null, $div_measurement_parameter_id = 1, $format = null) {
                if (!$this->Field->exists($id)) {
                        throw new NotFoundException(__('Invalid field'));
                }
				
                $this->Field->recursive = 2;

                $options = array(
                        'conditions' => array('Field.' . $this->Field->primaryKey => $id),
                        'contain' => array(
                                'Locality',
                        )
                );
				
				$measurements = $this->paginate($this->Field->Measurement, array(
                                'Field.' . $this->Field->primaryKey => $id,
                                'Measurement.div_measurement_parameter_id' => $div_measurement_parameter_id
                ));
				
				$field = $this->Field->find('first', $options);
	
				if($format == 'csv'){
					foreach($measurements as $index => $values) {
						$measurements[$index] = $values['Measurement'];
					}
					
					$_serialize = 'measurements';
					$this->viewClass = 'CsvView.Csv';
					$this->set(compact('measurements' ,'_serialize'));
					
				} else {		

					$this->set('measurements', $measurements);

					$this->set('field', $field);
				
				}
        }

public function risk($id = null,$cultivar = 1, $history = 1, $date = NULL){

$this->layout = 'data';

if ($this->request->is('post') || $this->request->is('put')){
	//debug($this->request->data);
	$date = $this->request->data['Measurement']['tom'];
	$date = $date['year'] . $date['month'] . $date['day'];
	$history = $this->request->data['Measurement']['history'];
	$cultivar = $this->request->data['Measurement']['cultivar']; 
	//debug($date);
	//$div_measurement_parameter_id = $this->request->data['Fields'][''];
}
if (!$this->Field->exists($id)) {
		 throw new NotFoundException(__('Invalid field'));
}


$options = array(
                'conditions' => array('Field.' . $this->Field->primaryKey => $id),
                'contain' => array(
                        'Locality',
                        'FieldOwnership'
                )
        );

$field = $this->Field->find('first', $options);
$this->set('field', $field);

if (is_null($date)){
        $this->set('risk',NULL);
        return false;
        //$date = date("Ymd");
        //$date = 20130415;
} else {
	$this->set('date', $field);
}

$div_measurement_parameter_ids = array(1,3,7);

$tempurature = $this->Field->Measurement->find('all',array(
                'recursive' => 0,
                'fields' => array(
			'MAX(Measurement.value)',
			),
		'group' => array('Measurement.tom'),
		'conditions' => array(
                        'Field.' . $this->Field->primaryKey => $id,
                        'Measurement.div_measurement_parameter_id' => 1,
			"Measurement.tom BETWEEN date($date - 5) AND date($date)" 
                )
        ));
$rh =  $this->Field->Measurement->find('all',array(
                'recursive' => 0,
                'fields' => array(
                        'COUNT(Measurement.value)',
                        //'MeasurementParameter.parameter'),
			),
                'group' => array(
				'MeasurementParameter.parameter'
		),
                'conditions' => array(
                        'Field.' . $this->Field->primaryKey => $id,
                        'Measurement.div_measurement_parameter_id' => 3,
                        "Measurement.tom BETWEEN date($date - 5) AND date($date)",
			'Measurement.value >' => '96' 
                )
        ));

$rain = $this->Field->Measurement->find('all',array(
                'recursive' => 0,
                'fields' => array(
                        'SUM(Measurement.value)',
                        //'MeasurementParameter.parameter'),
			),
                'group' => array(
			'MeasurementParameter.parameter'
		),
                'conditions' => array(
                        'Field.' . $this->Field->primaryKey => $id,
                        'Measurement.div_measurement_parameter_id' => 7,
                        "Measurement.tom BETWEEN date($date - 10) AND date($date)"
                )
        ));

	//debug($tempurature);
	//reddturn false;
	//array_values($tempurature[0][0])
	
	$sum = 0;
	$count = 0;

	array_walk($tempurature, function ($item, $key) use ($tempurature, &$sum, &$count){
    		$count++;
		$sum = $sum + array_shift($item[0]);
	});
	
	$tempurature = $sum/$count * 9 / 5 + 32;
	
	//$tempurature = array_shift($tempurature[0][0]) * 9 / 5 + 32;
	
	if (sizeof($rh)>=1){
		$rh = array_shift($rh[0][0]);
	} else {
		$rh = 0;
	}
	
	if (sizeof($rain)>=1){
                $rain = array_shift($rain[0][0]) * 0.0393701;
        } else {
                $rain = 0;
        }
	//debug($rh);
	
	$a = $history;

	if ($tempurature  > 78) {
    		$b = 3;
	} elseif ($tempurature > 69) {
    		$b = 2;
	} elseif ($tempurature > 60) {
    		$b = 1;
	} else {
		$b = 0;
	}

	if ($rain  > 3) {
                $c = 4;
        } elseif ($rain > 2) {
                $c = 3;
        } elseif ($rain > 1.2) {
                $c = 2;
        } elseif($rain > 0.01) {	
		$c = 1;
	} else {
		$c = 0;
	}

	/*if ($rh  > 3) {
                $d = 4;
        } elseif ($rh > 2) {
                $d = 3;
        } elseif ($rh > 1.2) {
                $d = 2;
        } else {
                $d = 1;
        }*/

	if ($rh  > 40) {
                $d = 4;
        } elseif ($rh > 20) {
                $d = 3;
        } elseif ($rh > 10) {
                $d = 2;
        } elseif ($rh > 1) {
                $d = 1;
        } else {
		$d = 0;
	}


	$hyre = $cultivar*($a + $b + $c);
	$raniere = $cultivar*($a + $b + $d); 

	//debug($index);
	//debug($index2);
//$this->set('index', $index);
//$this->set('index2', $index2);
$this->set('risk', compact('cultivar','history','tempurature','rain','rh','date','hyre','raniere','a','b','c','d'));


}



public function view($id = null, $div_measurement_parameter_id = 1, $format = null) {
	
	$this->layout = 'data';

	if ($this->request->is('post') || $this->request->is('put')){
		$div_measurement_parameter_id = $this->request->data['Fields']['parameters'];
	}	
	if (!$this->Field->exists($id)) {
                throw new NotFoundException(__('Invalid field'));
        }

        $this->Field->recursive = 2;

        $options = array(
        	'conditions' => array('Field.' . $this->Field->primaryKey => $id),
                'contain' => array(
                	'Locality',
			'FieldOwnership'
                )
        );

        $measurements = $this->paginate($this->Field->Measurement, array(
                'Field.' . $this->Field->primaryKey => $id,
                'Measurement.div_measurement_parameter_id' => $div_measurement_parameter_id
        ));

				
	$measurementAvg = $this->Field->MeasurementAvg->find('all',array(
		'recursive' => 0,
		'conditions' => array(
			'Field.' . $this->Field->primaryKey => $id,
                        'MeasurementAvg.div_measurement_parameter_id' => $div_measurement_parameter_id
		)
	));


	$parameters = array('1'=> 'AirTemperature','2'=> 'DewpointTemperature','3'=> 'RelativeHumidity','4'=> 'SolarRadiation','5'=> 'WindSpeed','6'=> 'SoilTemperature','7'=> 'Rainfall','8'=> 'VolumetricWaterContent'); 
	//$parameters = Set::extract($measurements, '/Measurement/MeasurementParameter/parameter');

        $field = $this->Field->find('first', $options);


	$this->checkFieldAuth($this->Auth->user(),$field);

        if($format == 'csv'){
		$options = array(
                'conditions' => array('Field.' . $this->Field->primaryKey => $id,
					'Measurement.div_measurement_parameter_id' => $div_measurement_parameter_id	
		)
        	
		);
		$_header = array_keys($this->Field->Measurement->getColumnTypes());
	
		$results = $this->Field->Measurement->find('all', $options);
	        foreach($results as $index => $values) {
                	$measurements[$index] = $values['Measurement'];
                }
	
		//debug($measurements);
		//debug($header);
		//$measurements = array_unshift($measurements, $header);	
		//$_extract = $this->CsvView->prepareExtractFromFindResults($results);
		//$_header = $this->CsvView->prepareHeaderFromExtract($_extract);
		$_serialize = 'measurements';
                $this->viewClass = 'CsvView.Csv';
                $this->set(compact('measurements' ,'_serialize','_header'));

        } else {
		$this->set('div_measurement_parameter_id',$div_measurement_parameter_id);
                $this->set('measurements', $measurements);
		$this->set('measurementAvg', $measurementAvg);
		$this->set('parameters', $parameters);
                $this->set('field', $field);
        }
}
	

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->Field->create();
			if ($this->Field->save($this->request->data)) {
				$this->Session->setFlash(__('The field has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The field could not be saved. Please, try again.'));
			}
		}
	}

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		if (!$this->Field->exists($id)) {
			throw new NotFoundException(__('Invalid field'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Field->save($this->request->data)) {
				$this->Session->setFlash(__('The field has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The field could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Field.' . $this->Field->primaryKey => $id));
			$this->request->data = $this->Field->find('first', $options);
		}
	}

/**
 * admin_delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->Field->id = $id;
		if (!$this->Field->exists()) {
			throw new NotFoundException(__('Invalid field'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Field->delete()) {
			$this->Session->setFlash(__('The field has been deleted.'));
		} else {
			$this->Session->setFlash(__('The field could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}

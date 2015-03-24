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

/**
 * admin_index method
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

public function view($id = null, $div_measurement_parameter_id = 1, $format = null) {
	
	$this->layout = 'default_small_ad';

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
                	'Locality'
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

        if($format == 'csv'){
	        foreach($measurements as $index => $values) {
                	$measurements[$index] = $values['Measurement'];
                }

                $_serialize = 'measurements';
                $this->viewClass = 'CsvView.Csv';
                $this->set(compact('measurements' ,'_serialize'));

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

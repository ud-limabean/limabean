<?php
App::Import('Model', 'Field');
App::uses('AppController', 'Controller');
/**
 * Measurements Controller
 *
 * @property Measurement $Measurement
 * @property PaginatorComponent $Paginator
 */
class MeasurementsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Measurement->recursive = 0;
		$this->set('measurements', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Measurement->exists($id)) {
			throw new NotFoundException(__('Invalid measurement'));
		}
		$options = array('conditions' => array('Measurement.' . $this->Measurement->primaryKey => $id));
		$this->set('measurement', $this->Measurement->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Measurement->create();
			if ($this->Measurement->save($this->request->data)) {
				$this->Session->setFlash(__('The measurement has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The measurement could not be saved. Please, try again.'));
			}
		}
		$fields = $this->Measurement->field->find('list');
		$measurementParameters = $this->Measurement->measurementParameter->find('list');
		$divObsUnits = $this->Measurement->ObsUnit->find('list');
		$divStatisticTypes = $this->Measurement->StatisticType->find('list');
		$this->set(compact('fields', 'measurementParameters', 'cdvSources', 'divObsUnits', 'divStatisticTypes'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Measurement->exists($id)) {
			throw new NotFoundException(__('Invalid measurement'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Measurement->save($this->request->data)) {
				$this->Session->setFlash(__('The measurement has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The measurement could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Measurement.' . $this->Measurement->primaryKey => $id));
			$this->request->data = $this->Measurement->find('first', $options);
		}
		$fields = $this->Measurement->field->find('list');
		$divMeasurementParameters = $this->Measurement->measurementParameter->find('list');
		$divObsUnits = $this->Measurement->ObsUnit->find('list');
		$divStatisticTypes = $this->Measurement->StatisticType->find('list');
		$this->set(compact('fields', 'divMeasurementParameters', 'cdvSources', 'divObsUnits', 'divStatisticTypes'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Measurement->id = $id;
		if (!$this->Measurement->exists()) {
			throw new NotFoundException(__('Invalid measurement'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Measurement->delete()) {
			$this->Session->setFlash(__('The measurement has been deleted.'));
		} else {
			$this->Session->setFlash(__('The measurement could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}

/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->Measurement->recursive = 0;
		$this->set('measurements', $this->Paginator->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->Measurement->exists($id)) {
			throw new NotFoundException(__('Invalid measurement'));
		}
		$options = array('conditions' => array('Measurement.' . $this->Measurement->primaryKey => $id));
		$this->set('measurement', $this->Measurement->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->Measurement->create();
			if ($this->Measurement->save($this->request->data)) {
				$this->Session->setFlash(__('The measurement has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The measurement could not be saved. Please, try again.'));
			}
		}
		$fields = $this->Measurement->field->find('list');
		$divMeasurementParameters = $this->Measurement->measurementParameter->find('list');
		$divObsUnits = $this->Measurement->ObsUnit->find('list');
		$divStatisticTypes = $this->Measurement->StatisticType->find('list');
		$this->set(compact('fields', 'divMeasurementParameters', 'cdvSources', 'divObsUnits', 'divStatisticTypes'));
	}

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		if (!$this->Measurement->exists($id)) {
			throw new NotFoundException(__('Invalid measurement'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Measurement->save($this->request->data)) {
				$this->Session->setFlash(__('The measurement has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The measurement could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Measurement.' . $this->Measurement->primaryKey => $id));
			$this->request->data = $this->Measurement->find('first', $options);
		}
		$fields = $this->Measurement->field->find('list');
		$measurementParameters = $this->Measurement->measurementParameter->find('list');
		$ObsUnits = $this->Measurement->ObsUnit->find('list');
		$divStatisticTypes = $this->Measurement->StatisticType->find('list');
		$this->set(compact('fields', 'measurementParameters', 'cdvSources', 'divObsUnits', 'divStatisticTypes'));
	}

/**
 * admin_delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->Measurement->id = $id;
		if (!$this->Measurement->exists()) {
			throw new NotFoundException(__('Invalid measurement'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Measurement->delete()) {
			$this->Session->setFlash(__('The measurement has been deleted.'));
		} else {
			$this->Session->setFlash(__('The measurement could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}

<?php
App::uses('AppController', 'Controller');
/**
 * FieldOwnerships Controller
 *
 * @property FieldOwnership $FieldOwnership
 * @property PaginatorComponent $Paginator
 */
class FieldOwnershipsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator','Session');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->FieldOwnership->recursive = 0;
		$this->set('fieldOwnerships', $this->Paginator->paginate());
	}

/**
 * display method
 *
 * @return void
 */
        public function display($user_id = null) {
                $this->FieldOwnership->recursive = 0;
                $this->set('fieldOwnerships', 
			$this->Paginator->paginate(
				array('FieldOwnership.user_id' => $user_id) 
			)
		);
        }

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->FieldOwnership->exists($id)) {
			throw new NotFoundException(__('Invalid field ownership'));
		}
		$options = array('conditions' => array('FieldOwnership.' . $this->FieldOwnership->primaryKey => $id));
		$this->set('fieldOwnership', $this->FieldOwnership->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->FieldOwnership->create();
			$keys = array('field_id','user_id');
			$this->request->data['FieldOwnership'] = array_combine($keys, array_values($this->request->data['FieldOwnership']));
			if ($this->FieldOwnership->save($this->request->data)) {
				$this->Session->setFlash(__('The field ownership has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The field ownership could not be saved. Please, try again.'));
			}
		}
		$fields = $this->FieldOwnership->Field->find('list');
		$users = $this->FieldOwnership->User->find('list');
		$this->set(compact('fields', 'users'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->FieldOwnership->exists($id)) {
			throw new NotFoundException(__('Invalid field ownership'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->FieldOwnership->save($this->request->data)) {
				$this->Session->setFlash(__('The field ownership has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The field ownership could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('FieldOwnership.' . $this->FieldOwnership->primaryKey => $id));
			$this->request->data = $this->FieldOwnership->find('first', $options);
		}
		$fields = $this->FieldOwnership->Field->find('list');
		$users = $this->FieldOwnership->User->find('list');
		$this->set(compact('fields', 'users'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->FieldOwnership->id = $id;
		if (!$this->FieldOwnership->exists()) {
			throw new NotFoundException(__('Invalid field ownership'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->FieldOwnership->delete()) {
			$this->Session->setFlash(__('The field ownership has been deleted.'));
		} else {
			$this->Session->setFlash(__('The field ownership could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}

/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->FieldOwnership->recursive = 0;
		$this->set('fieldOwnerships', $this->Paginator->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->FieldOwnership->exists($id)) {
			throw new NotFoundException(__('Invalid field ownership'));
		}
		$options = array('conditions' => array('FieldOwnership.' . $this->FieldOwnership->primaryKey => $id));
		$this->set('fieldOwnership', $this->FieldOwnership->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->FieldOwnership->create();
			if ($this->FieldOwnership->save($this->request->data)) {
				$this->Session->setFlash(__('The field ownership has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The field ownership could not be saved. Please, try again.'));
			}
		}
		$fields = $this->FieldOwnership->Field->find('list');
		$users = $this->FieldOwnership->User->find('list');
		$this->set(compact('fields', 'users'));
	}

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		if (!$this->FieldOwnership->exists($id)) {
			throw new NotFoundException(__('Invalid field ownership'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->FieldOwnership->save($this->request->data)) {
				$this->Session->setFlash(__('The field ownership has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The field ownership could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('FieldOwnership.' . $this->FieldOwnership->primaryKey => $id));
			$this->request->data = $this->FieldOwnership->find('first', $options);
		}
		$fields = $this->FieldOwnership->Field->find('list');
		$users = $this->FieldOwnership->User->find('list');
		$this->set(compact('fields', 'users'));
	}

/**
 * admin_delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->FieldOwnership->id = $id;
		if (!$this->FieldOwnership->exists()) {
			throw new NotFoundException(__('Invalid field ownership'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->FieldOwnership->delete()) {
			$this->Session->setFlash(__('The field ownership has been deleted.'));
		} else {
			$this->Session->setFlash(__('The field ownership could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}

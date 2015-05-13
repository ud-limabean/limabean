<?php
App::uses('AppController', 'Controller');
/**
 * Users Controller
 *
 * @property User $User
 * @property PaginatorComponent $Paginator
 */
class UsersController extends AppController {

/**
 * Helpers
 *
 * @var array
 */

public $helpers = array('Form', 'Html', 'Js', 'Lmarker');

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');

	public function beforeFilter(){
		parent::beforeFilter();
		$this->Auth->allow('add');
	}

	public function isAuthorized($user){
		if ($this->request['admin'] && $this->Auth->user('role') != 'admin'){
                	return false;
        	}

		if(in_array($this->action,array('edit','delete'))){
			if($user['id'] != $this->request->params['pass'][0] && $user['role'] != 'admin' ){
				return false;
				#return null;
			}
		}
		return true; 
	}

        public function login(){
        	if ($this->request->is('post')){
			if ($this->Auth->login()){
				$this->redirect($this->Auth->redirect());
			} else {
				$this->Session->setFlash('Your username/password combination was incorrect');
			}
		}
	}

	public function admin_login(){
                if ($this->request->is('post')){
                        if ($this->Auth->login()){
                                $this->redirect($this->Auth->redirect());
                        } else {
                                $this->Session->setFlash('Your username/password combination was incorrect');
                        }
                }
        }
	
	public function admin_logout(){
		$this->redirect($this->Auth->logout());
	}	
	
	public function logout(){
		$this->redirect($this->Auth->logout());
	}

	public function test(){
		$something = 'something';
	}

	public function admin_test(){
		$this->test();
	}

/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->User->recursive = 0;
		$this->set('users', $this->Paginator->paginate());
		//$this->set('users', $this->User->find('all'));
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
public function admin_view($id = null) {
	//$this->layout = 'user';
	$this->view($id,true);
	$this->render('view');
}

/*	public function admin_view($id = null) {
		if (!$id){
			$current_user = $this->Auth->user();

                	if($current_user){
                        	$id = $current_user;
                	}

		}

		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Invalid user'));
		}
		//$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
		$options = array(
    			'conditions' => array('User.' . $this->User->primaryKey => $id),
    			'contain' => array(
				'FieldOwnership' => array(
					'Field'
				)
    			)
		);
		
		$this->set('user', $this->User->find('first', $options));
	}
*/
/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
        public function view($id = null, $admin = false) {
		$this->layout = 'user';
		$current_user = $this->Auth->user();
		
		if($current_user){
			$id = $current_user;	
		}

		if (!$this->User->exists($id)) {
                        throw new NotFoundException(__('Invalid user'));
                }
                //$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
                $options = array(
                        'conditions' => array('User.' . $this->User->primaryKey => $id),
                        'contain' => array(
                                'FieldOwnership' => array(
                                        'Field'
                                )
                        )
                );

                $this->set('user', $this->User->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->User->create();
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('The user has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
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
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Invalid user'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('The user has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
			$this->request->data = $this->User->find('first', $options);
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
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->User->delete()) {
			$this->Session->setFlash(__('The user has been deleted.'));
		} else {
			$this->Session->setFlash(__('The user could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}

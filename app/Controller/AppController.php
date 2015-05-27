<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {
public $components = array(
    //'DebugKit.Toolbar',
    'Session',
    'Auth'=>array(
      'loginRedirect'=>array('controller'=>'users','action'=>'view'),
      //'loginRedirect'=>array(redirect($this->referer())),
      'logoutRedirect'=>array('controller'=>'users','action'=>'login','admin'=>false),
      'authError'=>"You can't access that page",
      'authorize'=>array('Controller')
    )
);
	public function beforeRender(){
		if(!$this->isAuthorized($this->Auth->user) && $this->request['action'] != 'login'){
			$this->redirect($this->referer());
		} 
	}
 
   public function isAuthorized($user){
      	if ($this->request['admin'] && $this->Auth->user('role') != 'admin'){
		return false;
	}
	return true;
    }

     public function beforeFilter(){
      	$this->set('logged_in',$this->Auth->loggedIn());
      	$this->set('current_user',$this->Auth->user());

	$allowed_controllers = array('fields','users','pages');
	$allowed_actions = array('view','risk','login','logout','display');

	
	if($this->request['prefix'] != 'admin'){

          	if(!in_array($this->request['controller'], $allowed_controllers) || !in_array($this->request['action'], $allowed_actions)){
                  	$this->redirect(array(
                              	//'admin' => true,
                               	//'controller' => $this->request['controller'],
                             	//'action' => $this->request['action'],
                              	//$this->request['pass'][0]
                                //'controller' => 'users',
				//'action' => 'view'
				'controller' => 'pages',
				'action' => 'display',
				'home'
				)
                                );
        	}
	}
		
    }
}

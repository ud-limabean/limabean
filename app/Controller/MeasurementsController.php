<?php

class MeasurementsController extends AppController {
	public $components = array('RequestHandler');
	
	public function beforeFilter() {
		$this->RequestHandler->addInputType('json', ['json_decode', true]);
		
		if ($this->request->is('ajax')) {
			$this->disableCache();
		}
		
		if ($this->RequestHandler->accepts('json')) {
            $this->disableCache();
			$this->RequestHandler->setContent('json', 'application/json');
        }
    }
	
	public function search() {
	
		$params = $this->request->data;
		$this->set('conditions', $params);
		//$params = $this->params['named'];
		
		$search = $this->Measurement->search($params);
		
		$this->set('search', $search);
		$this->set('_serialize', array('conditions','search'));
    }
	
}

?>
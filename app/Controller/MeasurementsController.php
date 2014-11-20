<?php

class MeasurementsController extends AppController {
	public $components = array('RequestHandler');
	
	public function beforeFilter() {
		$this->RequestHandler->addInputType('json', array('json_decode', true));
		
		/* $parser = function ($data) {
			parse_str ( string $str [, array &$arr ] )
			return json_decode($data, true);
		};
		
		$this->RequestHandler->addInputType('json', array($parser)); */
		
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

		//for debugging
		//$params = $this->params['named'];
		
		$search = $this->Measurement->search($params);
		
		$this->set('search', $search);
		$this->set('_serialize', 'search');
    }
	
}

?>
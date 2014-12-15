<?php

class MeasurementsController extends AppController {
	public $components = array('RequestHandler','Paginator');

	public $paginate = array(null);
	
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
    }
	
	public function search() {
		//debug($this->request);
		$db = $this->Measurement->setDb();
		if ($this->request->data){
			$params = $this->request->data;
		} else {
			$params = $this->request->params;
			$params = $params['named'];
		}
		
		$this->Paginator->settings = array(
			'limit' => 25,
			'conditions' =>  array(
					"Measurement.field" => $params['field'],
					"date(Measurement.tom) BETWEEN ? and ?" => array($db->expression("date('$params[min]')"), $db->expression("date('$params[max]')")),
					"Measurement.param" => $params['param']),
			'order' => array(
				'Measurements.tom' => 'asc'
			)
		);
		$data = $this->Paginator->paginate('Measurement');
		$this->set(compact('data'));

		//for debugging
		//$params = $this->params['named'];
		
		
		//$search = $this->Measurement->search($params);
		
		$this->set('params', $params);
		//$this->set('search', $search);
		//$this->set('_serialize', 'search');
    }
	
	public function json_search() {
		if ($this->RequestHandler->accepts('json')) {
            $this->disableCache();
			$this->RequestHandler->setContent('json', 'application/json');
        }
	
		$params = $this->request->data;

		//for debugging
		//$params = $this->params['named'];
		
		$search = $this->Measurement->search($params);
		
		$this->set('search', $search);
		$this->set('_serialize', 'search');
		$this->render('json_search');
    }
	
}

?>
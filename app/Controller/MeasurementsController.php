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
    }
	
	public function search() {
	
		$params = $this->request->data;

		//for debugging
		//$params = $this->params['named'];
		
		$search = $this->Measurement->search($params,'html');
		
		$this->set('params', $params);
		$this->set('search', $search);
		//$this->set('_serialize', 'search');
    }
	
	public function csv_extract() {
		//need param for format
	
		//$params = $this->request->data;

		//for debugging
		$params = $this->request->params['named'];
		#debug($params);
		
		$results = $this->Measurement->search($params,'csv');
		#$this->CsvView->quickExport($results);
		
		#$results = $this->Measurement->find('first');

		//$excludePaths = array('City.id', 'State.id', 'State.Country.id'); // Exclude all id fields
		//$_extract = $this->CsvView->prepareExtractFromFindResults($results, $excludePaths);

		//$customHeaders = array('City.population' => 'No. of People');
		//$_header = $this->CsvView->prepareHeaderFromExtract($_extract, $customHeaders);

		$_serialize = 'results';
		$this->viewClass = 'CsvView.Csv';
		//$this->set(compact('results' ,'_serialize', '_header', '_extract'));
		$this->set(compact('results' ,'_serialize'));
    }
	
	public function kml_extract() {
		//need param for format
		$this->RequestHandler->setContent('kml', 'application/vnd.google-earth.kml+xml');
		$params = $this->request->data;

		//for debugging
		//$params = $this->params['named'];
		
		$search = $this->Measurement->search($params);
		
		
		
		//$this->set('params', $params);
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
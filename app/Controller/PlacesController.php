<?php

class PlacesController extends AppController {
	
	public function index() {
        $this->set('places', $this->Place->find('all'));
		$this->layout = 'index';
    }
	
	public function home() {
        $this->set('places', $this->Place->find('all'));
		$this->layout = 'home';
    }
	
}

?>
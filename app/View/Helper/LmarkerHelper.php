<?php

App::uses('AppHelper','View/Helper');

class LmarkerHelper extends AppHelper {
	public $helpers = array('Html');
	
	public function findLatLon($data){
		global $arrFindLatLon;
        foreach ($data as $datum) {
                if (is_array($data) && array_key_exists('latitude', $data) && array_key_exists('longitude', $data)){
                        $lat = $data['latitude'];
                        $lon = $data['longitude'];
			$id = $data['div_field_id'];
                        $text =  $this->Html->link(__('Goto Field'), array('controller' => 'fields', 'action' => 'view', $id));
                        $arrFindLatLon[] = 'L.marker([' . $lat . ',' . $lon . "]).addTo(lb.map).bindPopup('$text');";
                } elseif(is_array($datum)) {
                        if (array_key_exists('latitude', $datum) && array_key_exists('longitude', $datum)){
                                $lat = $datum['latitude'];
                                $lon = $datum['longitude'];
				$id = $datum['div_field_id'];
                                $text =  $this->Html->link(__('Goto Field'), array('controller' => 'fields', 'action' => 'view', $id));
				$arrFindLatLon[] = 'L.marker([' . $lat . ',' . $lon . "]).addTo(lb.map).bindPopup('$text');";
                        }
                        $this->findLatLon($datum, $arrFindLatLon);
                }
        }
        $strFindLatLon = implode(array_unique($arrFindLatLon));
        return $strFindLatLon;
	}
}

?>

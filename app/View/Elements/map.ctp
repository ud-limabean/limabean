<?php
function findLatLon($data){
        foreach ($data as $datum) {
                if (is_array($datum) && array_key_exists('latitude', $datum) && array_key_exists('longitude', $datum)){
                        $lat = $datum['latitude'];
                        $lon = $datum['longitude'];
                         return 'L.marker([' . $lat . ',' . $lon . ']).addTo(lb.map);';
                } elseif(is_array($datum)) {
                        findLatLon($datum);
                } else {
                        return false;
                }
        }
}
?>

<?php
$this->Html->css('limabean', array('inline' => false));
/* $this->Html->css('jQDateRangeSlider', array('inline' => false)); */

$this->Html->script('jquery-1.10.2.js', array('inline' => false)); 
$this->Html->script('jquery-ui-1.10.4.custom.min.js', array('inline' => false));
/* $this->Html->script('jQDateRangeSlider-min.js', array('inline' => false));*/
?>

<?php echo $this->Session->flash(); ?>

<?php //echo $this->fetch('content'); ?>

<!-- added from legacy -->
<!-- <span>Date Range</span><div id="slider"></div> -->
<div id="map"></div>
<!-- <div><span>Parameter</span><select id="selParameter">
     <option value="AirTemperature">AIR TEMPERATURE</option>
     <option value="DewpointTemperature">DEWPOINT TEMPURATURE</option>
     <option value="Rainfall">RAINFALL</option>
     <option value="RelativeHumidity">RELATIVE HUMIDITY</option>
     <option value="SolarRadiation">SOLAR RADIATION</option>
     <option value="SoilTemperature">SOIL TEMPERATURE</option>
     <option value="WindSpeed">WIND SPEED</option>
     <option value="VolumetricWaterContent">VOLUMETRIC WATER CONTENT</option>
  </select>
</div>
<div id="info"></div>
<div id="instructions">
   <p>Welcome to the Better Bean data interface.</p>
   <ol>
      <li>Choose a date range, using the slider</li>
      <li>Choose a parameter, using the dropdown</li>
      <li>Choose a field, clicking on one in the map</li>
   </ol>
</div>
<div id="progress">
   <h3>Please wait while your data is retreived</h3>
   <img src="img/ajax-loader.gif" />
</div> -->

<script type="text/javascript">
var lb = lb || {};
lb.map = {};

// fires after DOM ready
$(function() {

// set map options
southWest = L.latLng(38.03, -78.478889),
northEast = L.latLng(39.994314, -74.166214),
bounds = L.latLngBounds(southWest, northEast);

lb.map = L.map('map', {
    center: [39.161944, -75.526667],
    zoom: 8,
        maxBounds: bounds,
        minZoom: 8
});

<?php echo findLatLon($data); ?>

// add reference tiles to map
L.tileLayer('http://otile{s}.mqcdn.com/tiles/1.0.0/map/{z}/{x}/{y}.jpeg', {
        subdomains: '1234',
        attribution: 'Tiles Courtesy of <a href="http://www.mapquest.com/">MapQuest</a> &mdash; Map data &copy; ' +
                '<a href="http://openstreetmap.org">OpenStreetMap</a> contributors, <a href="http://creativecommons.' +
                'org/licenses/by-sa/2.0/">CC-BY-SA</a>',
        detectRetina: true
}).addTo(lb.map);
});

</script>

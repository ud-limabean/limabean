<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

$cakeVersion = __d('cake_dev', 'CakePHP %s', Configure::version());
?>
<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $this->fetch('title'); ?>
	</title>
	<?php
		echo $this->Html->meta('icon');

		echo $this->Html->css('cake.generic');

		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->Html->css('limabean');
		echo $this->Html->css('jQDateRangeSlider');
		echo '<link rel="stylesheet" type="text/css" href="http://cdn.leafletjs.com/leaflet-0.7.2/leaflet.css" />';
		echo $this->fetch('script');
		//echo '<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>';
		echo $this->Html->script('jquery-1.10.2.js');
		echo $this->Html->script('jquery-ui-1.10.4.custom.min.js');
		echo $this->Html->script('jQDateRangeSlider-min.js');
		echo '<script src="http://cdn.leafletjs.com/leaflet-0.7.2/leaflet.js"></script>';
		echo '<script src="http://cdnjs.cloudflare.com/ajax/libs/handlebars.js/2.0.0-alpha.2/handlebars.js"></script>';
		echo '<script src="http://cdnjs.cloudflare.com/ajax/libs/json2/20140204/json2.min.js"></script>';
	?>
</head>
<body>
	<div id="container">
		<div id="header">
			<?php //echo $this->Html->link($cakeDescription, 'http://cakephp.org'); ?></h1>
		</div>
		<div id="content">

			<?php echo $this->Session->flash(); ?>

			<?php //echo $this->fetch('content'); ?>
			
			<!-- added from legacy -->
			<span>Date Range</span><div id="slider"></div>
			<div id="map"></div>
			<div><span>Parameter</span><select id="selParameter">
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
			</div>
		</div>
		<div id="footer">
			<?php /*echo $this->Html->link(
					$this->Html->image('cake.power.gif', array('alt' => $cakeDescription, 'border' => '0')),
					'http://www.cakephp.org/',
					array('target' => '_blank', 'escape' => false, 'id' => 'cake-powered')
				);*/
			?>
			<p>
				<?php echo $cakeVersion; ?>
			</p>
		</div>
	</div>
	<?php /* echo $this->element('sql_dump'); */?>
</body>

<script id="data-template" type="text/x-handlebars-template">
  <div class="data">
	<table>
		<thead>
		<tr>
			<th scope="col">Date</th>
			<th scope="col">Parameter</th>
			<th scope="col">value</th>
		</tr>
		</thead>
		<tbody>
  {{#each Measurement}}
  {{#if value}}
	<tr><td>{{date}}</td><td>{{param}}</td><td>{{value}}</td></tr>
  {{else}}
	<h1>No values were found for this farm ({{field_id}})</h1>
  {{/if}}
  {{/each}}
		</tbody>
  </div>
</script>

<script id="params-template" type="text/x-handlebars-template">
  <div class="params">
	<h4>You have selected the following:</h4>
	<ul>
	<li>Field ID: {{field}}</li><li>Parameter: {{param}}</li><li>Date Range: {{min}} to {{max}}</li>
	</ul>
  </div>
</script>
	
<script type="text/javascript">
var lb = lb || {};
lb.map = {};
lb.info = {};
lb.params = {};
lb.fields = {};
lb.styles = {};
lb.template = {};
lb.template.params = function(){};
lb.template.data = function(){};

lb.params.min = "2009-01-01";
lb.params.max = "2014-05-01";
lb.params.param = "AirTemperature";

//handlebars style
lb.info.style = {
	"color": "#ff7800",
	"weight": 5,
	"opacity": 0.65
};

//fires after DOM ready
$(function() {

//set map options
southWest = L.latLng(38.03, -78.478889),
northEast = L.latLng(39.994314, -74.166214),
bounds = L.latLngBounds(southWest, northEast);
	
lb.map = L.map('map', {
    center: [39.161944, -75.526667],
    zoom: 8,
	maxBounds: bounds,
	minZoom: 8
});

//initialize jquery ui slider
$("#slider").dateRangeSlider({
    bounds: {min: new Date(2009,0), max: new Date(2014,4)},
    defaultValues: {min: new Date(2009,0), max: new Date(2014,4)},
	step:{months: 1},
	formatter:function(val){
        var days = val.getDate(),
          month = val.getMonth() + 1,
          year = val.getFullYear();
        return month + "/" + year;
      }
	});
		
//compiling handlebars
lb.source = $("#data-template").html();
lb.template.data = Handlebars.compile(lb.source);

lb.source = $("#params-template").html();
lb.template.params = Handlebars.compile(lb.source);


//map marker event handler
lb.onEachFeature=function(feature, layer) {
	// add click handler to all features
	layer.on('click', function(e,data) {
		lb.params.field = e.target.feature.properties.field_id;
		//console.log(e.target.feature.properties.field_id);
		getInfo();
	});
}

//add reference tiles to map 
L.tileLayer('http://otile{s}.mqcdn.com/tiles/1.0.0/map/{z}/{x}/{y}.jpeg', {
	subdomains: '1234',
	attribution: 'Tiles Courtesy of <a href="http://www.mapquest.com/">MapQuest</a> &mdash; Map data &copy; ' +
		'<a href="http://openstreetmap.org">OpenStreetMap</a> contributors, <a href="http://creativecommons.' +
		'org/licenses/by-sa/2.0/">CC-BY-SA</a>',
	detectRetina: true
}).addTo(lb.map);


//create container for geojson layer
lb.layerData=L.geoJson({type: 'FeatureCollection',features: []},
	{style: lb.styles.stateStyle,
        onEachFeature: lb.onEachFeature
        }).addTo(lb.map);

getLayer();

});
	
//slider event handler
$("#slider").bind("valuesChanged", function(e, data){
	if ((data.values.min.getMonth() + 1) <= 9){monthMin = "-0" + (data.values.min.getMonth() + 1);}else{monthMin = "-" + (data.values.min.getMonth() + 1);}
	if ((data.values.max.getMonth() + 1) <= 9){monthMax = "-0" + (data.values.max.getMonth() + 1);}else{monthMax = "-" + (data.values.max.getMonth() + 1);}  
	lb.params.min = data.values.min.getFullYear() + monthMin + "-01";
	lb.params.max = data.values.max.getFullYear() + monthMax + "-01";
	getInfo();
});

//dropdown/select event handler
$("#selParameter").bind("change", function(){
	lb.params.param=$("#selParameter").val();
	getInfo();
});

//display progress message
function showProgress(){
	$("#info").empty(); 
	$( "#instructions" ).hide(); 
	$( "#progress" ).show();
}

//display a passed message
function showMessage(strMessage){
	$( "#progress" ).hide();
	$( "#instructions" ).hide(); 
	$("#info").append(strMessage); 
}

//retrieve data and display with handlebars template
function getInfo(){
	showProgress();
	if (typeof lb.params.field === 'undefined') {
		showMessage('<h3>You must click a field (on the map) to retrieve data.  Click on a marker in the map to select a field.</h3>');
		return false;
	}
	
	/*
	paramString = '';
	
	 
	
	$.each(lb.params, function( index, value ) {
		paramString += ('/' + index + ':' + value);
	}); */
	
	//urlString = 'measurements' + paramString;
	
	lb.params.param=$("#selParameter").val();
	
   $.ajax({
          type: "POST",
          url: 'measurements',
		  data: JSON.stringify(lb.params),
		  dataType: "html",
		  contentType: "application/json",
		  cache: false
        })
		
		.done(function( data ) {
            $("#info").html(data);
        });
		
        /* .done(function( data ) {
				console.log(data);
                // lb.layerData.addData(data.jsonObjects[0]);
				$( "#progress" ).hide();
				if(data.length == 0){
					strMessage = '<h3>No ' + lb.params.param + ' data was found for field ' + lb.params.field + ' between ' + lb.params.min + ' and ' + lb.params.max + '</h3>';
					showMessage(strMessage);
					return false;
				}
				
				var html = lb.template.params(lb.params);
				$("#info").append(html);
				var html = lb.template.data(data);
				$("#info").append(html);
		}); */
}

function getLayer(){
	lb.fields = { "type": "FeatureCollection", "features": [ {"type": "Feature", "geometry": {"type": "Point", "coordinates": [-75.146500,38.713647]}, "properties": {"field_id":"1"}},{"type": "Feature", "geometry": {"type": "Point", "coordinates": [-75.158722,38.723]}, "properties": {"field_id":"33"}},{"type": "Feature", "geometry": {"type": "Point", "coordinates": [-75.177550,38.758933]}, "properties": {"field_id":"2"}},{"type": "Feature", "geometry": {"type": "Point", "coordinates": [-75.178383,38.769936]}, "properties": {"field_id":"37"}},{"type": "Feature", "geometry": {"type": "Point", "coordinates": [-75.191967,38.735433]}, "properties": {"field_id":"3"}},{"type": "Feature", "geometry": {"type": "Point", "coordinates": [-75.210533,38.765633]}, "properties": {"field_id":"4"}},{"type": "Feature", "geometry": {"type": "Point", "coordinates": [-75.213017,38.769617]}, "properties": {"field_id":"5"}},{"type": "Feature", "geometry": {"type": "Point", "coordinates": [-75.224494,38.705919]}, "properties": {"field_id":"6"}},{"type": "Feature", "geometry": {"type": "Point", "coordinates": [-75.270511,38.785489]}, "properties": {"field_id":"7"}},{"type": "Feature", "geometry": {"type": "Point", "coordinates": [-75.282061,38.741847]}, "properties": {"field_id":"8"}},{"type": "Feature", "geometry": {"type": "Point", "coordinates": [-75.291883,38.733203]}, "properties": {"field_id":"9"}},{"type": "Feature", "geometry": {"type": "Point", "coordinates": [-75.317417,38.75605]}, "properties": {"field_id":"10"}},{"type": "Feature", "geometry": {"type": "Point", "coordinates": [-75.321267,38.837431]}, "properties": {"field_id":"11"}},{"type": "Feature", "geometry": {"type": "Point", "coordinates": [-75.336822,38.876533]}, "properties": {"field_id":"12"}},{"type": "Feature", "geometry": {"type": "Point", "coordinates": [-75.355406,38.856606]}, "properties": {"field_id":"13"}},{"type": "Feature", "geometry": {"type": "Point", "coordinates": [-75.357811,38.937694]}, "properties": {"field_id":"14"}},{"type": "Feature", "geometry": {"type": "Point", "coordinates": [-75.363350,38.859856]}, "properties": {"field_id":"15"}},{"type": "Feature", "geometry": {"type": "Point", "coordinates": [-75.364908,38.908022]}, "properties": {"field_id":"16"}},{"type": "Feature", "geometry": {"type": "Point", "coordinates": [-75.381908,38.870236]}, "properties": {"field_id":"17"}},{"type": "Feature", "geometry": {"type": "Point", "coordinates": [-75.383442,38.913883]}, "properties": {"field_id":"18"}},{"type": "Feature", "geometry": {"type": "Point", "coordinates": [-75.393061,38.919278]}, "properties": {"field_id":"19"}},{"type": "Feature", "geometry": {"type": "Point", "coordinates": [-75.406908,38.861892]}, "properties": {"field_id":"20"}},{"type": "Feature", "geometry": {"type": "Point", "coordinates": [-75.407408,38.868592]}, "properties": {"field_id":"21"}},{"type": "Feature", "geometry": {"type": "Point", "coordinates": [-75.410425,38.874183]}, "properties": {"field_id":"22"}},{"type": "Feature", "geometry": {"type": "Point", "coordinates": [-75.426953,38.850208]}, "properties": {"field_id":"23"}},{"type": "Feature", "geometry": {"type": "Point", "coordinates": [-75.441769,39.003011]}, "properties": {"field_id":"24"}},{"type": "Feature", "geometry": {"type": "Point", "coordinates": [-75.446533,38.972017]}, "properties": {"field_id":"25"}},{"type": "Feature", "geometry": {"type": "Point", "coordinates": [-75.459961,38.958575]}, "properties": {"field_id":"26"}},{"type": "Feature", "geometry": {"type": "Point", "coordinates": [-75.465669,38.933622]}, "properties": {"field_id":"27"}},{"type": "Feature", "geometry": {"type": "Point", "coordinates": [-75.475867,38.970353]}, "properties": {"field_id":"41"}},{"type": "Feature", "geometry": {"type": "Point", "coordinates": [-75.485942,38.935644]}, "properties": {"field_id":"28"}},{"type": "Feature", "geometry": {"type": "Point", "coordinates": [-75.488119,38.922719]}, "properties": {"field_id":"29"}},{"type": "Feature", "geometry": {"type": "Point", "coordinates": [-75.496208,38.970708]}, "properties": {"field_id":"30"}},{"type": "Feature", "geometry": {"type": "Point", "coordinates": [-75.497117,38.939797]}, "properties": {"field_id":"31"}},{"type": "Feature", "geometry": {"type": "Point", "coordinates": [-75.504824,39.039209]}, "properties": {"field_id":"32"}},{"type": "Feature", "geometry": {"type": "Point", "coordinates": [-75.509019,39.043203]}, "properties": {"field_id":"34"}},{"type": "Feature", "geometry": {"type": "Point", "coordinates": [-75.522764,39.002083]}, "properties": {"field_id":"35"}},{"type": "Feature", "geometry": {"type": "Point", "coordinates": [-75.530961,39.017342]}, "properties": {"field_id":"36"}},{"type": "Feature", "geometry": {"type": "Point", "coordinates": [-75.531469,39.006933]}, "properties": {"field_id":"38"}},{"type": "Feature", "geometry": {"type": "Point", "coordinates": [-75.540819,39.029558]}, "properties": {"field_id":"39"}},{"type": "Feature", "geometry": {"type": "Point", "coordinates": [-75.594725,38.586556]}, "properties": {"field_id":"40"}},{"type": "Feature", "geometry": {"type": "Point", "coordinates": [-75.664089,39.285411]}, "properties": {"field_id":"42"}},{"type": "Feature", "geometry": {"type": "Point", "coordinates": [-75.789058,38.707242]}, "properties": {"field_id":"43"}},{"type": "Feature", "geometry": {"type": "Point", "coordinates": [-75.809247,38.692136]}, "properties": {"field_id":"44"}},{"type": "Feature", "geometry": {"type": "Point", "coordinates": [-75.856086,38.615697]}, "properties": {"field_id":"45"}},{"type": "Feature", "geometry": {"type": "Point", "coordinates": [-75.858997,38.602308]}, "properties": {"field_id":"46"}},{"type": "Feature", "geometry": {"type": "Point", "coordinates": [-75.890903,38.592925]}, "properties": {"field_id":"47"}},{"type": "Feature", "geometry": {"type": "Point", "coordinates": [-75.905186,38.740442]}, "properties": {"field_id":"48"}},{"type": "Feature", "geometry": {"type": "Point", "coordinates": [-75.914956,38.771497]}, "properties": {"field_id":"49"}},{"type": "Feature", "geometry": {"type": "Point", "coordinates": [75.946350,38.590911]}, "properties": {"field_id":"50"}} ]};
	lb.layerData.addData(lb.fields);
}

</script>

</html>
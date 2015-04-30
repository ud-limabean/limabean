<?php

App::uses('AppHelper','View/Helper');

class ChartHelper extends AppHelper {
	public $helpers = array('Html');
	
	public function loadChart($data){
		global $arrFindChart;
        foreach ($data as $datum) {
                if (is_array($data) && array_key_exists('value', $data) && array_key_exists('tom', $data)){
                        $average = $data['value'];
                        $month = date('m',strtotime($data['tom']));
			$year = date('Y',strtotime($data['tom']));
			$id = $data['div_field_id'];
                        //$text =  $this->Html->link(__('Goto Field'), array('controller' => 'fields', 'action' => 'view', $id));
                        $arrFindChart[] = '{yearmonth:"' . $year  . '-' . str_pad($month, 2, "0", STR_PAD_LEFT) . '",value:' . $average . '}';
                } elseif(is_array($datum)) {
                        if (array_key_exists('average', $datum) && array_key_exists('month', $datum) && array_key_exists('year', $datum)){
                                $average = $datum['average'];
                        	$month = $datum['month'];
				$year = $datum['year'];
				$id = $datum['div_field_id'];
                                //$text =  $this->Html->link(__('Goto Field'), array('controller' => 'fields', 'action' => 'view', $id));
				$arrFindChart[] = '{yearmonth:"' . $year . '-' . str_pad($month, 2, "0", STR_PAD_LEFT) . '",value:' . $average . "}";
                        }
                        $this->loadChart($datum, $arrFindChart);
                }
        }
        $strLoadChart = 'var lineData = [' . implode(',',array_unique($arrFindChart)) . '];';
        
	$strLoadChart .= 'var margin = {top: 20, right: 20, bottom: 30, left: 50},
    width = 500 - margin.left - margin.right,
    height = 250 - margin.top - margin.bottom;

var parseDate = d3.time.format("%Y-%m").parse;

var x = d3.time.scale()
    .range([0, width]);

var y = d3.scale.linear()
    .range([height, 0]);

var xAxis = d3.svg.axis()
    .scale(x)
    .orient("bottom")
    .ticks(d3.time.month,6);

var yAxis = d3.svg.axis()
    .scale(y)
    .orient("left");

var line = d3.svg.line()
    .x(function(d) { return x(d.yearmonth); })
    .y(function(d) { return y(d.value); });

var svg = d3.select("#chart").append("svg")
    .attr("width", width + margin.left + margin.right)
    .attr("height", height + margin.top + margin.bottom)
  .append("g")
    .attr("transform", "translate(" + margin.left + "," + margin.top + ")");

 lineData.forEach(function(d) {
    d.yearmonth = parseDate(d.yearmonth);
    d.value = +d.value;
});
  x.domain(d3.extent(lineData, function(d) { return d.yearmonth; }));
  y.domain(d3.extent(lineData, function(d) { return d.value; }));

  svg.append("g")
      .attr("class", "x axis")
      .attr("transform", "translate(0," + height + ")")
      .call(xAxis);

  svg.append("g")
      .attr("class", "y axis")
      .call(yAxis)
    .append("text")
      .attr("transform", "rotate(-90)")
      .attr("y", 6)
      .attr("dy", ".71em")
      .style("text-anchor", "end"),
      /*.text("Price ($)");*/

  svg.append("path")
      .datum(lineData)
      .attr("class", "line")
      .attr("d", line);
';
	return $strLoadChart;
	}
}

?>

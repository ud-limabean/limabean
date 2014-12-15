<!-- File: /app/View/Measurements/search.ctp -->

<!-- Data table heading from parameters -->

<div class="params">
	<h4>You have selected the following:</h4>
	<ul>
	<?php print "<li>Field ID: $params[field]</li><li>Parameter: $params[param]</li><li>Date Range: $params[min] to $params[max]</li>"; ?>
	</ul>
 </div>
 
<!-- Begin data div/table -->
<!--
<div class="data">
	<table>
		<thead>
			<?php //echo $this->Html->tableHeaders(array('Date', 'Parameter', 'Value'), null, array('class' => 'highlight','class' => 'sortable')); ?>
		</thead>
		<tbody> -->

<!-- Loop through measurements array from search action -->

<?php 
#foreach ($search as $record){
	//print var_dump ($record['Measurement']);
	#$format = '<tr><td>%s</td><td>%s</td><td>%s</td></tr>';
	#echo sprintf($format, $record['Measurement']['tom'], $record['Measurement']['param'], $record['Measurement']['value']);
	/*if ( strlen($record['Measurement']['value']) > 0 ){
		print "<tr><td>$record[Measurement][date]</td><td>$record[Measurement][param]</td><td>$record[Measurement][value]</td></tr>";
	} else {
		print "<h1>No values were found for this farm ($record[Measurement][field])</h1>";
	}*/
#} ?>

<!-- End data div/table -->
</tbody>
</table>
</div>

<table>
    <tr>
        <th><?php echo $this->Paginator->sort('tom', 'tom'); ?></th>
		<th><?php echo $this->Paginator->sort('param', 'param'); ?></th>
		<th><?php echo $this->Paginator->sort('value', 'value'); ?></th>
    </tr>
       <?php foreach ($data as $Measurement): ?>
    <tr>
        <td><?php echo $Measurement['Measurement']['tom']; ?> </td>
        <td><?php echo $Measurement['Measurement']['param']; ?> </td>
		<td><?php echo $Measurement['Measurement']['value']; ?> </td>
    </tr>
    <?php endforeach; ?>
</table>

<?php unset($search); ?>
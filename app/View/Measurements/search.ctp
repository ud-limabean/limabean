<!-- File: /app/View/Measurements/search.ctp -->
<!--
<h1>measurements</h1>
<table>
    <tr>
        <th>Id</th>
        <th>Geometry</th>
    </tr>
-->
	
    <!-- Here is where we loop through our $measurements array, printing out place info -->

    <?php foreach ($search as $record): ?>
	<?php var_dump($record); ?>
    <?php endforeach; ?>
    <?php unset($search); ?>
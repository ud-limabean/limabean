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

    <?php //foreach ($measurements as $measurement): ?>
    <?php echo $search; ?>
    <?php //endforeach; ?>
    <?php unset($search); ?>
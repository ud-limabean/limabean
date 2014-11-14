<!-- File: /app/View/Places/index.ctp -->

<h1>Places</h1>
<table>
    <tr>
        <th>Id</th>
        <th>Geometry</th>
    </tr>

    <!-- Here is where we loop through our $places array, printing out place info -->

    <?php foreach ($places as $place): ?>
    <tr>
        <td><?php echo $place['Place']['field_id']; ?></td>
        <td>
            <?php echo $this->Html->link($place['Place']['geometry'],
array('controller' => 'places', 'action' => 'view', $place['Place']['field_id'])); ?>
        </td>
    </tr>
    <?php endforeach; ?>
    <?php unset($place); ?>
</table>
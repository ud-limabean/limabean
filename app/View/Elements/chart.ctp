<?php
//** global 
$arrFindChart = array();

//** css
$this->Html->css('d3', array('inline' => false));

$this->Html->script('http://d3js.org/d3.v3.js', array('inline' => false));
?>

<?php echo $this->Session->flash(); ?>

<div id="chart" width="500" height="250"></svg>

<script type="text/javascript">
var lb = lb || {};
lb.map = {};

// fires after DOM ready
$(function() {

//call the helper
<?php
echo $this->Chart->loadChart($data);
?>
});
</script>

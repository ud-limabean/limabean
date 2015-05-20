<?php
/**
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Pages
 * @since         CakePHP(tm) v 0.10.0.1076
 */

if (!Configure::read('debug')):
	throw new NotFoundException();
endif;

App::uses('Debugger', 'Utility');
$this->Html->css('limabean');
?>
<div id="content">
<div>
<h2><?php echo 'USDA Lima Bean Data Interface' ?></h2>
<p>Welcome to the Limabean Data Interface.  This web application provides access to data from the USDA-funded 
	<?php echo $this->Html->link('Lima Bean Project', 'http://sites.udel.edu/limabean'); ?>
</p>
</div>
<div>
<p>If you have already have an account,  <?php echo $this->Html->link('login here',array('controller'=>'users','action'=>'login')); ?></p>
</div>
<div class="preview">
<?php echo $this->Html->image('previewImage.PNG',array('alt'=>'Preview','class'=>'preview','url'=>array('controller'=>'users','action'=>'login'))); ?>
<div>The  Limabean Data Interface</div>
</div>
</div>

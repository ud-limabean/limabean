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

$cakeDescription = __d('cake_dev', 'CakePHP: the rapid development php framework');
$cakeVersion = __d('cake_dev', 'CakePHP %s', Configure::version())
?>
<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		The Better Bean Project
		<?php //echo $cakeDescription ?>
		<?php //echo $this->fetch('title'); ?>
	</title>
	<?php
		//echo $this->Html->meta('icon');

		echo $this->Html->css('cake.generic');

		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->Html->css('http://bradfrost.github.com/this-is-responsive/styles.css');
		echo $this->Html->css('data.css');
		echo '<link rel="stylesheet" type="text/css" href="http://cdn.leafletjs.com/leaflet-0.7.2/leaflet.css" />';
		echo $this->fetch('script');
		echo $this->Html->script('jquery-1.10.2.js');
		echo $this->Html->script('jquery-ui-1.10.4.custom.min.js');
		echo '<script type="text/javascript"  src="http://cdn.leafletjs.com/leaflet-0.7.2/leaflet.js"></script>';
		echo '<script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/json2/20140204/json2.min.js"></script>';
	?>
</head>
<body>
	<div id="container">
	
		<div id="header">
			<?php //echo $this->Html->link($cakeDescription, 'http://cakephp.org'); ?>
			<?php echo $this->fetch('title') . ' test'; ?>
			<div style="text-align:right;">
				<?php if($logged_in): ?>
				Welcome <?php echo $current_user['username']; ?>.
				<?php echo $this->Html->link('Home',array('controller'=>'users','action'=>'view'));?>
				<?php echo $this->Html->link('Logout',array('controller'=>'users','action'=>'logout')); ?>
				<?php else: ?>
						 <?php echo $this->Html->link('Login',array('controller'=>'users','action'=>'login')); ?>
				<?php endif; ?>
			</div>

				<?php echo $this->Session->flash(); ?>
				<?php echo $this->Session->flash('auth'); ?>
		</header>
		
		<div id="content">
			<div class="col-group">
				<div>
				         <p><?php echo $this->fetch('col1'); ?></p>
                                </div>
                                <div>
                                        <h2><?php echo $this->fetch('subtitle'); ?></h2>
                                        <p><?php echo $this->fetch('col2'); ?></p>
                                </div>
                        </div>
                        <div>
                                <p><?php echo $this->fetch('data'); ?></p>
                        </div>

		</div>
		
		<div id="footer">
			 <?php echo $this->Html->link(
							$this->Html->image('cake.power.gif', array('alt' => $cakeDescription, 'border' => '0')),
							'http://www.cakephp.org/',
							array('target' => '_blank', 'escape' => false, 'id' => 'cake-powered')
					);
			?>
			<p>
					<?php echo $cakeVersion; ?>
			</p>
		</div>
		
	</div>
</body>
</html>

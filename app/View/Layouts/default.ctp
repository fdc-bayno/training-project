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
		<?php echo $cakeDescription ?>:
		<?php echo $this->fetch('title'); ?>
	</title>
	<?php
		echo $this->Html->meta('icon');

		echo $this->Html->css('cake.generic');

		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
		echo $this->Html->css('https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css');
		echo $this->Html->css('//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css');
		echo $this->Html->css('https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css');
		echo $this->Html->css('main.css');

		echo $this->Html->script('https://code.jquery.com/jquery-1.12.4.js');
		echo $this->Html->script('https://code.jquery.com/ui/1.12.1/jquery-ui.js');
		echo $this->Html->script('https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js');
	?>
</head>
<body>
	<nav class="navbar navbar-default">
		<div class="container">
			<div class="navbar-header">
				<a class="navbar-brand" href="#">Message Board</a>
			</div>
			<?php if ($this->Session->read('Auth.User')) : ?>
				<ul class="nav navbar-nav">
					<li>
						<?php 
							echo $this->Html->link(
								'Profile',
								array('controller' => 'users', 'action' => 'profile')
							); 
						?>
					</li>
					<li>
						<?php 
							echo $this->Html->link(
								'Messages',
								array('controller' => 'messages', 'action' => 'messageList')
							); 
						?>
					</li>
				</ul>
			<?php endif; ?>
			<ul class="nav navbar-nav navbar-right">
				<?php if ($this->Session->read('Auth.User')) : ?>
					<li>
						<?php echo $this->Html->link(AuthComponent::user('name'), array('class' => 'auth-name')); ?>
					</li>
					<li class="logout">
						<?php 
							echo $this->Html->link(
								'Logout',
								array('controller' => 'users', 'action' => 'logout'),
								array('class' => 'btn btn-danger btn-sm btn-logout text-white')
							); 
						?>
					</li>
				<?php else : ?>
					<li>
						<?php echo $this->Html->link('Register', array('action' => 'register')); ?>
					</li>
					<li>
						<?php echo $this->Html->link('Login', array('action' => 'login')); ?>
					</li>
				<?php endif; ?>
			</ul>
		</div>
	</nav>
	<?php echo $this->fetch('content'); ?>
	<?php echo $this->element('sql_dump'); ?>
</body>
</html>

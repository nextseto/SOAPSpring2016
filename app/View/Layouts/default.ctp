<?php
/**
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2011, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2011, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       Cake.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

$cakeDescription = __d('cake_dev', 'CakePHP: the rapid development php framework');
?>
<!-- This file was edited in the Fall 2014 Semester of CSC 415 (Software Engineering) for the Blogging in the Deep Group -->

<!DOCTYPE html> <!-- This shows that this site is HTML5 based. -->
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:fb="http://ogp.me/ns/fb#">

<!-- <?php echo $this->Facebook->html(); ?> This line keeps messing up the FORMAT (or CSS) of our site! -->
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		TCNJ SOAP | <?php echo $title_for_layout; ?>
	</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<?php
		//The following below are used to link to css files located at app/webroot/css/
		echo $this->Html->meta('icon');
		echo $this->fetch('meta');

		echo $this->Html->css('bootstrap.min');
		echo $this->Html->css('bootstrap-responsive');
		echo $this->Html->css('blog');
		echo $this->fetch('css');


		echo $this->Html->script('http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js');
		echo $this->Html->script('bootstrap-dropdown');
		echo $this->Html->script('bootstrap-collapse');
		echo $this->Html->script('bootstrap-modal');
		echo $this->Html->script('bootstrap-transition');
		echo $this->Html->script('bootstrap-alert');
		echo $this->fetch('script');
	?>
	
	<style type='text/css'>
        .social {
            font-family: 'JustVector';
        }
    </style>

</head>
<body>
	<?php echo $this->element('nav'); ?>	
	<?php echo $this->element('signinModal'); ?>
	<div class="wrapper">
			<div class="row">
				<?php echo $this->fetch('content'); ?>	
				<?php echo $this->Session->flash(); ?>	<!-- Used for success or error messages (ex. file upload)  -->
			</div>
			<!-- <div class="push"></div> -->
	</div>
    	<?php echo $this->element('footer'); ?>
</body>
<?php echo $this->Html->css('stylesheet'); ?>  <!-- Used for Facebook/Twitter logos in footer. -->

<!--
<script language='javascript' src='http://twitter.github.com/bootstrap/assets/js/bootstrap-dropdown.js'></script>
<script language='javascript' src='http://twitter.github.com/bootstrap/assets/js/bootstrap-collapse.js'></script>
<script language='javascript' src='http://twitter.github.com/bootstrap/assets/js/bootstrap-modal.js'></script>
-->

<?php echo $this->Facebook->init(); ?> 
</html>

<!DOCTYPE html>
<!-- paulirish.com/2008/conditional-stylesheets-vs-css-hacks-answer-neither/ -->
<!--[if lt IE 7 ]> <html class="no-js ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]> <html class="no-js ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]> <html class="no-js ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<?php
// get current menu name
$menu = JSite::getMenu();
if ($menu && $menu->getActive())
    $menu = $menu->getActive()->alias;
else
	$menu = "";

if ($_SERVER['SERVER_PORT'] === 8888 ||
		$_SERVER['SERVER_ADDR'] === '127.0.0.1' ||
		stripos($_SERVER['SERVER_NAME'], 'ccistaging') !== false ||
		stripos($_SERVER['SERVER_NAME'], 'dev') === 0) {

	$testing = true;
	error_reporting(E_ALL);
	ini_set('display_errors', '1');
} else {
	$testing = false;
}

$analytics = "UA-XXXXX-X"; // FIXME Update to client ID
JHtml::_('behavior.framework', true);
?>

<head>
	<meta charset="utf-8" />
	<?= ($testing)? '':  '<meta http-equiv="X-UA-Compatible" contents="IE=edge,chrome=1">' ?>

 	<jdoc:include type="head" />

	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="shortcut icon" href="/templates/<?= $this->template ?>/resources/favicon.ico">
	<link rel="apple-touch-icon" href="/templates/<?= $this->template ?>/resources/apple-touch-icon.png">

	<!-- load css -->
	<?php if ($testing): ?>
		<link rel="stylesheet" href="/templates/<?= $this->template ?>/css/template.css">
	<?php else: ?>
		<link rel="stylesheet" href="/templates/<?= $this->template ?>/css/template.min.css">
	<?php endif; ?>

	<!-- load modernizer, all other at bottom -->
	<?php if ($testing): ?>
		<script src="/templates/<?= $this->template ?>/js/libs/modernizr-1.7.js"></script>
	<?php else: ?>
		<script src="/templates/<?= $this->template ?>/js/libs/modernizr-1.7.min.js"></script>
	<?php endif; ?>
</head>

<body class="<?= $menu ?>">

	<div class="wrapper">
		<div id="header">
			<jdoc:include type="modules" name="header" style="xhtml" />
			<div class="clear"></div>
		</div>
	
		<?php if ($this->countModules('masthead')): ?>
		<div id="masthead">
			<jdoc:include type="modules" name="masthead" style="xhtml" />
		</div>
		<?php endif; ?>

		<div id="body">
			<?php if ($this->countModules('leftSidebar')): ?>

			<div id="leftSidebar">
				<jdoc:include type="modules" name="leftSidebar" style="xhtml" />
			</div>
			<?php endif; ?>
			
			<div id="content" class="<?php 
				if ($this->countModules('leftSidebar') && $this->countModules('rightSidebar')) {
					echo 'normal';
				} else {
					if (!$this->countModules('leftSidebar') && !$this->countModules('rightSidebar')) {
						echo 'wide3';
					} elseif (!$this->countModules('leftSidebar')) {
						echo 'wide1';
					} else {
						echo 'wide2';
					}
				}
			?>">
				<jdoc:include type="component" />	
			</div>
			<?php if ($this->countModules('rightSidebar')): ?>
			<div id="rightSidebar">
				<jdoc:include type="modules" name="rightSidebar" style="xhtml" />
			</div>
			<?php endif; ?>
			<div class="clear"></div>
		</div>

	
		<div id="bottom">
			<jdoc:include type="modules" name="bottom1" style="xhtml" />
			<jdoc:include type="modules" name="bottom2" style="xhtml" />
		</div>
	
		<div id="footer">
				<jdoc:include type="modules" name="footer" style="xhtml" />
		</div>
	</div>

	<div class="hidden">
		<jdoc:include type="modules" name="hidden" style="raw" />
	</div>

	<!-- load scripts -->
	<?php if ($testing): ?>
		<script src="/templates/<?= $this->template ?>/js/columns.js"></script>
		<script src="/templates/<?= $this->template ?>/js/dropmenu.js"></script>
		<script src="/templates/<?= $this->template ?>/js/html5.js"></script>
		<script src="/templates/<?= $this->template ?>/js/submenu.js"></script>
	<?php else: ?>
		<script>
			var _gaq=[["_setAccount","<?php echo $analytics?>"],["_trackPageview"]];
			(function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];g.async=1;
				g.src=("https:"==location.protocol?"//ssl":"//www")+".google-analytics.com/ga.js";
				s.parentNode.insertBefore(g,s)}(document,"script"));
	  	</script>
		<script src="/templates/<?= $this->template ?>/js/scripts.min.js"></script>
	<?php endif; ?>
</body>
</html>

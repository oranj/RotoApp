<?php
namespace Roto;

?>
<!DOCTYPE html>
<!--
<?= Widget::RouteInfo(array(
	'trace' => Service::Router()->routingData()
))->render(); ?>
-->
<html>
	<head>
		<link href="/css/main.css" rel="stylesheet" />
		<title><?= $View->title ?></title>
	</head>
	<body class="workDesk">
		<main>
			<?= $View->main() ?>
		</main>
		<footer>
			<?= $View->footer ?>
		</footer>
	</body>
</html>
<?php

require_once "utils/autoload.php";
require_once "config/config.php";
require_once "controllers/userController.php";
require_once "controllers/twitterController.php";
require_once "class/alertes.php";

if( isset($_GET['page'])
	&& isset($_SESSION['utilisateurCourant']) 
	&& !empty($_SESSION['utilisateurCourant'])) {
	$page = $_GET['page'];
}
else {

	$page = "connexion";
}

?>


<!doctype html>
<html lang="fr">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<title>Projet PHP</title>
	<?php
		require_once "public/css/css.php";
	?>
</head>
<body>

<?php
	if($page!="connexion")
	{
		require_once "views/navigation.php";
	}

	if(in_array($page, $authorized_pages))
	{

		require_once "views/$page.php";
	}
	else
	{

		require_once "views/404.php";
	}

	require_once "public/js/js.php";
?>

</body>
</html>
<?php session_start(); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	
	<link rel="stylesheet" href="https://www.phptutorial.net/app/css/style.css">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
	<link rel="stylesheet" href="https://mdbcdn.b-cdn.net/wp-content/themes/mdbootstrap4/docs-app/css/dist/mdb5/standard/core.min.css">
	<link rel="stylesheet" id="roboto-subset.css-css" href="https://mdbcdn.b-cdn.net/wp-content/themes/mdbootstrap4/docs-app/css/mdb5/fonts/roboto-subset.css?ver=3.9.0-update.5" type="text/css" media="all">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css"/>
	<link rel="stylesheet" href="/style.css?rnd=31">
	<title>Home Page</title>
</head>
<body>
<?php
	const root = "/var/www/html";
	// head
	require root . '/Core/database.php';
    require root . '/Models/BaseModel.php';
    require root . '/Controllers/BaseController.php';

	require root . "/Core/vendor/phpmailer/phpmailer/src/PHPMailer.php";
    require root . "/Core/vendor/phpmailer/phpmailer/src/SMTP.php";
    require root . "/Core/vendor/phpmailer/phpmailer/src/Exception.php";

	require root . "/Core/vendor/autoload.php";

    $controllerName = ucfirst(strtolower(($_REQUEST['controller'] ?? 'Home')) . 'Controller'); // ucfirst viết hoa chữ cái đầu tiên
    $actionName = $_REQUEST['action'] ?? 'index';
    require "./Controllers/$controllerName.php";

    $controllerObject = new $controllerName;

    $controllerObject -> $actionName();

	require root . '/Views/frontend/linkJS.php';
?>
	
</body>
</html>
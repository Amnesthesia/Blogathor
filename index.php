<?php
// The name of the website
$page_name = "Blogathor";

// Set default timezone (because going aaaaall the way to php.ini is so far away)
date_default_timezone_set('GMT');
// Start the session
session_start(); 

ini_set('display_errors', 'On');
error_reporting(E_ALL);
require_once("application/database.php");
require_once("controllers/controller.php");

// Include all custom controllers (named CLASS.controller.php) and models.
// Also specify directories for stylesheets, images and javascripts
$controller_dir = 'controllers/';
$models_dir = 'models/';
$stylesheets_dir = 'assets/stylesheets/';
$javascript_dir = 'assets/javascript/';


// Remove the . and .. if possible
$controllers = array_diff(scandir($controller_dir), array('..', '.'));
$models = array_diff(scandir($models_dir),array('..','.'));
$stylesheets = array_diff(scandir($stylesheets_dir),array('..','.'));
$javascripts = array_diff(scandir($javascript_dir),array('..','.'));

// Iterate twice -- first, for models.
foreach($models as $m)
{
	if(strstr($m,".model.php"))
		require_once($models_dir . $m);
}

// Check for session user_id, and if it exists, spawn a user object from this, otherwise create a guest user object
if(!isset($_SESSION["user_id"]))
{
	$user = new User();
	$user->setUsername("Guest");
	$user->setFirstName("Anonymous");
	$user->setLastName("Visitor");
	$user->setRole("3");
}
else {
	$user = new User((int) $_SESSION["user_id"]);
}


// Now, for controllers
foreach($controllers as $c)
{
	// If the file contains _controller.php and there's a class (model) named what's before .controller.php,
	// we'll require it. Once.
	if(class_exists(ucfirst(strstr($c,".controller.php",true))))
		require_once($controller_dir . $c);
}

$base_controller = new Controller;

// Gets the name of the view (which will be included in container.php)
$view_name = $base_controller->getView();

// An array of parameters the view can use to display its information (we use views as templates; they are not classes)
$parameters = $base_controller->getViewParameters();


// Process all javascripts and CSS for the application and insert these on the page
require_once("application/head.php");

// Render the header
require_once("views/layouts/header.php");

// Render the content area (the views will be displayed within container.php)
require_once("views/layouts/container.php");

// Render the footer
require_once("views/layouts/footer.php");
?>
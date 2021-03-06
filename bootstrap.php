<?php
	// bootstrap.php
	use Doctrine\ORM\Tools\Setup;
	use Doctrine\ORM\EntityManager;

	require_once "vendor/autoload.php";

	// Create a simple "default" Doctrine ORM configuration for Annotations
	$isDevMode = true;
	$config = Setup::createAnnotationMetadataConfiguration(array(__DIR__."/src"), $isDevMode);
	// or if you prefer yaml or XML
	//$config = Setup::createXMLMetadataConfiguration(array(__DIR__."/config/xml"), $isDevMode);
	//$config = Setup::createYAMLMetadataConfiguration(array(__DIR__."/config/yaml"), $isDevMode);

	// database configuration parameters
	$conn = array(
		'dbname' => 'gestioneleve',
		'host' => 'localhost',
		'user' => 'root',
		'password' => 'root',
		'driver' => 'pdo_mysql',
		'charset' => 'utf8',
	);

	// obtaining the entity manager
	$em = EntityManager::create($conn, $config);
?>
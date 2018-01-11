<?php

require_once( 'App.php' );
require_once( 'Request.php' );
require_once( 'Controller.php' );

$app = new App();

$app->getRequests( new Request );
$app->processRequest( new Controller );
$app->sendResponse();

?>
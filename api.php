<?php
	require "web applications/CrimeAPI/CrimeDataRestService.php";

	// All requests to the web service are routed through this script.
	// See the explanation in RestService.php for how the requests are 
	// mapped. 

	$service = new CrimeDataRestService();

	$service->handleRawRequest();
?>

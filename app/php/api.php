<?php
	require __DIR__ . "/vendor/autoload.php";

	use App\Services\RestApi;


	$api = new RestApi($_REQUEST);
	echo $api->Response();
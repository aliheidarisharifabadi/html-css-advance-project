<?php

/**
 * @param bool $createTable
 */
function setConfigPoolPort(bool $createTable = false)
{

	config([
		'poolport.database.host'          => env('DB_HOST'),
		'poolport.database.http.dbname'   => env('DB_DATABASE'),
		'poolport.database.http.username' => env('DB_USERNAME'),
		'poolport.database.http.password' => env('DB_PASSWORD'),
		'poolport.database.http.create'   => $createTable,
	]);

}
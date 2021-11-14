<?php

/**
 * @param string|NULL $serverKey
 * @param string|NULL $senderId
 * @param string|NULL $driver
 */
function setConfigFcm(string $serverKey = NULL, string $senderId = NULL, string $driver = NULL){

	config([
		'fcm.driver'          => $driver ?? \App\Models\Common\Option::get('fcm_protocol'),
		'fcm.http.server_key' => $serverKey ?? \App\Models\Common\Option::get('fcm_server_key'),
		'fcm.http.sender_id'  => $senderId ?? \App\Models\Common\Option::get('fcm_sender_id'),
	]);

}
<?php
return array(

	//-------------------------------
	// Timezone for insert dates in database
	// If you want PoolPort not set timezone, just leave it empty
	//--------------------------------
	'timezone'  => 'Asia/Tehran',

	//--------------------------------
	// Soap configuration
	//--------------------------------
	'soap'      => array(
		'attempts' => 2 // Attempts if soap connection is fail
	),

	//--------------------------------
	// Database configuration
	//--------------------------------
	'database'  => array(
		'host'     => env('DB_HOST', '127.0.0.1'),
		'dbname'   => env('DB_DATABASE', 'setdb'),
		'username' => env('DB_USERNAME', 'setdb'),
		'password' => env('DB_PASSWORD', 'aHxkTcb4qX5D8G59HmnN'),
		'create'   => false             // For first time you must set this to true for create tables in database
	),

	//--------------------------------
	// Zarinpal gateway
	//--------------------------------
	'zarinpal'  => array(
		'merchant-id'  => 'xxxxxxxx-xxxx-xxxx-xxxx-xxxxxxxxxxxx',
		'type'         => 'zarin-gate',                           // Types: [zarin-gate || normal]
		'callback-url' => 'http://www.example.org/result',
		'server'       => 'germany',                              // Servers: [germany || iran]
		'email'        => 'email@gmail.com',
		'mobile'       => '09xxxxxxxxx',
		'description'  => 'description',
	),

	//--------------------------------
	// Mellat gateway
	//--------------------------------
	'mellat'    => array(
		'username'     => '',
		'password'     => '',
		'terminalId'   => 0000000,
		'callback-url' => 'http://www.example.org/result',
	),

	//--------------------------------
	// Payline gateway
	//--------------------------------
	'payline'   => array(
		'api'          => 'xxxxx-xxxxx-xxxxx-xxxxx-xxxxxxxxxxxxxxxxxxxxxxxxxxxx',
		'callback-url' => 'http://www.example.org/result',
	),

	//--------------------------------
	// Sadad gateway
	//--------------------------------
	'sadad'     => array(
		'merchant'       => '',
		'transactionKey' => '',
		'terminalId'     => 000000000,
		'callback-url'   => 'http://example.org/result',
	),

	//--------------------------------
	// JahanPay gateway
	//--------------------------------
	'jahanpay'  => array(
		'api'          => 'xxxxxxxxxxx',
		'callback-url' => 'http://example.org/result',
	),

	//--------------------------------
	// Parsian gateway
	//--------------------------------
	'parsian'   => array(
		'pin'          => 'xxxxxxxxxxxxxxxxxxxx',
		'callback-url' => 'http://example.org/result',
	),

	//--------------------------------
	// Pasargad gateway
	//--------------------------------
	'pasargad'  => array(
		'merchant-code' => '9999999',
		'terminal-code' => '999999',
		'callback-url'  => 'http://example.org/result',
	),

	//--------------------------------
	// Saderat gateway
	//--------------------------------
	'saderat'   => array(
		'merchant-id'  => '999999999999999',
		'terminal-id'  => '99999999',
		'public-key'   => __DIR__ . '/saderat-public-key.pem',
		'private-key'  => __DIR__ . '/saderat-private-key.pem',
		'callback-url' => 'http://example.org/result',
	),

	//--------------------------------
	// IranKish gateway
	//--------------------------------
	'irankish'  => array(
		'merchant-id'  => 'xxxx',
		'sha1-key'     => 'xxxxxxxxxxxxxxxxxxxx',
		'description'  => 'description',
		'callback-url' => 'http://example.org/result',
	),

	//--------------------------------
	// Simulator gateway
	//--------------------------------
	'simulator' => array(
		'callback-url' => 'http://example.org/result',
	),

	//--------------------------------
	// Saman gateway
	//--------------------------------
	'saman'     => array(
		'merchant-id'       => '10909567',
		'merchant-pass'     => '5121122',
		'callback-url'      => 'https://set.toranj-store.ir/payment/callback/sale_point',
		'token-url'         => 'https://pay.toranj-store.com/api/payment/token',
		'verify-url'        => 'https://pay.toranj-store.com/api/payment/verify',
		'reverse-url'       => 'https://pay.toranj-store.com/api/payment/reverse',
		'init-url'          => 'https://sep.shaparak.ir/payments/initpayment.asmx?wsdl',
		'redirect-url'      => 'https://sep.shaparak.ir/payment.aspx?wsdl',
		'server-verify-url' => 'https://sep.shaparak.ir/payments/referencepayment.asmx?wsdl',
	),

	// Pay gateway
	//--------------------------------
	'pay'       => array(
		'api'          => 'ad17e5bf1f0d91ec687b7c8bbe29de59',
		'callback-url' => env('PY_CALLBACK_URL'),
	),

	// JiBit gateway
	//--------------------------------
	'jibit'     => array(
		'merchant-id'  => '7892',
		'password'     => 'vU9tKtxRkupE9ZMg',
		'callback-url' => env('APP_URL') . ':8000/api/v1/payment/callbackSalePoint',
		'user-mobile'  => '09196805049',
	),
);
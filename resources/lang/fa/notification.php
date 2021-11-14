<?php

return [
	'order' => [
		'submit' => [
			'title' => 'ثبت فاکتور جدید',
			'body' => ':count سفارش جدید ثبت شده است',
		],
		'cancel' => [
			'title' => 'لغو فاکتور',
			'body' => 'فاکتور به شماره :number لغو گردید ',
		],
		'status' => [
			'visitor' => [
				'title' => rtrim(trans('models.order.:status'), 'ه'),
				'body' => 'فاکتور شماره :number توسط ویزیتور :statusTitle شد',
			],
			'customer' => [
				'title' => 'تایید تحویل',
				'body' => 'خریدار تحویل فاکتور به شماره :number را تایید کرد ',
			],

		]
	]
];
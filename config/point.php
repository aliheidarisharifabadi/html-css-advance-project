<?php

return [

	'refer' => [

		'order' => [
			'submit'        => +10,
			'submitEvent'   => 'refer.order.submit',
			'canceled'      => -10,
			'canceledType'  => 'activity',
			'canceledEvent' => 'refer.order.canceled',
		],

	],

	'customer' => [

		'auth' => [
			'register'       => +5000,
			'registerExpire' => 660,
			'registerEvent'  => 'customer.auth.register',
			'refer'          => +2000,
			'referExpire'    => 330,
			'referEvent'     => 'customer.auth.refer',
			'set'            => +2000,
			'setExpire'      => 330,
			'setEvent'       => 'customer.auth.set',
			'unSet'          => -100,
			'unSetEvent'     => 'customer.auth.unSet',
		],

		'order' => [
			'submit'        => +100,
			'submitEvent'   => 'customer.order.submit',
			'status'        => [
				'delivered'      => +100,
				'deliveredEvent' => 'customer.order.status.delivered',
			],
			'canceled'      => -100,
			'canceledType'  => 'activity',
			'canceledEvent' => 'customer.order.canceled',
		],

	],

	'visitor' => [

		'auth' => [
			'register'       => +5000,
			'registerExpire' => 660,
			'registerEvent'  => 'visitor.auth.register',
			'refer'          => +2000,
			'referExpire'    => 330,
			'referEvent'     => 'visitor.auth.refer',
			'set'            => +2000,
			'setExpire'      => 330,
			'setEvent'       => 'visitor.auth.set',
			'unSet'          => -2000,
			'unSetEvent'     => 'visitor.auth.unSet',
		],

		'order' => [
			'seen'          => -1000,
			'seenEvent'     => 'visitor.order.seen',
			'submit'        => +100,
			'submitEvent'   => 'visitor.order.submit',
			'status'        => [
				'delivered'      => +100,
				'deliveredEvent' => 'visitor.order.status.delivered',
			],
			'canceled'      => -100,
			'canceledType'  => 'activity',
			'canceledEvent' => 'visitor.order.canceled',
		],

	],

];

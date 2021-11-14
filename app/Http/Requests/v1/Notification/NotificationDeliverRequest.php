<?php

namespace App\Http\Requests\v1\Notification;

use App\Http\Requests\SetRequest;
use App\Models\Notification\Notification;

/**
 * Class NotificationDeliverRequest
 *
 * @package App\Http\Requests\v1\Order
 *
 * @property integer $notification_id
 */
class NotificationDeliverRequest extends SetRequest
{
	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return auth()->user()->can('notification.deliver', Notification::class);
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
			'notification_id' => 'required|integer|exists:notifications,id',
		];
	}
}


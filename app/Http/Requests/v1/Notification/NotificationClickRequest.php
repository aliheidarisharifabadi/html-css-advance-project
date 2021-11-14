<?php

namespace App\Http\Requests\v1\Notification;

use App\Http\Requests\SetRequest;
use App\Models\Notification\Notification;

/**
 * Class NotificationClickRequest
 *
 * @package App\Http\Requests\v1\Order
 *
 * @property integer $notification_id
 */
class NotificationClickRequest extends SetRequest
{
	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return auth()->user()->can('notification.click', Notification::class);
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


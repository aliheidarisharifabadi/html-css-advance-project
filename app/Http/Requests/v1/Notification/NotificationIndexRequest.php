<?php

namespace App\Http\Requests\v1\Notification;

use App\Http\Requests\SetRequest;
use App\Models\Notification\Notification;

/**
 * Class NotificationIndexRequest
 *
 * @package App\Http\Requests\v1\Order
 *
 * @property integer $user_id
 */
class NotificationIndexRequest extends SetRequest
{
	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return auth()->user()->can('notification.index', Notification::class);
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
			'user_id' => 'sometimes|integer|exists:users,id',
		];
	}
}


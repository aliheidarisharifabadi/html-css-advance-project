<?php

namespace App\Http\Requests\Admin\Notification;

use App\Models\Notification\Notification;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Class AdminNotificationKeyStoreRequest
 *
 * @package App\Http\Requests\Admin\Notification
 *
 * @property string $key
 * @property string $status
 */
class AdminNotificationKeyStoreRequest extends FormRequest
{
	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return true;
		return auth()->user()->can('notification.keyStore', Notification::class);
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
			'key'    => 'required|string|min:3|unique:notif_items,key',
			'status' => 'sometimes',
		];
	}
}

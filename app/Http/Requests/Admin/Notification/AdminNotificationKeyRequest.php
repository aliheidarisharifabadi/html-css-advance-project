<?php

namespace App\Http\Requests\Admin\Notification;

use App\Models\Notification\Notification;
use Illuminate\Foundation\Http\FormRequest;

class AdminNotificationKeyRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
		return true;
		return auth()->user()->can('notification.key', Notification::class);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
        ];
    }
}

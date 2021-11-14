<?php

namespace App\Http\Resources\v1\Notification;

use App\Http\Resources\SetResource;
use App\Models\Notification\Notification;

/**
 * Class NotificationIndexResource
 *
 * @package App\Http\Resources\api\v1\Order
 *
 * @mixin Notification
 */
class NotificationIndexResource extends SetResource
{
	/** @var string $model */
	protected $model = Notification::class;

	/**
	 * Transform the resource into an array.
	 *
	 * @return array
	 */
	public function toArray($request)
	{
		return [
			'id'            => $this->id,
			'type'          => $this->type,
			'click_count'   => $this->click_count,
			'deliver_count' => $this->deliver_count,
			'status'        => $this->status,
			'title'         => $this->title,
			'body'          => $this->body,
			'image_url'     => $this->image_url,
			'sound_url'     => $this->sound_url,
			'icon_url'      => $this->icon_url,
			'ongoing'       => $this->ongoing,
			'data'          => $this->data,
		];
	}
}

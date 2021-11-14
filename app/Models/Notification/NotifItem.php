<?php

namespace App\Models\Notification;

use App\Traits\JCreatedAt;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Notification
 *
 * @package App\Models\Notification
 *
 * @property integer            $id
 * @property string             $type
 * @property string             $key
 * @property boolean            $status
 * @property Carbon             $created_at
 *
 * @property NotificationItem[] $notificationItems
 */
class NotifItem extends Model
{
	use JCreatedAt;

	protected $fillable = [
		'type',
		'key',
		'status',
	];

	public const UPDATED_AT = NULL;

	protected $dates = [
		'created_at',
	];

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function notificationItems()
	{
		return $this->hasMany(NotificationItem::class, 'item_id');
	}

}

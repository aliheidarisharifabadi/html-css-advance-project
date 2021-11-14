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
 * @property integer      $id
 * @property integer      $notification_id
 * @property integer      $item_id
 * @property string       $value
 * @property Carbon       $created_at
 *
 * @property Notification $notification
 * @property NotifItem    $notifItem
 *
 */
class NotificationItem extends Model
{
	use JCreatedAt;

	protected $fillable = [
		'notification_id',
		'item_id',
		'value',
	];

	public const UPDATED_AT = NULL;

	protected $dates = [
		'created_at',
	];

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function notification()
	{
		return $this->belongsTo(Notification::class);
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function notifItem()
	{
		return $this->belongsTo(NotifItem::class);
	}

}

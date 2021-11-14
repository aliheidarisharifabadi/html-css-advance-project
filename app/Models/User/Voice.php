<?php

namespace App\Models\User;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Voice
 *
 * @package App\Models\Common
 * @property integer $id
 * @property integer $user_id
 * @property string  $message
 * @property string  $phone
 * @property boolean $status
 * @property Carbon  $created_at
 * @property Carbon  $updated_at
 *
 * @property User    $User
 */
class Voice extends Model
{
	protected $fillable = [
		'user_id',
		'phone',
		'message',
		'status',
	];

	protected $dates = [
		'created_at',
		'updated_at',
	];

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function user()
	{
		return $this->belongsTo(User::class);
	}
}

<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Model;

/**
 * Class SMS
 *
 * @package App\Models\User
 *
 * @property integer $id
 * @property integer $user_id
 * @property string  $phone
 * @property string  $message
 * @property boolean $status
 *
 * @property User    $user
 *
 */
class SMS extends Model
{
	protected $table = 'sms';

	protected $fillable = [
		'user_id',
		'phone',
		'message',
		'status',
	];

	public const UPDATED_AT = NULL;

	protected $dates = [
		'created_at'
	];

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function user()
	{
		return $this->belongsTo(User::class);
	}

	/**
	 * Save SMS and Send verify code by SMSObserver
	 *
	 * @param      $message
	 * @param      $phone
	 * @param null $user_id
	 * @return SMS
	 */
	public static function store($message, $phone, $user_id = NULL)
	{
		return SMS::create([
			'user_id'       => $user_id,
			'phone'         => $phone,
			'message'       => $message,
		]);
	}

}

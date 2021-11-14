<?php

namespace App\Models\User;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Code
 *
 * @package App\Models\User
 * @property integer $id
 * @property integer $user_id
 * @property string  $phone
 * @property string  $code
 * @property string  $type
 * @property boolean $status
 * @property Carbon  $created_at
 * @property Carbon  $updated_at
 *
 * @property User    $user
 *
 */
class Code extends Model
{
	const TYPE_LOGIN = 'login';
	const TYPE_REGISTER = 'register';
	const TYPE_NOT_SET = 'not-set';

	const TYPES = [
		self::TYPE_LOGIN,
		self::TYPE_REGISTER,
	];

	protected $fillable = [
		'user_id',
		'phone',
		'code',
		'type',
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

	/**
	 * generate verify code
	 *
	 * @return int
	 */
	public static function generateVerifyCode()
	{
		return mt_rand(1000, 9999);
	}
}

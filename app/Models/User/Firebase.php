<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Firebase
 *
 * @package App\Models\User
 *
 * @property integer $id
 * @property integer $user_id
 * @property string  $token
 * @property string  $type
 *
 * @property User    $User
 */
class Firebase extends Model
{
	protected $table = 'firebase';

	protected $fillable = [
		'user_id',
		'token',
		'type',
	];

	public const UPDATED_AT = NULL;

	protected $dates = [
		'created_at',
	];

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function user()
	{
		return $this->belongsTo(User::class);
	}

}

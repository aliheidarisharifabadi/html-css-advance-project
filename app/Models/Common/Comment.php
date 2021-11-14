<?php

namespace App\Models\Common;

use App\Models\User\Social;
use App\Models\User\User;
use App\Traits\HasPhotoUrl;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Comment
 *
 * @package App\Models\Common
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $commentable_id
 * @property string  $commentable_type
 * @property integer $rate
 * @property string  $comment
 * @property Carbon  $created_at
 *
 * @property User    $user
 */
class Comment extends Model
{
	use HasPhotoUrl;

	protected $fillable = [
		'user_id',
		'commentable_id',
		'commentable_type',
		'rate',
		'comment',
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

	/**
	 * Get all of the owning commentable models.
	 */
	public function commentable()
	{
		return $this->morphTo();
	}

}

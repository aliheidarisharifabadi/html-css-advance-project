<?php

namespace App\Models\User;

use App\Models\Common\Photo;
use App\Models\VisitCard\VisitCard;
use App\Traits\HasPhotoUrl;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class Social
 *
 * @package App\Models\User
 *
 * @property integer     $id
 * @property integer     $user_id
 * @property integer     $photo_id
 * @property string      $type
 * @property string      $name
 * @property string      $value
 * @property boolean     $status
 * @property Carbon      $created_at
 * @property Carbon      $updated_at
 *
 * @property User        $user
 * @property Photo       $photo
 * @property VisitCard[] $visitCards
 *
 */
class Social extends Model
{
	use HasPhotoUrl;

	const TYPE_MOBILE = 'mobile';
	const TYPE_PHONE = 'phone';
	const TYPE_EMAIL = 'email';
	const TYPE_TELEGRAM = 'telegram';
	const TYPE_INSTAGRAM = 'instagram';

	const TYPE_LIST = [
		self::TYPE_MOBILE,
		self::TYPE_PHONE,
		self::TYPE_EMAIL,
		self::TYPE_TELEGRAM,
		self::TYPE_INSTAGRAM,
	];

	const TYPE_TITLE = [
		self::TYPE_MOBILE   => 'موبایل',
		self::TYPE_PHONE    => 'تلفن',
		self::TYPE_EMAIL => 'ایمیل',
		self::TYPE_EMAIL => 'ایمیل',
		self::TYPE_INSTAGRAM => 'اینستاگرام',
	];

	protected $table = 'socials';

	protected $fillable = [
		'user_id',
		'photo_id',
		'type',
		'name',
		'value',
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
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
	public function visitCards()
	{
		return $this->belongsToMany(VisitCard::class, 'visit_card_social', 'social_id', 'visit_card_id');
	}

	/**
	 * @param Builder $query
	 * @return Builder
	 */
	public function scopeMine(Builder $query)
	{
		return $query->where('user_id', auth()->id());
	}

}

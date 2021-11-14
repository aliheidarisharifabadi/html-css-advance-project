<?php

namespace App\Models\VisitCard;

use App\Models\Common\Category;
use App\Models\Common\Comment;
use App\Models\Common\Photo;
use App\Models\Location\Zone;
use App\Models\User\Favorite;
use App\Models\User\Social;
use App\Models\User\User;
use App\Traits\HasPhotoUrl;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * Class VisitCard
 *
 * @package App\Models\VisitCard
 *
 * @property integer    $id
 * @property integer    $user_id
 * @property integer    $photo_id
 * @property integer    $resume_id
 * @property string     $title
 * @property string     $specialty
 * @property string     $description
 * @property integer    $view_count
 * @property boolean    $status
 * @property Carbon     $deleted_at
 * @property Carbon     $created_at
 * @property Carbon     $updated_at
 *
 * @property User       $user
 * @property User[]     $users
 * @property Photo      $photo
 * @property Social[]   $socials
 * @property Category[] $categories
 * @property Comment[]  $comments
 * @property Favorite[] $favorites
 * @property Report[]   $reports
 * @property Zone[]     $zones
 */
class VisitCard extends Model
{
	use HasPhotoUrl;

	const TYPE_WHITE = 'white';
	const TYPE_BLACK = 'black';

	public $defaultNoImage = '/img/no-image.png';
	public $defaultNoThumbnail = '/img/no-thumbnail.png';

	protected $table = 'visit_cards';

	protected $fillable = [
		'user_id',
		'photo_id',
		'resume_id',
		'title',
		'specialty',
		'description',
		'view_count',
		'status',
		'deleted_at',
	];

	protected $dates = [
		'deleted_at',
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
	public function users()
	{
		return $this->belongsToMany(User::class, 'visit_card_user', 'visit_card_id', 'user_id');
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
	public function socials()
	{
		return $this->belongsToMany(Social::class, 'visit_card_social', 'visit_card_id', 'social_id');
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
	public function categories()
	{
		return $this->belongsToMany(Category::class, 'visit_card_categories', 'visit_card_id', 'category_id');
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\MorphMany
	 */
	public function comments()
	{
		return $this->morphMany(Comment::class, 'commentable');
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function favorites()
	{
		return $this->hasMany(Favorite::class, 'visit_card_id');
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function reports()
	{
		return $this->hasMany(Report::class, 'visit_card_id');
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
	public function zones()
	{
		return $this->belongsToMany(Zone::class, 'visit_card_zone', 'visit_card_id', 'zone_id');
	}

	// @todo : resume relation here


	/**
	 * @param Builder $query
	 * @return Builder
	 */
	public function scopeMine(Builder $query)
	{
		return $query->where('user_id', auth()->id());
	}

	/**
	 * @param Builder $query
	 * @return Builder
	 */
	public function scopeActive(Builder $query)
	{
		return $query->where('visit_cards.status', true);
	}

	/**
	 * @param Builder $query
	 * @return Builder
	 */
	public function scopeNotActive(Builder $query)
	{
		return $query->where('visit_cards.status', false);
	}

	/**
	 * @return Social[]
	 */
	public function getSocials()
	{
		/** @var Social[] $socials */
		$socials = $this->socials()->select([
			'type',
			'name',
			'value',
			'status',
		])->get();

		foreach ($socials as $social){

			unset($social->pivot);

		}

		return $socials;
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Collection
	 */
	public function getZones()
	{
		return $this->zones()->select([
			'state_id', 'city_id', 'address', 'phone',
		])->get();
	}

	/**
	 * @return mixed
	 */
	public function getZoneName()
	{
		/** @var Zone $zone */
		$zone = $this->zones()->first();

		if ($zone) {

			return [
				'state'   => $zone->state->name,
				'city'    => $zone->city->name,
				'address' => $zone->address,
			];

		}

		return $zone;
	}

	/**
	 * @param int $user_id
	 * @return bool
	 */
	public function isUserSeen(int $user_id = NULL)
	{
		/** @var User $user */
		$user = $this->users()->where('user_id', $user_id ?? auth()->id())->first();

		if ($user) {

			return true;

		}

		return false;
	}

	/**
	 * @param int $user_id
	 * @return bool
	 */
	public function isFavoriteUser(int $user_id = NULL)
	{
		/** @var User $user */
		$user = $this->favorites()->where('user_id', $user_id ?? auth()->id())->first();

		if ($user) {

			return true;

		}

		return false;
	}
}

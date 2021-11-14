<?php

namespace App\Models\User;


use App\Models\Counter\Counter;
use App\Models\Location\Zone;
use App\Models\Notification\Notification;
use App\Models\VisitCard\Report;
use App\Models\VisitCard\VisitCard;
use App\Traits\HasPhotoUrl;
use Carbon\Carbon;
use Hekmatinasser\Verta\Verta;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;
use Laravel\Passport\PersonalAccessTokenResult;
use Laravel\Passport\Token as PassportToken;
use Zizaco\Entrust\Traits\EntrustUserTrait;

/**
 * Class User
 *
 * @package App\Models\User
 * @mixin \Eloquent
 *
 * @property integer         $id
 * @property string          $refer_id
 * @property string          $phone
 * @property string          $first_name
 * @property string          $last_name
 * @property string          $app_version
 * @property string          $password
 * @property string          $status
 * @property boolean         $can_create_vcard
 * @property Carbon          $deleted_at
 * @property Carbon          $created_at
 * @property Carbon          $updated_at
 *
 * @property User            $refer
 * @property Firebase[]      $firebase
 * @property SMS[]           $sms
 * @property Voice[]         $voices
 * @property PassportToken[] $tokens
 * @property Code[]          $verifyCodes
 * @property Social[]        $socials
 * @property VisitCard[]     $visitCards
 * @property VisitCard[]     $vcardCounts
 * @property Favorite[]      $favorites
 * @property Zone[]          $zones
 * @property Report[]        $reports
 * @property Notification[]  $notifications
 *
 */
class User extends Authenticatable
{
	use Notifiable, HasApiTokens, EntrustUserTrait, HasPhotoUrl;

	const ROLE_ADMIN = 'admin';
	const ROLE_USER = 'user';

	const TYPE_WHITE = 'white';
	const TYPE_BLACK = 'black';

	const ROLES = [
		self::ROLE_USER,
	];

	public $defaultNoImage = '/img/no-avatar-image.png';
	public $defaultNoThumbnail = '/img/no-avatar-thumbnail.png';

	protected $fillable = [
		'photo_id',
		'refer_id',
		'phone',
		'first_name',
		'last_name',
		'app_version',
		'password',
		'status',
		'can_create_vcard',
		'deleted_at',
	];

	protected $dates = [
		'deleted_at',
		'created_at',
		'updated_at',
	];

	protected $hidden = [
		'password',
		'remember_token',
	];

	/**
	 * @return mixed
	 */
	public function getJCreatedAtAttribute()
	{
		return Verta::instance($this->created_at);
	}

	public function canUser(string $permission)
	{
		/** @var array $resultType */
		$resultType = getTypeFromAccessToken();

		if (!$resultType['status']) {
			return false;
		}

		$type = $resultType['type'];

		if ($type == User::ROLE_ADMIN && $this->canAdmin($permission)) {

			return User::ROLE_ADMIN;

		} elseif ($type == User::ROLE_USER && $this->canUserRole($permission)) {

			return User::ROLE_USER;

		}

		return false;
	}

	/**
	 * @param string $permission
	 * @return bool
	 */
	public function canAdmin($permission)
	{
		return $this->can($permission . ".admin");
	}

	/**
	 * @param string $permission
	 * @return bool
	 */
	public function canUserRole($permission)
	{
		return $this->can($permission . ".user");
	}

	/**
	 * Generate string username
	 *
	 * @return string username
	 */
	public static function generateUsername()
	{
		return chr(rand(65, 90)) . mt_rand(1000000, 9999999);
	}

	/**
	 * Generate access token
	 * Set expire date
	 *
	 * @return PersonalAccessTokenResult
	 */
	public function generateAccessToken()
	{
		return $this->createToken('Api Access Code');
	}

	/**
	 * Get the password for the user.
	 *
	 * @param string $code
	 * @return string
	 */
	public function validateForPassportPasswordGrant(string $code)
	{
		return ($this->verifyCodes->first()->code == $code);
	}

	/**
	 * set username field for oauth2
	 *
	 * @param $username
	 * @return mixed
	 */
	public function findForPassport($username)
	{
		return $this->where('phone', $username)->first();
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function refer()
	{
		return $this->belongsTo(User::class, 'refer_id');
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function firebase()
	{
		return $this->hasMany(Firebase::class, 'user_id');
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function sms()
	{
		return $this->hasMany(SMS::class, 'user_id');
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function voices()
	{
		return $this->hasMany(Voice::class, 'user_id');
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function verifyCodes()
	{
		return $this->hasMany(Code::class, 'user_id');
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function socials()
	{
		return $this->hasMany(Social::class, 'user_id')->select(['id', 'name', 'photo_id', 'type', 'value']);
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function visitCards()
	{
		return $this->hasMany(VisitCard::class, 'user_id');
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
	public function vcardCounts()
	{
		return $this->belongsToMany(VisitCard::class, 'visit_card_user', 'user_id', 'visit_card_id');
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function favorites()
	{
		return $this->hasMany(Favorite::class, 'user_id');
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function zones()
	{
		return $this->hasMany(Zone::class, 'user_id')->select([
			'state_id', 'city_id', 'address', 'phone',
		]);
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function reports()
	{
		return $this->hasMany(Report::class, 'user_id');
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function notifications()
	{
		return $this->hasMany(Notification::class, 'user_id');
	}

	/**
	 * @param Builder $query
	 * @return Builder
	 */
	public function scopeActive(Builder $query)
	{
		return $query->where('users.status', true);
	}

	/**
	 * @param Builder $query
	 * @return Builder
	 */
	public function scopeNotActive(Builder $query)
	{
		return $query->where('users.status', false);
	}

}

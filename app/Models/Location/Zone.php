<?php

namespace App\Models\Location;

use App\Models\User\User;
use App\Models\VisitCard\VisitCard;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Zone
 *
 * @package App\Models\Common
 *
 * @property integer     $id
 * @property integer     $user_id
 * @property integer     $state_id
 * @property integer     $city_id
 * @property string      $address
 * @property string      $phone
 * @property string      $lat
 * @property string      $long
 * @property Carbon      $created_at
 * @property Carbon      $updated_at
 *
 * @property User        $user
 * @property State       $state
 * @property City        $city
 * @property VisitCard[] $visitCards
 */
class Zone extends Model
{
	protected $table = 'zones';

	protected $fillable = [
		'user_id',
		'state_id',
		'city_id',
		'address',
		'phone',
		'lat',
		'long',
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
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function state()
	{
		return $this->belongsTo(State::class);
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\belongsTo
	 */
	public function city()
	{
		return $this->belongsTo(City::class);
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
	public function visitCards()
	{
		return $this->belongsToMany(VisitCard::class, 'visit_card_zone', 'zone_id', 'visit_card_id');
	}

}

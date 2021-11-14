<?php

namespace App\Models\Location;

use Illuminate\Database\Eloquent\Model;

/**
 * Class City
 *
 * @package App\Models\Common
 *
 * @property integer $id
 * @property integer $state_id
 * @property string  $name
 *
 * @property State   $state
 * @property Zone[]  $addresses
 */
class City extends Model
{
	/** @var array $fillable */
	protected $fillable = [
		'state_id',
		'name',
	];

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function state()
	{
		return $this->belongsTo(State::class);
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function addresses()
	{
		return $this->hasMany(Zone::class, 'city_id');
	}

}

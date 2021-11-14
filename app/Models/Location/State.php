<?php

namespace App\Models\Location;

use Illuminate\Database\Eloquent\Model;

/**
 * Class State
 *
 * @package App\Models\Common
 *
 * @property integer $id
 * @property string  $name
 *
 * @property City[]  $cities
 * @property Zone[]  $addresses
 */
class State extends Model
{
	/** @var array $fillable */
	protected $fillable = [
		'name',
	];

	public $timestamps = NULL;

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function cities()
	{
		return $this->hasMany(City::class, 'state_id')->select(['id', 'name']);
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function addresses()
	{
		return $this->hasMany(Zone::class, 'state_id');
	}

}

<?php

namespace App\Models\User;

use App\Models\VisitCard\VisitCard;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Favorite
 *
 * @package App\Models\User
 *
 * @property integer   $id
 * @property integer   $user_id
 * @property integer   $visit_card_id
 * @property boolean   $status
 * @property Carbon    $created_at
 *
 * @property User      $user
 * @property VisitCard $visitCard
 *
 */
class Favorite extends Model
{
	protected $table = 'favorites';

	protected $fillable = [
		'user_id',
		'visit_card_id',
		'status',
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
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function visitCard()
	{
		return $this->belongsTo(VisitCard::class);
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

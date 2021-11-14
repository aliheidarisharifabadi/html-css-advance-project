<?php

namespace App\Models\VisitCard;

use App\Models\User\User;
use App\Traits\JCreatedAt;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Report
 *
 * @package App\Models\VisitCard
 *
 * @property integer   $id
 * @property integer   $user_id
 * @property integer   $visit_card_id
 * @property string    $reason
 * @property integer   $anger
 * @property boolean   $status
 * @property Carbon    $created_at
 *
 * @property User      $user
 * @property VisitCard $visitCard
 */
class Report extends Model
{
	use JCreatedAt;

	const TYPE_WHITE = 'white';
	const TYPE_BLACK = 'black';

	protected $fillable = [
		'user_id',
		'visit_card_id',
		'reason',
		'anger',
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
	public function scopeActive(Builder $query)
	{
		return $query->where('reports.status', true);
	}

	/**
	 * @param Builder $query
	 * @return Builder
	 */
	public function scopeNotActive(Builder $query)
	{
		return $query->where('reports.status', false);
	}

}

<?php

namespace App\Models\Counter;

use App\Models\User\User;
use App\Models\VisitCard\VisitCard;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Counter
 *
 * @package App\Models\Counter
 *
 * @property integer   $id
 * @property integer   $user_id
 * @property integer   $visit_card_id
 * @property integer   $view_count
 * @property integer   $rate_count
 * @property integer   $report_count
 * @property Carbon    $created_at
 * @property Carbon    $updated_at
 *
 * @property User      $user
 * @property VisitCard $visitCard
 */
class Counter extends Model
{
	const LIMIT_TIME = 24;
	const LIMIT_SHOW = 5;
	const LIMIT_VISIT_CARD = 2;

	protected $fillable = [
		'user_id',
		'visit_card_id',
		'view_count',
		'rate_count',
		'report_count',
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
	public function visitCard()
	{
		return $this->belongsTo(VisitCard::class);
	}
}

<?php

namespace App\Http\Controllers\v1\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Common\Option;
use App\Models\Counter\Counter;
use App\Models\VisitCard\VisitCard;
use Illuminate\Database\Query\Builder;
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Support\Facades\Input;
use App\Http\Requests\v1\Dashboard\{DashboardIndexRequest, DashboardSearchRequest, DashboardShowRequest};
use App\Http\Resources\v1\Dashboard\{DashboardIndexResource, DashboardSearchResource, DashboardShowResource};

class DashboardController extends Controller
{
	/**
	 * @param DashboardIndexRequest $request
	 *
	 * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
	 */
	public function index(DashboardIndexRequest $request)
	{
		/** @var VisitCard $visitCardQuery */
		$visitCardQuery = VisitCard::query();

		$per_page = Option::get('dashboard.index.paginate', 20);

		$vcards = $visitCardQuery->Active()->whereNotExists(function (Builder $query) {
			$query->from('counters')
				->whereRaw("counters.visit_card_id = visit_cards.id")
				->whereRaw("counters.report_count > " . Counter::LIMIT_SHOW);
		})->paginate($per_page);

		return DashboardIndexResource::collection($vcards)->additional([
			'success' => true,
			'message' => '',
		]);
	}

	/**
	 * @param DashboardShowRequest $request
	 * @param VisitCard            $card
	 * @return \App\Http\Resources\ActionResource|DashboardShowResource
	 * @throws \Exception
	 */
	public function show(DashboardShowRequest $request, VisitCard $card)
	{
		if ($card->status == false){

			return ActionResource(trans('messages.visitCard.notExist'), false);

		}

		return new DashboardShowResource($card);
	}

	/**
	 * @param DashboardSearchRequest $request
	 *
	 * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
	 */
	public function search(DashboardSearchRequest $request)
	{
		/** @var VisitCard $visitCardQuery */
		$visitCardQuery = VisitCard::query();

		$per_page = Option::get('dashboard.search.paginate', 20);

		$visitCardQuery = $visitCardQuery->Active();

		$vcards = $visitCardQuery->when($request->search, function (EloquentBuilder $query) {
			$query->whereNotExists(function (Builder $query) {
				$query->from('counters')
					->whereRaw("counters.visit_card_id = visit_cards.id")
					->whereRaw("counters.report_count > " . Counter::LIMIT_SHOW);

			})->where('visit_cards.title', 'like', '%' . Input::get('search') . '%')
				->orWhere('visit_cards.specialty', 'like', '%' . Input::get('search') . '%')
				->orWhere('visit_cards.description', 'like', '%' . Input::get('search') . '%');
		});

		$visitCardQuery->when($request->category_id, function (EloquentBuilder $query) {
			$query->select('visit_cards.*')->join('visit_card_categories', 'visit_card_categories.visit_card_id', '=', 'visit_cards.id')
				->join('categories', 'categories.id', '=', 'visit_card_categories.category_id')
				->where('categories.id', Input::get('category_id'));
		});

		$visitCardQuery->when($request->state_id, function (EloquentBuilder $query) {
			$query->select('visit_cards.*')->join('visit_card_zone as vcz', 'vcz.visit_card_id', '=', 'visit_cards.id')
				->join('zones as zo', 'zo.id', '=', 'vcz.zone_id')
				->join('states', 'zo.state_id', '=', 'states.id')
				->where('states.id', Input::get('state_id'));
		});

		$visitCardQuery->when($request->city_id, function (EloquentBuilder $query) {
			$query->select('visit_cards.*')->join('visit_card_zone', 'visit_card_zone.visit_card_id', '=', 'visit_cards.id')
				->join('zones', 'zones.id', '=', 'visit_card_zone.zone_id')
				->join('cities', 'zones.city_id', '=', 'cities.id')
				->where('cities.id', Input::get('city_id'));
		});

		return DashboardSearchResource::collection($vcards->paginate($per_page))->additional([
			'success' => true,
			'message' => '',
		]);
	}
}

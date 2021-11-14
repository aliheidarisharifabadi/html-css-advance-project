<?php

namespace App\Http\Controllers\v1\Common;

use App\Http\Requests\v1\Common\Category\CategoryChildrenRequest;
use App\Http\Requests\v1\Common\Category\CategoryEditRequest;
use App\Http\Requests\v1\Common\Category\CategoryGetVisitCardsRequest;
use App\Http\Requests\v1\Common\Category\CategoryIndexRequest;
use App\Http\Requests\v1\Common\Category\CategoryParentRequest;
use App\Http\Requests\v1\Common\Category\CategoryShowRequest;
use App\Http\Requests\v1\Common\Category\CategoryStoreRequest;
use App\Http\Requests\v1\Common\Category\CategoryUpdateRequest;
use App\Http\Resources\ActionResource;
use App\Http\Resources\v1\Common\Category\CategoryChildrenResource;
use App\Http\Resources\v1\Common\Category\CategoryEditResource;
use App\Http\Resources\v1\Common\Category\CategoryGetVisitCardsResource;
use App\Http\Resources\v1\Common\Category\CategoryIndexResource;
use App\Http\Resources\v1\Common\Category\CategoryParentResource;
use App\Http\Resources\v1\Common\Category\CategoryShowResource;
use App\Models\Common\Category;
use App\Http\Controllers\Controller;
use App\Models\Common\Option;
use App\Models\Counter\Counter;
use App\Models\VisitCard\VisitCard;
use Illuminate\Database\Query\Builder;
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;

class CategoryController extends Controller
{
	/**
	 * Convert CategoryResource to Collection then Display a listing of the Category
	 *
	 * @param CategoryIndexRequest $request
	 * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
	 */
	public function index(CategoryIndexRequest $request)
	{
		/** @var Category $product */
		$category = Category::query();

		/** @var Category $categories */
		$categories = $category->whereNull('parent_id')->get();

		return CategoryIndexResource::collection($categories)->additional([
			'success' => true,
			'message' => '',
		]);

	}

	/**
	 * @param CategoryGetVisitCardsRequest $request
	 * @param Category                     $category
	 * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
	 */
	public function getVisitCards(CategoryGetVisitCardsRequest $request, Category $category)
	{
		/** @var VisitCard $visitCardQuery */
		$visitCardQuery = VisitCard::query();

		$per_page = Option::get('category.getVisitCards.paginate', 20);

		$visitCardQuery = $visitCardQuery->Active();

		$vcards = $visitCardQuery->whereNotExists(function (Builder $query) {
			$query->from('counters')
				->whereRaw("counters.visit_card_id = visit_cards.id")
				->whereRaw("counters.report_count > " . Counter::LIMIT_SHOW);

		})->whereExists(function (Builder $builder) use ($category) {
			$builder->from('visit_cards')->join('visit_card_categories', 'visit_card_categories.visit_card_id', '=', 'visit_cards.id')
				->where('visit_card_categories.category_id', '=', $category->id);
		});

		return CategoryGetVisitCardsResource::collection($vcards->paginate($per_page))->additional([
			'success' => true,
			'message' => '',
		]);

	}

	/**
	 * Store a newly created Category in storage using Category from the user.
	 *
	 * @param CategoryStoreRequest $request
	 * @return ActionResource
	 */
	public function store(CategoryStoreRequest $request)
	{
		$keys = [
			'name',
			'description',
			'slug',
			'selected',
			'parent_id',
			'photo_id',
		];

		Category::create($request->only($keys));

		return ActionResource(trans('messages.category.created'));
	}

	/**
	 * Display the specified Category Using Route Model Binding
	 *
	 * @param CategoryShowRequest $request . Check Authorization for Displaying the specified Category
	 * @param Category            $category
	 * @return CategoryShowResource Response for Customizing Response
	 * @throws \Exception
	 */
	public function show(CategoryShowRequest $request, Category $category)
	{
		return new CategoryShowResource($category, true, trans('messages.category.show'));
	}

	/**
	 * Display the specified Product Using Route Model Binding for editing the specified Product.
	 *
	 * @param CategoryEditRequest $request
	 * @param Category            $category
	 * @return CategoryEditResource
	 * @throws \Exception
	 */
	public function edit(CategoryEditRequest $request, Category $category)
	{
		return new CategoryEditResource($category, true, trans('messages.category.show'));
	}

	/**
	 * Update the specified Category in storage using Requests from the user .
	 *
	 * @param CategoryUpdateRequest $request
	 * @param Category              $category
	 * @return ActionResource
	 */
	public function update(CategoryUpdateRequest $request, Category $category)
	{
		$keys = [
			'name',
			'description',
			'slug',
			'selected',
			'parent_id',
			'photo_id',
		];

		$category->update($request->only($keys));

		return ActionResource(trans('messages.category.updated'));
	}

	/**
	 * @param CategoryChildrenRequest $request
	 * @param Category                $category
	 * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
	 */
	public function children(CategoryChildrenRequest $request, Category $category)
	{
		return CategoryChildrenResource::collection($category->children)->additional([
			'success' => true,
			'message' => trans('messages.category.children'),
		]);
	}

	/**
	 * Convert CategoryResource to Collection then Display a listing of Parent Category
	 *
	 * @param CategoryParentRequest $request
	 * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
	 */
	public function parents(CategoryParentRequest $request)
	{
		/** @var Category $product */
		$category = Category::query();

		/** @var Category $categories */
		$categories = $category->whereNull('parent_id')->get();

		return CategoryParentResource::collection($categories)->additional([
			'success' => true,
			'message' => '',
		]);

	}

}

<?php

namespace App\Models\Common;

use App\Models\VisitCard\VisitCard;
use App\Traits\HasPhotoUrl;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder as QueryBuilder;
use Kalnoy\Nestedset\NodeTrait;

/**
 * Class Category
 *
 * @package App\Models
 *
 * @uses    NodeTrait
 *
 * @property integer     $id
 * @property integer     $parent_id
 * @property integer     $photo_id
 * @property string      $name
 * @property string      $description
 * @property string      $slug
 * @property bool        $selected
 *
 * @property Photo       $photo
 * @property Category[]  $childes
 * @property VisitCard[] $visitCards
 */
class Category extends Model
{
	use NodeTrait, HasPhotoUrl;

	public $defaultNoImage = '/img/no-image.png';
	public $defaultNoThumbnail = '/img/no-thumbnail.png';

	protected $fillable = [
		'parent_id',
		'photo_id',
		'name',
		'description',
		'slug',
		'selected',
	];

	protected $casts = [
		'selected',
	];

	protected $hidden = ['pivot'];

	public $timestamps = false;

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function childes()
	{
		return $this->hasMany(Category::class, 'parent_id', 'id');
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
	public function visitCards()
	{
		return $this->belongsToMany(VisitCard::class, 'visit_card_categories', 'category_id', 'visit_card_id');
	}

	/**
	 * @param QueryBuilder $query
	 * @return mixed
	 */
	public function scopeSelected($query)
	{
		return $query->where('selected', 1);
	}

	/**
	 * @param int|NULL $id
	 * @return \Illuminate\Support\Collection
	 */
	public static function treeData(int $id = NULL)
	{
		/** @var Category[] $categories */
		$categories = [];

		foreach (Category::select([
			'id', 'parent_id', 'photo_id', 'name', 'description',
		])->where('parent_id', $id)->get() as $category) {

			if (isset($category->photo_id)){
				$category->photo_url = getPhotoInfo($category->photo_id)['path'];
			}else{
				$category->photo_url = asset('img/no-image.png');
			}

			unset($category->photo_id);
			unset($category->childes);

			array_push($categories, $category);

		}

		return collect($categories);
	}


}


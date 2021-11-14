<?php

namespace App\Models\Common;

use App\Models\User\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

/**
 * Class Photo
 *
 * @package App\Models\Common
 * @property integer $id
 * @property integer $user_id
 * @property User    $uploader
 * @property string  $disk
 * @property string  $path
 * @property string  $thumbnail
 * @property string  $ext
 * @property Carbon  $created_at
 * @property Carbon  $updated_at
 *
 * Appends:
 * @property string  $url
 * @property string  $thumbnail_url
 */
class Photo extends Model
{
	/** @var array */
	protected $fillable = [
		'user_id',
		'disk',
		'path',
		'thumbnail',
		'ext',
		'type',
	];

	protected $appends = [
		'url',
		'thumbnail_url',
	];

	const DISK_LOCAL = 'local';

	const TYPE_V_CARD = 'vcard';
	const TYPE_SOCIAL = 'social';
	const TYPE_CATEGORY = 'category';
	const TYPE_MEDIA = 'media';
	const TYPE_AVATAR = 'avatar';
	const TYPE_THUMBNAIL = 'thumbnail';

	/**
	 * @return string
	 */
	public function getUrlAttribute()
	{
		return url('/') . Storage::url($this->path);
	}

	/**
	 * @return string
	 */
	public function getThumbnailUrlAttribute()
	{
		return url('/') . Storage::url($this->thumbnail);
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function uploader()
	{
		return $this->belongsTo(User::class);
	}

	/**
	 * @param Builder $query
	 * @param         $ID
	 * @return Builder
	 */
	public function scopeUserID(Builder $query, $ID)
	{
		return $query->where('user_id', $ID);
	}
}

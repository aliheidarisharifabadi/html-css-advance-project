<?php
/**
 * Developer : MahdiY
 * Web Site  : MahdiY.IR
 * E-Mail    : M@hdiY.IR
 */

namespace App\Traits;

use App\Models\Common\Photo;
use Illuminate\Database\Eloquent\Builder;

/**
 * Trait HasPhotoUrl
 *
 * @package App\Traits
 * @property integer $photo_id
 * @property string  $photo_url
 * @property string  $photo_thumbnail_url
 * @property Photo   $Photo
 */
trait HasPhotoUrl
{
	// Functions

	public function getPhotoURLAttribute()
	{
		/** @var Photo $photo */
		$photo = $this->Photo;

		$noImage = $this->defaultNoImage ? url('') . $this->defaultNoImage : url('') . '/img/no-image.png';

		return $photo ? $photo->url : $noImage;
	}

	public function getPhotoThumbnailUrlAttribute()
	{
		/** @var Photo $photo */
		$photo = $this->Photo;

		$noThumbnail = $this->defaultNoThumbnail ? url('') . $this->defaultNoThumbnail : url('') . '/img/no-thumbnail.png';

		return $photo && $photo->thumbnail ? $photo->thumbnail_url : $noThumbnail;
	}


	// Relations

	public function photo()
	{
		return $this->belongsTo(Photo::class);
	}

	// Scopes

	public function scopePhotoID(Builder $query, int $ID)
	{
		return $query->where('photo_id', $ID);
	}
}
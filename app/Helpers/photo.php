<?php

use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

/**
 * @param int $id
 * @return mixed
 */
function getPhotoInfo(int $id){
	$photo = \App\Models\Common\Photo::where('id', $id)->first();
	$photo->path = url('/') . Storage::url($photo->path);
	$photo->thumbnail = url('/') . Storage::url($photo->thumbnail);
	return $photo;
}

/**
 * File uploader
 *
 * @param        $file
 * @param string $type
 * @param int    $int
 * @param null   $oldFile
 * @return string
 */
function photoUploader($file, string $type, int $int, $oldFile = NULL)
{
	/** check old file and unlink this */
	if ($oldFile != NULL) if (file_exists(storage_path($oldFile))) unlink(storage_path($oldFile));

	/** choose folder and create it if not available */
	$pathFolder = storage_path("app/public/$type");
	if (!file_exists($pathFolder)) mkdir($pathFolder, 0777, true);

	$str = date('Y-m-d_H-i-s') . '_' . $int;
	$filename = sha1($str) . '.png';

	exec("find " . $pathFolder . " -type d -exec chmod 0777 {} +");

	if ($type == \App\Models\Common\Photo::TYPE_THUMBNAIL) {
		Image::make($file->getRealPath())->resize(100, 100)->save($pathFolder . '/' . $filename);

	} else {
//		if ($type == \App\Models\Common\Photo::TYPE_AVATAR) {
		Image::make($file->getRealPath())->save($pathFolder . '/' . $filename);

//		}
//		else {
//			$imageHeight = getimagesize($file)[1];
//			$logoSize = getimagesize(public_path('img/logo.png'));
//
//			$width = $imageHeight / 9;
//			$height = intdiv($width * $logoSize[0], $logoSize[1]);
//
//			$logo = Image::make(public_path('img/logo.png'))->resize($height, $width);
//			Image::make($file->getRealPath())->insert($logo, 'bottom-left', 5, 5)->save($pathFolder . '/' . $filename);
//		}
	}

	/** return path of photo */
	return "public/$type/$filename";
}

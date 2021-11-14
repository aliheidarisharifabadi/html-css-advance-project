<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class ActionResource
 *
 * @package App\Http\Resources
 *
 * @property boolean $success
 * @property string  $message
 * @property array   $data
 */
class ActionResource extends JsonResource
{
	protected $message;
	protected $success;
	protected $data;

	public static $wrap = "dat";

	public function __construct(string $message = NULL, bool $success = true, array $data = [])
	{
		$this->message = $message;
		$this->success = $success;
		$this->data = $data;

		self::withoutWrapping();
	}

	/**
	 * @param \Illuminate\Http\Request $request
	 * @return array
	 */
	public function with($request)
	{
		return [
			'success' => $this->success,
			'message' => $this->message,
		];
	}

	/**
	 * @param \Illuminate\Http\Request $request
	 * @return array
	 */
	public function toArray($request)
	{
		return $this->data;
	}

	/**
	 * @param null $request
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function toResponse($request)
	{
		$jsonResponse = parent::toResponse($request)->getData();

		if (isset($jsonResponse->data) && empty($jsonResponse->data)) {
			unset($jsonResponse->data);
		}

        return response((array)$jsonResponse);
	}
}

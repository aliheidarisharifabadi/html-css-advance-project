<?php

namespace App\Http\Resources;

use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\MergeValue;
use Illuminate\Http\Resources\MissingValue;

/**
 * Class SetResource
 *
 * @package App\Http\Resources
 *
 * @property boolean $success
 * @property string  $message
 * @property Model   $model
 */
class SetResource extends JsonResource
{
	protected $success;
	protected $message;
	protected $model = NULL;

	public function __construct(Model $resource, bool $success = true, string $message = NULL)
	{
		$this->success = $success;
		$this->message = $message;

		if (is_null($this->model)) {
			throw new Exception(sprintf('protected $model can\'t be null in %s', get_called_class()));
		}

		if ($this->model != get_class($resource)) {
			throw new Exception(sprintf('$resource passed to %s must be an instance of %s, instance of %s given', get_called_class(), $this->model, get_class($resource)));
		}

		parent::__construct($resource);
	}

	/**
	 * Transform the resource into an array.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @return array
	 */
	public function toArray($request)
	{
		return [
			//
		];
	}

	/**
	 * @param \Illuminate\Http\Request $request
	 * @return array
	 */
	public function with($request)
	{
		return [
			'success' => $this->success,
			'message' => trans($this->message ?? 'messages.request.success'),
		];
	}

	/**
	 * @param bool  $condition
	 * @param mixed $value
	 * @return \Illuminate\Http\Resources\MergeValue|mixed
	 */
	protected function mergeWhen($condition, $value)
	{
		if (is_callable($value)) {
			return $condition ? new MergeValue($value($this)) : new MissingValue;
		}

		return parent::mergeWhen($condition, $value);
	}
}

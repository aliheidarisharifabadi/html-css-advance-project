<?php
namespace App\Models\Common;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Option
 *
 * @package App\Models\Common
 * @property string $name
 * @property string $value
 */
class Option extends Model
{
	protected $fillable = [
		'name',
		'value',
	];

	public $timestamps = false;

	protected $primaryKey = 'name';

	public $incrementing = false;

	/**
	 * @return mixed
	 */
	public function getValueAttribute()
	{
		$value = json_decode($this->attributes['value']);
		return json_last_error() == JSON_ERROR_NONE ? $value : $this->attributes['value'];
	}

	/**
	 * @param string $key
	 * @param mixed  $value
	 * @return Option
	 */
	public static function add($key, $value)
	{
		$key = str_replace(" ", "_", $key);

		return Option::updateOrCreate([
			'name' => $key,
		], [
			'value' => is_array($value) ? json_encode($value) : $value,
		]);
	}

	/**
	 * @param string $key
	 * @param mixed  $value
	 * @return Option
	 */
	public static function up($key, $value)
	{
		$key = str_replace(" ", "_", $key);

		return Option::updateOrCreate([
			'name' => $key,
		], [
			'value' => is_array($value) ? json_encode($value) : $value,
		]);
	}

	public function update(array $attributes = [], array $options = [])
	{
		if (isset($attributes['name'])) {
			$attributes['name'] = str_replace(" ", "_", $attributes['name']);
		}

		if (isset($attributes['value']) && is_array($attributes['value'])) {
			$attributes['value'] = json_encode($attributes['value']);
		}

		return parent::update($attributes, $options);
	}

	/**
	 * @param string $name
	 * @param null   $default
	 * @return mixed
	 */
	public static function get($name, $default = NULL)
	{
		/** @var Option $option */
		$option = self::find($name);

		if ($option) {
			return $option->value;
		}

		return $default;
	}

	public static function all($key_value = false)
	{
		$options = parent::all();

		if ($key_value) {
			return $options->pluck('value', 'name')->toArray();
		}

		return $options;
	}

	public function getRouteKeyName()
	{
		return 'name';
	}
}

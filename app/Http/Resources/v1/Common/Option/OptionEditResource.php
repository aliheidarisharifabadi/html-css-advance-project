<?php

namespace App\Http\Resources\v1\Common\Option;

use App\Http\Resources\SetResource;
use App\Models\Common\Option;

/**
 * Class OptionEditResource
 *
 * @mixin Option
 * @package App\Http\Resources\v1\Common\Option
 */
class OptionEditResource extends SetResource
{
    protected $model = Option::class;

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'name'  => $this->name,
            'value' => $this->value,
        ];
    }
}

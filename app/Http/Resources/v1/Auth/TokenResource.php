<?php

namespace App\Http\Resources\v1\Auth;

use App\Models\Token;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class TokenResource

 * @property $type
 * @property $forceUpdate
 *
 * @package App\Http\Resources\v1\Auth
 */
class TokenResource extends JsonResource
{
	private $type;
	private $forceUpdate;

	/**
	 * UserPhoneResponse constructor.
	 *
	 * @param mixed $resource
	 * @param bool  $forceUpdate
	 */
	public function __construct(Token $resource, $type, $forceUpdate=false)
	{
		parent::__construct($resource);
		$this->type = $type;
		$this->forceUpdate = $forceUpdate;
	}

	/**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
		return response()->json([
			'status'=> true,
			"type"=> $this->type,
			"message"=> "کد موقت به شماره ".$this->phone." ارسال شد",
			"force_update"=> $this->forceUpdate,
		]);
    }
}

<?php

namespace App\Traits;

use App\Exceptions\v1\FailedInternalRequestException;
use App\Http\Controllers\v1\InternalRequest;
use App\Models\Common\Option;
use http\Exception;

/**
 * Trait IssueTokenTrait
 *
 * @package App\Traits
 */
trait IssueTokenTrait
{
	/**
	 * Generate Access and refresh Code by this method
	 *
	 * @param string $username [phone number]
	 * @param string $password [verify code]
	 * @return array
	 */
	public function issueToken(string $username, string $password)
	{
		/** @var InternalRequest $request */
		$request = new InternalRequest(app());

		$params = [
			'grant_type'    => 'password',
			'client_id'     => Option::get('client_id'),
			'client_secret' => Option::get('client_secret'),
			'username'      => $username,
			'password'      => $password,
			'scope'         => '*',
		];

		$response = NULL;

		try {
			$response = $request->request('POST', '/oauth/token', $params);
		} catch (FailedInternalRequestException $e) {
			return $response;
		}

		return json_decode($response->getContent(), true);

	}

	public function refreshToken(string $refreshToken)
	{
		/** @var InternalRequest $request */
		$request = new InternalRequest(app());

		$params = [
			'grant_type'    => 'refresh_token',
			'refresh_token' => $refreshToken,
			'client_id'     => Option::get('client_id'),
			'client_secret' => Option::get('client_secret'),
			'scope'         => '',
		];

		$response = NULL;

		try {
			$response = $request->request('POST', '/oauth/token', $params);
		} catch (FailedInternalRequestException $e) {
			return $response;
		}

		return json_decode($response->getContent(), true);
	}

}

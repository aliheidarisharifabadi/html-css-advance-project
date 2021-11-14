<?php

use Firebase\JWT\JWT;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;
use Laravel\Passport\Passport;

/**
 * @param string      $type
 * @param string|NULL $accessToken
 * @return string
 */
function setTypeToAccessToken(string $type, string $accessToken = NULL)
{
	/**
	 * decode current access token
	 *
	 * @var object $decode
	 */
	$decode = getDecodedAccessToken($accessToken);

	/**
	 * update type field in oauth_access_tokens table
	 */
	DB::table('oauth_access_tokens')
		->where('id', '=', $decode->jti)
		->update([
			'type' => $type,
		]);

	/**
	 * add type to token
	 */
	$decode->type = $type;

	/**
	 * get private key from storage
	 *
	 * @var string $privateKey
	 */
	$privateKey = file_get_contents(Passport::keyPath('oauth-private.key'));

	/**
	 * create new access token by type value
	 */
	$newAccessToken = JWT::encode($decode, $privateKey, 'RS256');

	return $newAccessToken;

}


/**
 * @param string|null $type
 * @param string|NULL $accessToken
 * @return array
 */
function getTypeFromAccessToken(string $type = NULL, string $accessToken = NULL)
{
	/**
	 * decode current access token
	 *
	 * @var object $decode
	 */
	$decode = getDecodedAccessToken($accessToken);

	if (isset($decode->type)) {

		if (!is_null($type)) {

			if ($decode->type == $type) {

				return [
					'status' => true,
					'type'   => $decode->type,
				];

			} else {

				return [
					'status' => false,
					'type'   => '',
				];

			}

		}

		return [
			'status' => true,
			'type'   => $decode->type,
		];

	}

	return [
		'status' => false,
		'type'   => '',
	];

}

function getDecodedAccessToken(string $accessToken = NULL)
{
	if (is_null($accessToken)) {

		/**
		 * get access token
		 *
		 * @var string $accessToken
		 */
		$accessToken = substr(Request::header('Authorization'), strpos(Request::header('Authorization'), ' ') + 1);

	}

	/**
	 * get public key from storage
	 *
	 * @var string $publicKey
	 */
	$publicKey = file_get_contents(Passport::keyPath('oauth-public.key'));

	/**
	 * decode current access token
	 *
	 * @var object $decode
	 */
	$decode = JWT::decode($accessToken, $publicKey, array('RS256'));

	return $decode;
}
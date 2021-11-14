<?php namespace App\Helpers;

use App\Contracts\v1\SMS\SMSTrezConstants;
use App\Models\Common\Option;
use SoapClient;

/**
 * Class SMSHelper
 *
 * @package App\Helpers
 */
class SMSHelper
{
	const URI = "http://37.130.202.188/class/sms/wsdlservice/server.php?wsdl";
	const USERNAME = "pardad.pardazesh.shide@gmail.com";
	const PASSWORD = "m428frtp";
	const FROM = "+985000125475";
	const CODE_LOGIN = "985"; // %number% input_data
	const CODE_PASSWORD_RECOVERY = "426";
	const CODE_REGISTER = "986"; // %number% input_data
	const CODE_ORDER_COUNT = "983"; // %Number% input_data

	/**
	 * @param $templateCode
	 * @param $mobileNumber
	 * @param $verifyCode
	 * @return mixed
	 */
	public static function sendSMS($templateCode, $mobileNumber, $verifyCode)
	{
		$client = new SoapClient(self::URI);
		$user = self::USERNAME;
		$pass = self::PASSWORD;
		$fromNum = self::FROM;
		$toNum = array($mobileNumber);
		$pattern_code = $templateCode;
		$input_data = array($templateCode == self::CODE_LOGIN || $templateCode == self::CODE_REGISTER ? "number" : "Number" => $verifyCode);
		$resultCode = $client->sendPatternSms($fromNum, $toNum, $user, $pass, $pattern_code, $input_data);
		return $resultCode;
	}

	public static function trezSendSms(array $phones, string $message)
	{
		$url = Option::get(SMSTrezConstants::URL_SEND_MESSAGE);
		$username = Option::get(SMSTrezConstants::USERNAME);
		$password = Option::get(SMSTrezConstants::PASSWORD);

		$authorization = "Basic " . base64_encode($username . ':' . $password);

		$post_data = json_encode(array(
			'PhoneNumber'         => '9830006859990235',
			'Message'             => $message,
			'Mobiles'             => $phones,
			'UserGroupID'         => uniqid(),
			'SendDateInTimeStamp' => time(),
		));

		$process = curl_init();
		curl_setopt($process, CURLOPT_URL, $url);
		curl_setopt($process, CURLOPT_TIMEOUT, 30);
		curl_setopt($process, CURLOPT_POST, 1);
		curl_setopt($process, CURLOPT_CUSTOMREQUEST, "POST");
		curl_setopt($process, CURLOPT_POSTFIELDS, $post_data);
		curl_setopt($process, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($process, CURLOPT_FOLLOWLOCATION, true);
		curl_setopt($process, CURLOPT_HTTPHEADER, array(
			'Content-Type: application/json',
			'Authorization: ' . $authorization,
		));

		$return = curl_exec($process);
		$httpCode = curl_getinfo($process, CURLINFO_HTTP_CODE);

		curl_close($process);

		if ($httpCode == 401) {
			return [
				'Code'     => NULL,
				'Message'  => "نام کاربری یا کلمه عبور صحیح نمی باشد",
				'Result'   => NULL,
				'HttpCode' => $httpCode,
			];
		}

		$decoded = json_decode($return);
		$decoded->HttpCode = $httpCode;

		return $decoded;
	}

}
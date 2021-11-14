<?php

namespace App\Observers\v1\Common;

use App\Models\User\Voice;

/**
 * Class VoiceObserver
 *
 * @package App\Observers
 */
class VoiceObserver
{
	/**
	 * Handle the voice "created" event.
	 *
	 * @todo get web service data from database ...
	 * @param  \App\Models\User\Voice $voice
	 * @return void
	 */
	public function created(Voice $voice)
	{
//		$wsdl = Option::get('voice_wsdl');
//		$username = Option::get('voice_username');
//		$password = Option::get('voice_password');
//		$serverId = Option::get('voice_serverID');

		$wsdl = 'https://portal.avanak.ir/webservice3.asmx?WSDL';
		$username = 'pardad.pardazesh.shide@gmail.com';
		$password = 'm428frtp';
		$serverId = '1';

		$phone = $voice->user->phone ?? request('phone');

		$res = makeCall($wsdl, $username, $password, $serverId, $phone, $voice->message);

		if ($res->QuickSendWithTTSResult > 0) {
			$voice->status = 1;
			$voice->save();
		}
	}

}

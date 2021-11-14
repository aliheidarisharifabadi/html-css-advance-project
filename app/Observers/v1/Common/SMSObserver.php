<?php

namespace App\Observers\v1\Common;

use App\Helpers\SMSHelper;
use App\Models\User\SMS;

/**
 * Class SMSObserver
 *
 * @package App\Observers\v1\Common
 */
class SMSObserver
{
	/**
	 * Handle the sms "created" event.
	 *
	 * @param SMS $sms
	 * @return void
	 */
	public function created(Sms $sms)
	{
		SMSHelper::trezSendSms(array($sms->phone), $sms->message);

		$sms->update([
			'status' => false,
		]);

	}

}

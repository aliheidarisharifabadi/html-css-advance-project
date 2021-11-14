<?php

use App\Models\Common\Option;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OptionSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */

	public function run()
	{

		DB::table('options')->truncate();

		$secret = DB::table("oauth_clients")->select('secret')->where('id', '=', 2)->value('secret');

		Option::add('ads_show_base', 'rand');
		Option::add('default_user_role', 'user');
		Option::add('default_user_status', 'active');
		Option::add('user_app_force_update', false);
		Option::add('admin_app_force_update', false);
		Option::add('user_app_version', '1');
		Option::add('admin_app_version', '1');

		Option::add('trez_phone_number', '9830006859990235');
		Option::add('trez_username', 'rasoul2023');
		Option::add('trez_password', '2606852');
		Option::add('trez_url_get_credit', 'http://smspanel.trez.ir/api/smsAPI/GetCredit');
		Option::add('trez_url_send_message', 'http://smspanel.trez.ir/api/smsAPI/SendMessage');
		Option::add('trez_url_send_corresponding_message', 'http://smspanel.trez.ir/api/smsAPI/SendMessage');
		Option::add('trez_url_get_credit_to_port', 'http://smspanel.trez.ir/api/smsAPI/GetCreditToPort');
		Option::add('trez_url_receive_messages', 'http://smspanel.trez.ir/api/smsAPI/ReceiveMessages');
		Option::add('trez_url_get_messages_price', 'http://smspanel.trez.ir/api/smsAPI/GetPrices');

		Option::add('voice_password', 'm428frtp');
		Option::add('voice_serverID', '20');
		Option::add('voice_username', 'pardad.pardazesh.shide@gmail.com');
		Option::add('voice_uri', 'https://portal.avanak.ir/webservice3.asmx?WSDL');

		Option::add('client_id', '2');
		Option::add('client_secret', $secret);

		Option::add('fcm_protocol', 'http');
		Option::add('fcm_server_key', 'AAAAgK6MnU8:APA91bHUgT-X4TSGEbeIlD4NucQq5hgOYaVH4j5pTJnk3wYPXMoUv-SdtgdbNKnVhzPrKJIwj4Ym0wEv0YcOKGt85IrUvl3aB5IcdLd_bwOw0x9MFOAFRfu-Zdbzul0T_dFVXt5nZfNa');
		Option::add('fcm_sender_id', '552684264783');

	}

}

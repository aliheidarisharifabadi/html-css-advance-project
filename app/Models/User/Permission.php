<?php

namespace App\Models\User;

use Zizaco\Entrust\EntrustPermission;

/**
 * Class Permission
 *
 * @package App\Models\User
 *
 * @property string $id
 * @property string $name
 * @property string $display_name
 * @property string $description
 */
class Permission extends EntrustPermission
{
	protected $fillable = [
		'name',
		'display_name',
		'description',
	];

}

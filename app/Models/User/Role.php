<?php

namespace App\Models\User;

use Zizaco\Entrust\EntrustRole;

/**
 * Class Role
 *
 * @package App\Models\User
 *
 * @property string $id
 * @property string $name
 * @property string $display_name
 * @property string $description
 */
class Role extends EntrustRole
{
	protected $fillable = [
		'name',
		'display_name',
		'description',
	];
}

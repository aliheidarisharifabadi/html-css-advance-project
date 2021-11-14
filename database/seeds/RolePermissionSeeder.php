<?php

use Zizaco\Entrust\EntrustRole as Role;
use Zizaco\Entrust\EntrustPermission as Permission;
use Illuminate\Database\Seeder;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

class RolePermissionSeeder extends Seeder
{
	protected $roles = [

		'admin' => [
			'display_name' => 'Administrator', // optional
			'description'  => '', // optional
			'permissions'  => [

				'auth.validateAccessToken',
				'auth.validateAccessToken.admin',
				'auth.refresh',
				'auth.refresh.admin',

				'state.index',
				'state.index.admin',
				'state.store',
				'state.store.admin',
				'state.cities',
				'state.cities.admin',
				'state.tree',
				'state.tree.admin',
				'state.show',
				'state.show.admin',

				'city.store',
				'city.store.admin',
				'city.show',
				'city.show.admin',
				'city.update',
				'city.update.admin',

				'option.index',
				'option.store',
				'option.show',
				'option.edit',
				'option.update',

				'category.index',
				'category.index.admin',
				'category.getVisitCards',
				'category.getVisitCards.admin',
				'category.store',
				'category.store.admin',
				'category.show',
				'category.show.admin',
				'category.edit',
				'category.edit.admin',
				'category.update',
				'category.update.admin',
				'category.children',
				'category.children.admin',
				'category.parent',
				'category.parent.admin',

				'photo.store',
				'photo.store.admin',
				'photo.storeAvatar',
				'photo.storeAvatar.admin',
				'photo.update',
				'photo.update.admin',

				'notification.index',
				'notification.index.admin',
				'notification.deliver',
				'notification.deliver.admin',
				'notification.click',
				'notification.click.admin',

				'user.index',
				'user.index.admin',
				'user.edit',
				'user.edit.admin',
				'user.show',
				'user.show.admin',
				'user.update',
				'user.update.admin',
				'user.destroy',
				'user.destroy.admin',
				'user.search',
				'user.search.admin',

				'visitCard.index',
				'visitCard.index.admin',
				'visitCard.create',
				'visitCard.create.admin',
				'visitCard.store',
				'visitCard.store.admin',
				'visitCard.show',
				'visitCard.show.admin',
				'visitCard.edit',
				'visitCard.edit.admin',
				'visitCard.update',
				'visitCard.update.admin',
				'visitCard.status',
				'visitCard.status.admin',

				'social.index',
				'social.index.admin',
				'social.store',
				'social.store.admin',
				'social.show',
				'social.show.admin',
				'social.edit',
				'social.edit.admin',
				'social.status',
				'social.status.admin',
				'social.update',
				'social.update.admin',

				'favorite.index',
				'favorite.index.admin',
				'favorite.store',
				'favorite.store.admin',
				'favorite.destroy',
				'favorite.destroy.admin',

				'report.index',
				'report.index.admin',
				'report.report',
				'report.report.admin',
				'report.status',
				'report.status.admin',
				'report.destroy',
				'report.destroy.admin',

			],
		],

		'user' => [
			'permissions' => [

				'auth.validateAccessToken',
				'auth.validateAccessToken.user',
				'auth.refresh',
				'auth.refresh.user',

				'state.index',
				'state.index.user',
				'state.cities',
				'state.cities.user',

				'category.index',
				'category.index.user',
				'category.getVisitCards',
				'category.getVisitCards.user',
				'category.show',
				'category.show.user',
				'category.children',
				'category.children.user',
				'category.parent',
				'category.parent.user',

				'photo.storeAvatar',
				'photo.storeAvatar.user',

				'notification.index',
				'notification.index.user',
				'notification.deliver',
				'notification.deliver.user',
				'notification.click',
				'notification.click.user',

				'visitCard.index',
				'visitCard.index.user',
				'visitCard.create',
				'visitCard.create.user',
				'visitCard.store',
				'visitCard.store.user',
				'visitCard.show',
				'visitCard.show.user',
				'visitCard.edit',
				'visitCard.edit.user',
				'visitCard.update',
				'visitCard.update.user',
				'visitCard.status',
				'visitCard.status.user',
				'visitCard.viewCount',
				'visitCard.viewCount.user',

				'social.index',
				'social.index.user',
				'social.store',
				'social.store.user',
				'social.show',
				'social.show.user',
				'social.edit',
				'social.edit.user',
				'social.status',
				'social.status.user',
				'social.update',
				'social.update.user',

				'favorite.index',
				'favorite.index.user',
				'favorite.store',
				'favorite.store.user',
				'favorite.destroy',
				'favorite.destroy.user',

				'report.report',
				'report.report.user',

			],
		],

	];


	protected $permissions = [

		'auth.validateAccessToken',
		'auth.validateAccessToken.admin',
		'auth.validateAccessToken.user',
		'auth.refresh',
		'auth.refresh.admin',
		'auth.refresh.user',

		'state.index',
		'state.index.admin',
		'state.index.user',
		'state.store',
		'state.store.admin',
		'state.cities',
		'state.cities.admin',
		'state.cities.user',
		'state.tree',
		'state.tree.admin',
		'state.show',
		'state.show.admin',

		'city.store',
		'city.store.admin',
		'city.show',
		'city.show.admin',
		'city.update',
		'city.update.admin',

		'category.index',
		'category.index.admin',
		'category.index.user',
		'category.getVisitCards',
		'category.getVisitCards.admin',
		'category.getVisitCards.user',
		'category.store',
		'category.store.admin',
		'category.store.user',
		'category.show',
		'category.show.admin',
		'category.show.user',
		'category.edit',
		'category.edit.admin',
		'category.edit.user',
		'category.update',
		'category.update.admin',
		'category.update.user',
		'category.children',
		'category.children.user',
		'category.children.admin',
		'category.parent',
		'category.parent.admin',
		'category.parent.user',

		'option.index',
		'option.store',
		'option.show',
		'option.edit',
		'option.update',

		'photo.store',
		'photo.store.admin',
		'photo.storeAvatar',
		'photo.storeAvatar.admin',
		'photo.storeAvatar.user',
		'photo.update',
		'photo.update.admin',

		'notification.index',
		'notification.index.admin',
		'notification.index.user',
		'notification.deliver',
		'notification.deliver.admin',
		'notification.deliver.user',
		'notification.click',
		'notification.click.admin',
		'notification.click.user',

		'user.index',
		'user.index.admin',
		'user.edit',
		'user.edit.admin',
		'user.show',
		'user.show.admin',
		'user.update',
		'user.update.admin',
		'user.destroy',
		'user.destroy.admin',
		'user.search',
		'user.search.admin',

		'visitCard.index',
		'visitCard.index.admin',
		'visitCard.index.user',
		'visitCard.create',
		'visitCard.create.admin',
		'visitCard.create.user',
		'visitCard.store',
		'visitCard.store.admin',
		'visitCard.store.user',
		'visitCard.show',
		'visitCard.show.admin',
		'visitCard.show.user',
		'visitCard.edit',
		'visitCard.edit.admin',
		'visitCard.edit.user',
		'visitCard.update',
		'visitCard.update.admin',
		'visitCard.update.user',
		'visitCard.status',
		'visitCard.status.admin',
		'visitCard.status.user',
		'visitCard.viewCount',
		'visitCard.viewCount.admin',
		'visitCard.viewCount.user',

		'social.index',
		'social.index.admin',
		'social.index.user',
		'social.store',
		'social.store.admin',
		'social.store.user',
		'social.show',
		'social.show.admin',
		'social.show.user',
		'social.edit',
		'social.edit.admin',
		'social.edit.user',
		'social.status',
		'social.status.admin',
		'social.status.user',
		'social.update',
		'social.update.admin',
		'social.update.user',

		'favorite.index',
		'favorite.index.admin',
		'favorite.index.user',
		'favorite.store',
		'favorite.store.admin',
		'favorite.store.user',
		'favorite.destroy',
		'favorite.destroy.admin',
		'favorite.destroy.user',

		'report.index',
		'report.index.admin',
		'report.report',
		'report.report.admin',
		'report.report.user',
		'report.status',
		'report.status.admin',
		'report.destroy',
		'report.destroy.admin',

	];

	/**
	 * Roles
	 *
	 * @return array()
	 */
	public function roles()
	{
		return $this->roles;
	}

	/**
	 * Permissions
	 *
	 * @param  $name
	 * @return array|bool|string
	 */
	public function permissions($name = '')
	{
		$single = (in_array($name, $this->permissions) ? $name : false);
		return $single;
	}


	/**
	 * Run the Seeder
	 *
	 * @return void
	 */
	public function run()
	{
		DB::statement('SET FOREIGN_KEY_CHECKS=0');
		DB::table('permission_role')->truncate();
		DB::table('permissions')->truncate();
		DB::table('roles')->truncate();

		foreach ($this->permissions as $item) {
			$permission = new \App\Models\User\Permission();
			$permission->name = $item;
			$permission->save();
		}

		foreach ($this->roles() as $key => $val) {
			$this->command->info(" ");
			$this->command->info('Creating/updating the \'' . $key . '\' role');
			$this->command->info('-----------------------------------------');
			$val['name'] = $key;
			$this->reset($val);
		}
//        $this->cleanup();
	}


	/**
	 * Reset Role, Permissions & Users
	 *
	 * @param  $role
	 * @return void
	 */
	public function reset($role)
	{
		$commandBullet = '  -> ';

		// The Old Role
		$originalRole = Role::where('name', $role['name'])->first();
		if ($originalRole) Role::where('id', $originalRole->id)->update(['name' => $role['name'] . '__remove']);

		// The New Role
		$newRole = new Role();
		$newRole->name = $role['name'];
		if (isset($role['display_name'])) $newRole->display_name = $role['display_name']; // optional
		if (isset($role['description'])) $newRole->description = $role['description']; // optional
		$newRole->save();
		$this->command->info($commandBullet . "Created $role[name] role");

		// Set the Permissions (if they exist)
		$pcount = 0;
		if (!empty($role['permissions'])) {
			foreach ($role['permissions'] as $permission_name) {

				$permission = $this->permissions($permission_name);
				if ($permission === false || (!$permission_name)) {
					$this->command->error($commandBullet . "Failed to attach permission '$permission_name'. It does not exist");
					continue;
				}

				$newPermission = Permission::where('name', $permission_name)->first();

				if (!$newPermission) {
					$newPermission = new Permission();
					$newPermission->name = $permission;
					if (isset($permission['display_name'])) $newPermission->display_name = $permission['display_name']; // optional
					if (isset($permission['description'])) $newPermission->description = $permission['description']; // optional
					$newPermission->save();
				}
				$newRole->attachPermission($newPermission);
				$pcount++;
			}
		}
		$this->command->info($commandBullet . "Attached $pcount permissions to $role[name] role");

		// Update old records
		if ($originalRole) {
			$userCount = 0;
			$RoleUsers = DB::table(Config::get('entrust.role_user_table'))->where('role_id', $originalRole->id)->get();
			foreach ($RoleUsers as $user) {
				$u = User::where('id', $user->user_id)->first();
				$u->attachRole($newRole);
				$userCount++;
			}
			$this->command->info($commandBullet . "Updated role attachment for $userCount users");

			Role::where('id', $originalRole->id)->delete(); // will also remove old role_user records
			$this->command->info($commandBullet . "Removed the original $role[name] role");
		}
	}


	/**
	 * Cleanup()
	 * Remove any roles & permissions that have been removed
	 *
	 * @return void
	 */
	public function cleanup()
	{
		$commandBullet = '  -> ';
		$this->command->info(" ");
		$this->command->info('Cleaning up roles & permissions:');
		$this->command->info('--------------------------------');

		$storedRoles = Role::all();
		if (!empty($storedRoles)) {
			$definedRoles = $this->roles();
			foreach ($storedRoles as $role) {
				if (!array_key_exists($role->name, $definedRoles)) {
					Role::where('name', $role->name)->delete();
					$this->command->info($commandBullet . 'The \'' . $role->name . '\' role was removed');
				}
			}
		}
		$storedPerms = DB::table(Config::get('entrust.permissions_table'))->get();
		if (!empty($storedPerms)) {
			$definedPerms = $this->permissions();
			foreach ($storedPerms as $perm) {
				if (!array_key_exists($perm->name, $definedPerms)) {
					DB::table(Config::get('entrust.permissions_table'))->where('name', $perm->name)->delete();
					$this->command->info($commandBullet . 'The \'' . $perm->name . '\' permission was removed');
				}
			}
		}
		$this->command->info($commandBullet . 'Done');
		$this->command->info(" ");
	}

}

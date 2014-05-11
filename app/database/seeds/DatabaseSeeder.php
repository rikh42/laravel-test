<?php


use app\models\User;


class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

		// $this->call('UserTableSeeder');

        // call our class and run our seeds
        $this->call('BearTestSeeder');


        // Create some roles...
        DB::table('roles')->delete();
        DB::table('permissions')->delete();
        DB::table('users')->delete();

        // Create some Roles
        $adminRole = Role::create(['name'=>'Admin']);
        $userRole = Role::create(['name'=>'DealerUser']);

        // Create some Permissions
        $createPerm = Permission::create(['name'=>'jobs.create', 'display_name'=>'Create Jobs']);
        $deletePerm = Permission::create(['name'=>'jobs.delete', 'display_name'=>'Delete Jobs']);

        // assign permissions to roles
        $adminRole->perms()->sync([$createPerm->id, $deletePerm->id]);
        $userRole->perms()->sync([$createPerm->id]);

        // clear our database -
        $user = User::create([
            'firstname'=>'Rik',
            'email'=>'rik@rik.org',
            'password' => Hash::make('secret'),
        ]);

        // Assign some roles to the user
        $user->attachRole($adminRole);
        $user->attachRole($userRole);

    }

}
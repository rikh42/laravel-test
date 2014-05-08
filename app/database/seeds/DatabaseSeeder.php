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

        // clear our database -
        DB::table('users')->delete();
        User::create([
            'firstname'=>'Rik',
            'email'=>'rik@rik.org',
            'password' => Hash::make('secret'),

        ]);

    }

}
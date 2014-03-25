<?php


class BearTestSeeder extends Seeder {

    public function run() {

        // clear our database -
        DB::table('bears')->delete();

        // Add some data
        $bearLawly = Bear::create(array(
            'name'         => 'Lawly',
            'votes'         => 7
        ));

        $bearFrank = Bear::create(array(
            'name'         => 'Frank',
            'votes'         => 99
        ));

        $this->command->info('The bears are alive!');

    }
}


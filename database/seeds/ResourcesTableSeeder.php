<?php

use Illuminate\Database\Seeder;

class ResourcesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('resources')->truncate();

        foreach(range(0, 29) as $index) {
            $this->command->info('ResourcesTableSeeder [' . ($index + 1) . '/30]');

	        DB::table('resources')->insert([
	        	'id'			=> $index + 1,
	        	'user_id'		=> $index + 1,
	        	'class_id'		=> rand(1, 5),
	        	'subject_id'	=> rand(1, 10)
	        ]);
        }
    }
}

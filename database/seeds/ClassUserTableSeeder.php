<?php

use Illuminate\Database\Seeder;

class ClassUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('class_user')->truncate();

        foreach(range(0, 29) as $index) {
            $this->command->info('ClassUserTableSeeder [' . ($index + 1) . '/30]');

	        DB::table('class_user')->insert([
	        	'id'		=> $index + 1,
	        	'user_id'	=> $index + 1,
	        	'class_id'	=> rand(1, 5)
	        ]);
        }
    }
}

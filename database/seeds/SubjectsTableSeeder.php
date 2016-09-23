<?php

use Illuminate\Database\Seeder;

class SubjectsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		DB::table('subjects')->truncate('subjects');

        foreach(range(0, 29) as $index) {
            $this->command->info('SubjectsTableSeeder [' . ($index + 1) . '/30]');

            DB::table('subjects')->insert([
                'id'    => $index + 1,
                'name'  => str_random(10),
                'is_conventional' => rand(0, 1)
            ]);
        }
    }
}

<?php

use Illuminate\Database\Seeder;

class ClassesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		DB::table('classes')->truncate('classes');

        $levels = [1, 2, 3, 4];
        $years = ['2015-2016', '2016-2017', '2017-2018', '2018-2019'];

        foreach(range(0, 9) as $index) {
            $this->command->info('ClassesTableSeeder [' . ($index + 1) . '/10]');

            DB::table('classes')->insert([
                'id'            => $index + 1,
            	'name'			=> str_random(10),
            	'year_level'	=> $levels[$index % count($levels) === 0],
            	'school_year'	=> $years[$index % count($years) === 0],
            ]);
        }
    }
}

<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		DB::table('users')->truncate('users');
        
        $password = bcrypt('123');

        foreach(range(0, 49) as $index) {
            $this->command->info('UsersTableSeeder [' . ($index + 1) . '/50]');

            DB::table('users')->insert([
                'id'            => $index + 1,
            	'email'			=> $index === 0 ? 'admin@gmail.com' : str_random(10) . '@gmail.com',
            	'password'		=> $password,
            	'first_name'	=> $index === 0 ? 'John' : str_random(10),
            	'middle_name'	=> $index === 0 ? 'Xavier' : str_random(10),
            	'last_name'		=> $index === 0 ? 'Doe' : str_random(10),
                'user_type_id'  => $index === 0 ? 3: rand(1, 3)
            ]);
        }
    }
}

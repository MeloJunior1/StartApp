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
        factory(App\Models\User::class, 1)->create([
            'admin' => 1,
            'verified' => 1,
            'email' => 'eclesiomelo.1@outlook.com',
            'companyName' => 'Compania Main'
        ]);
    }
}

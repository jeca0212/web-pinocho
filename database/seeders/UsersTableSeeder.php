<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;


class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    { 
        Admin::create([
 

            'username' => 'fauno',
            'password' => Hash::make('Je730732:)'),
            
        ]);
    }
}

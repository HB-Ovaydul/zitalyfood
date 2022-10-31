<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // Supar Admin Create

        Admin::create([
            'name'      => 'Admin',
            'email'     => 'hovaydul@gmail.com',
            'cell'      => '07510886524',
            'username'  => 'Admin',
            'password'  => Hash::make('admin'),
        ]);
    }
}

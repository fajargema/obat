<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User();
        $user->name = "Administrator";
        $user->email = "admin@admin.com";
        $user->password = Hash::make('1234');
        $user->roles = 2;
        $user->nip = 20200120037;
        $user->save();
    }
}

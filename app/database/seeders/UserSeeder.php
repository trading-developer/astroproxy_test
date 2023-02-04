<?php
/**
 * php artisan db:seed --class=UserSeeder
 */

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::firstOrCreate(['name' => 'admin'], [
            'name' => 'admin',
            'email' => 'admin@astroproxy.com',
            'password' => Hash::make('admin'),
        ]);
    }
}

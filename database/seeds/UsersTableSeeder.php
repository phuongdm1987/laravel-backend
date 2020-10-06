<?php
declare(strict_types=1);

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use TCG\Voyager\Models\Role;
use TCG\Voyager\Models\User;

/**
 * Class UsersTableSeeder
 * @package Database\Seeders
 */
class UsersTableSeeder extends Seeder
{
    /**
     * Auto generated seed file.
     *
     * @return void
     */
    public function run(): void
    {
        if (User::count() === 0) {
            $role = Role::where('name', 'admin')->firstOrFail();

            User::create([
                'name' => 'Admin',
                'email' => 'admin@admin.com',
                'password' => bcrypt('password'),
                'email_verified_at' => Carbon::now(),
                'remember_token' => Str::random(60),
                'role_id' => $role->id,
            ]);
        }
    }
}

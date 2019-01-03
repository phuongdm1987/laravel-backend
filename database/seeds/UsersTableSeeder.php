<?php
declare(strict_types=1);

use Illuminate\Database\Seeder;

/**
 * Class UsersTableSeeder
 */
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        factory(\App\Entities\User::class)->state('superAdmin')->create();
    }
}

<?php
declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use TCG\Voyager\Models\Menu;

/**
 * Class MenusTableSeeder
 * @package Database\Seeders
 */
class MenusTableSeeder extends Seeder
{
    /**
     * Auto generated seed file.
     *
     * @return void
     */
    public function run(): void
    {
        Menu::firstOrCreate([
            'name' => 'admin',
        ]);
    }
}

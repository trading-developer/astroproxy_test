<?php
/**
 * php artisan db:seed --class=ServicesSeeder
 */

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;

class ServicesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $services = [
            [
                'name' => 'Прокси 1gb',
                'description' => 'Предоставление прокси с лимитом в 1gb',
                'price' => 11.9,
            ],
            [
                'name' => 'Прокси 2gb',
                'description' => 'Предоставление прокси с лимитом в 2gb',
                'price' => 19.9,
            ],
            [
                'name' => 'Прокси 5gb',
                'description' => 'Предоставление прокси с лимитом в 5gb',
                'price' => 49.9,
            ],
            [
                'name' => 'Прокси not limit',
                'description' => 'Предоставление прокси без лимита',
                'price' => 79.9,
            ],
        ];

        foreach ($services as $service) {
            Service::firstOrCreate(['name' => $service['name']], [
                'name' => $service['name'],
                'description' => $service['description'],
                'price' => $service['price'],
            ]);
        }

    }
}

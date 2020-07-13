<?php

use Illuminate\Database\Seeder;
use App\Models\Store;

class StoresTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Store::create([
			'name' => 'La Valentina Restaurant',
			'code' => 'v-0001',
			'service' => 'full',
			'address' => 'Jirón Ayacucho 255, Trujillo 13001',
			'phone' => '+5144201176',
			'attention_schedule' => "Lunues a Sábado 7:30am - 11:45pm\nDomingos 8:00am - 4:00pm",
			'latitude' => '-8.115727',
			'longitude' => '-79.028175',
			'order' => '0',
			'status' => 'enabled'
        ]);
    }
}

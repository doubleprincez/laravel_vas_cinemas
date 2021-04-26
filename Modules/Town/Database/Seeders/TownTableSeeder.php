<?php

namespace Modules\Town\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Town\Entities\Town;

class TownTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Town::firstOrCreate(['name' => 'Lagos', 'code' => 'lagos']);
        Town::firstOrCreate(['name' => 'Abeokuta', 'code' => 'abeokuta']);
    }
}

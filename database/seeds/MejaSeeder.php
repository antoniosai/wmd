<?php

use Illuminate\Database\Seeder;

use App\Model\Meja\Meja;

class MejaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 1; $i <= 29; $i++)
        {
            $meja = new Meja;
            $meja->no_meja = 'Meja ' . $i;
            $meja->kapasitas = 4;
            $meja->save();

        }
    }
}

<?php

use CentralCondo\Entities\Portal\Condominium\Finality;
use Illuminate\Database\Seeder;

class FinalityTableSeeder extends Seeder
{

    public function run()
    {

        factory(Finality::class)->create([
            'name' => 'Residencial',
            'active' => 'y'
        ]);

        factory(Finality::class)->create([
            'name' => 'Comercial',
            'active' => 'y'
        ]);

        factory(Finality::class)->create([
            'name' => 'Residencial e Comercial',
            'active' => 'y'
        ]);

    }

}
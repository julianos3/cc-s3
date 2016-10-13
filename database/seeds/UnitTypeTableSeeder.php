<?php

use CentralCondo\Entities\Portal\Condominium\Unit\UnitType;
use Illuminate\Database\Seeder;

class UnitTypeTableSeeder extends Seeder
{

    public function run()
    {

        factory(UnitType::class)->create([
            'name' => 'Apartamento',
            'label' => 'APTO',
            'active' => 'y'
        ]);

        factory(UnitType::class)->create([
            'name' => 'Casa',
            'label' => 'CASA',
            'active' => 'y'
        ]);

        factory(UnitType::class)->create([
            'name' => 'Garagem',
            'label' => 'GARAGEM',
            'active' => 'y'
        ]);

        factory(UnitType::class)->create([
            'name' => 'Loja',
            'label' => 'LOJA',
            'active' => 'y'
        ]);

        factory(UnitType::class)->create([
            'name' => 'Sala',
            'label' => 'SALA',
            'active' => 'y'
        ]);

    }

}
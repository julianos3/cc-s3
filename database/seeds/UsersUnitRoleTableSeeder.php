<?php

use CentralCondo\Entities\Portal\Condominium\Unit\UsersUnitRole;
use Illuminate\Database\Seeder;

class UsersUnitRoleTableSeeder extends Seeder
{

    public function run()
    {

        factory(UsersUnitRole::class)->create([
            'name' => 'Proprietário',
            'active' => 'y'
        ]);

        factory(UsersUnitRole::class)->create([
            'name' => 'Funcionário',
            'active' => 'y'
        ]);

        factory(UsersUnitRole::class)->create([
            'name' => 'Inquilino',
            'active' => 'y'
        ]);

        factory(UsersUnitRole::class)->create([
            'name' => 'Não informado',
            'active' => 'y'
        ]);

        factory(UsersUnitRole::class)->create([
            'name' => 'Procurador',
            'active' => 'y'
        ]);
    }

}
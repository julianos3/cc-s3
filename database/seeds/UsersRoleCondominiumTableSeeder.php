<?php

use CentralCondo\Entities\Portal\Condominium\UsersRoleCondominium;
use Illuminate\Database\Seeder;

class UsersRoleCondominiumTableSeeder extends Seeder
{

    public function run()
    {

        factory(UsersRoleCondominium::class)->create([
            'name' => 'Síndico',
            'active' => 'y'
        ]);

        factory(UsersRoleCondominium::class)->create([
            'name' => 'Subsíndico',
            'active' => 'y'
        ]);

        factory(UsersRoleCondominium::class)->create([
            'name' => 'Síndico Profissional',
            'active' => 'y'
        ]);

        factory(UsersRoleCondominium::class)->create([
            'name' => 'Proprietário Morador',
            'active' => 'y'
        ]);

        factory(UsersRoleCondominium::class)->create([
            'name' => 'Proprietário não Morador',
            'active' => 'y'
        ]);

        factory(UsersRoleCondominium::class)->create([
            'name' => 'Inquilino',
            'active' => 'y'
        ]);

        factory(UsersRoleCondominium::class)->create([
            'name' => 'Administradora de Condomínio',
            'active' => 'y'
        ]);

        factory(UsersRoleCondominium::class)->create([
            'name' => 'Funcionário do Condomínio',
            'active' => 'y'
        ]);

        factory(UsersRoleCondominium::class)->create([
            'name' => 'Gerente do Condomínio',
            'active' => 'y'
        ]);
        
        factory(UsersRoleCondominium::class)->create([
            'name' => 'Imobiliária',
            'active' => 'y'
        ]);

        factory(UsersRoleCondominium::class)->create([
            'name' => 'Conselho Fiscal',
            'active' => 'y'
        ]);
    }

}
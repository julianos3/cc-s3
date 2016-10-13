<?php

use CentralCondo\Entities\Portal\UsersRole;
use Illuminate\Database\Seeder;

class UsersRoleTableSeeder extends Seeder
{

    public function run()
    {

        factory(UsersRole::class)->create([
            'name' => 'Usuário',
            'active' => 'y'
        ]);

        /*
        factory(User::class)->create([
            'name' => 'User',
            'email' => 'user@user.com',
            'password' => bcrypt('123456'),
            'remember_token' => str_random(10)
        ])->client()->save(factory(Client::class)->make());

        factory(User::class)->create([
            'name' => 'Admin',
            'email' => 'admin@user.com',
            'password' => bcrypt('123456'),
            'role' => 'Admin',
            'remember_token' => str_random(10)
        ])->client()->save(factory(Client::class)->make());

        //factory(User::class, 10)->create();
        factory(User::class, 10)->create()->each(function($u) {
            $u->client()->save(factory(Client::class)->make());
        });

        factory(User::class, 3)->create([
            'role' => 'deliveryman'
        ]);
        */


    }

}
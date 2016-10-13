<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call(UsersRoleTableSeeder::class);
        $this->call(UsersRoleCondominiumTableSeeder::class);
        $this->call(UsersUnitRoleTableSeeder::class);
        $this->call(UnitTypeTableSeeder::class);
        $this->call(BlockNomemclatureTableSeeder::class);
        $this->call(FinalityTableSeeder::class);

        Model::reguard();
    }
}

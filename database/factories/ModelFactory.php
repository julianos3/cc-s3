<?php

$factory->define(CentralCondo\Entities\Portal\UsersRole::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'active' => 's'
    ];
});

$factory->define(CentralCondo\Entities\Portal\Condominium\UsersRoleCondominium::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'active' => 's'
    ];
});

$factory->define(CentralCondo\Entities\Portal\Condominium\Unit\UsersUnitRole::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'active' => 's'
    ];
});

$factory->define(CentralCondo\Entities\Portal\Condominium\Unit\UnitType::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'label' => $faker->name,
        'active' => 's'
    ];
});

$factory->define(CentralCondo\Entities\Portal\Condominium\Block\BlockNomemclature::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'label' => $faker->name,
        'active' => 's',
        'type' => 'l'
    ];
});

$factory->define(CentralCondo\Entities\Portal\Condominium\Finality::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'active' => 's'
    ];
});
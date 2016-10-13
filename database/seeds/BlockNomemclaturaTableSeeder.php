<?php

use CentralCondo\Entities\Portal\Condominium\Block\BlockNomemclature;
use Illuminate\Database\Seeder;

class BlockNomemclatureTableSeeder extends Seeder
{

    public function run()
    {

        factory(BlockNomemclature::class)->create([
            'name' => 'Bloco 1, Bloco 2, Bloco 3...',
            'label' => 'Bloco 1',
            'active' => 'y',
            'type' => 'n'
        ]);

        factory(BlockNomemclature::class)->create([
            'name' => 'Bloco A, Bloco B, Bloco C...',
            'label' => 'Bloco A',
            'active' => 'y',
            'type' => 'l'
        ]);

        factory(BlockNomemclature::class)->create([
            'name' => 'Torre 1, Torre 2, Torre 3...',
            'label' => 'Torre 1',
            'active' => 'y',
            'type' => 'n'
        ]);

        factory(BlockNomemclature::class)->create([
            'name' => 'Torre A, Torre B, Torre C...',
            'label' => 'Torre A',
            'active' => 'y',
            'type' => 'l'
        ]);

        factory(BlockNomemclature::class)->create([
            'name' => 'Quadra 1, Quadra 2, Quadra 3...',
            'label' => 'Quadra 1',
            'active' => 'y',
            'type' => 'n'
        ]);

        factory(BlockNomemclature::class)->create([
            'name' => 'Quadra A, Quadra B, Quadra C...',
            'label' => 'Quadra A',
            'active' => 'y',
            'type' => 'l'
        ]);

        factory(BlockNomemclature::class)->create([
            'name' => 'Lote 1, Lote 2, Lote 3...',
            'label' => 'Lote 1',
            'active' => 'y',
            'type' => 'n'
        ]);

        factory(BlockNomemclature::class)->create([
            'name' => 'Lote A, Lote B, Lote C...',
            'label' => 'Lote A',
            'active' => 'y',
            'type' => 'l'
        ]);

    }

}
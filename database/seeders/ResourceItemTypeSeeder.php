<?php

namespace Database\Seeders;

use App\Models\ResourceItemType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ResourceItemTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $resourceTypes = [
            ['id' =>1 ,'type' => 'PDF'],
            ['id' =>2 ,'type' => 'HTML'],
            ['id' =>3 ,'type' => 'LINK']
        ];

        ResourceItemType::query()->upsert($resourceTypes, 'id');
    }
}

<?php

namespace Database\Seeders;

use App\Models\ResourceDetail;
use App\Models\ResourceItem;
use App\Models\ResourceItemType;
use Illuminate\Database\Seeder;

class ResourceItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ResourceItem::factory()
            ->has(ResourceDetail::factory([
                'key' => 'file_name',
                'value' => 'Damjan Krivacevic - CV.pdf'
            ]))
            ->create([
                'title' => 'Some pdf resource title',
                'resource_item_type_id' => ResourceItemType::firstWhere('type', 'PDF')->id
            ]);

        ResourceItem::factory()
            ->has(ResourceDetail::factory([
                'key' => 'description',
                'value' => 'Some text here that should be a description'
            ]))
            ->has(ResourceDetail::factory([
                'key' => 'html_snippet',
                'value' => '<h1>Hello there lovely people<h1>'
            ]))
            ->create([
                'title' => 'Some HTML resource title',
                'resource_item_type_id' => ResourceItemType::firstWhere('type', 'HTML')->id
            ]);

        ResourceItem::factory()
            ->has(ResourceDetail::factory([
                'key' => 'link',
                'value' => 'http://www.are-you-with-me.com'
            ]))
            ->has(ResourceDetail::factory([
                'key' => 'open_in_new_tab',
                'value' => 'true'
            ]))
            ->create([
                'title' => 'Some link resource title',
                'resource_item_type_id' => ResourceItemType::firstWhere('type', 'LINK')->id
            ]);
    }
}

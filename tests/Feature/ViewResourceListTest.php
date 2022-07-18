<?php

namespace Tests\Feature;

use App\Models\ResourceAttachment;
use App\Models\ResourceItem;
use App\Models\ResourceItemType;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ViewResourceListTest extends TestCase
{
    use DatabaseMigrations;

    private $pdfResource;

    public function setUp() :void
    {
        parent::setUp();

        $this->seed();

        $this->pdfResource = $this->makePdfResource();
    }

    /** @test */
    public function visitor_can_view_a_resource_listing()
    {
        $this->assertDatabaseHas('resource_items', [
            'title' => 'Some pdf resource title',
        ]);

        $view = $this->get('/');

        $view->assertStatus(200);
        $view->assertSee('Some pdf resource title');
    }

    private function makePdfResource()
    {
        return ResourceItem::factory()
            ->has(ResourceAttachment::factory([
                'filename' => 'Some name',
                'path' => 'some/cool/path/here.txt'
            ]))
            ->create([
                'title' => 'Some pdf resource title',
                'resource_item_type_id' => ResourceItemType::firstWhere('type', 'PDF')->id
            ]);
    }
}

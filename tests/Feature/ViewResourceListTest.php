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

    public function setUp() :void
    {
        parent::setUp();

        $this->seed();
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_the_application_returns_a_successful_response()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    /** @test */
    public function visitor_can_view_a_resource_listing()
    {

        $resourcePdf = ResourceItem::factory()
            ->has(ResourceAttachment::factory([
                'filename' => 'Some name',
                'path' => 'some/cool/path/here.txt'
            ]))
            ->create([
                'title' => 'Some resource title',
                'resource_item_type_id' => ResourceItemType::firstWhere('type', 'PDF')->id
            ]);

        $this->assertDatabaseHas('resource_items', [
            'title' => 'Some resource title',
        ]);

        $view = $this->get('/');

        $view->assertStatus(200);
        $view->assertSee('Some resource title');


    }
}

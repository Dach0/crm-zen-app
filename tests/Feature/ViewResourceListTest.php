<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ViewResourceListTest extends TestCase
{
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
            ->has(ResourceAttachment::factory()->make([
                'filename' => 'Some name',
                'path' => 'some/cool/path/here.txt'
            ]))
            ->create([
                'title' => 'Some resource title',
                'resource_item_type_id' => ResourceItemType::firstWhere('type', 'PDF')
            ]);


    }
}

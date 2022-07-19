<?php

namespace Tests\Feature;

use App\Models\ResourceAttachment;
use App\Models\ResourceDetail;
use App\Models\ResourceItem;
use App\Models\ResourceItemType;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ViewResourceListTest extends TestCase
{
    use DatabaseMigrations;

    private $pdfResource;
    private $htmlResource;
    private $linkResource;

    public function setUp() :void
    {
        parent::setUp();

        $this->seed();

        $this->pdfResource = $this->makePdfResource();
        $this->htmlResource = $this->makeHtmlResource();
        $this->htmlResource = $this->makeLinkResource();
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
        $view->assertSee('Some HTML resource title');
        $view->assertSee('Some link resource title');
    }

    private function makePdfResource()
    {
        return ResourceItem::factory()
            ->has(ResourceDetail::factory([
                'key' => 'file_name',
                'value' => 'Some name'
            ]))
            ->has(ResourceDetail::factory([
                'key' => 'file_path',
                'value' => 'some/cool/path/here.txt'
            ]))
            ->create([
                'title' => 'Some pdf resource title',
                'resource_item_type_id' => ResourceItemType::firstWhere('type', 'PDF')->id
            ]);
    }

    private function makeHtmlResource()
    {
        return ResourceItem::factory()
            ->has(ResourceDetail::factory([
                'key' => 'description',
                'value' => 'Some long text here that should be a description'
            ]))
            ->has(ResourceDetail::factory([
                'key' => 'html_snippet',
                'value' => '<h1>Hello there lovely people<h1>'
            ]))
            ->create([
                'title' => 'Some HTML resource title',
                'resource_item_type_id' => ResourceItemType::firstWhere('type', 'HTML')->id
            ]);
    }

    private function makeLinkResource()
    {
        return ResourceItem::factory()
            ->has(ResourceDetail::factory([
                'key' => 'link',
                'value' => 'www.are-you-with-me.com'
            ]))
            ->has(ResourceDetail::factory([
                'key' => 'open_in_new_tab',
                'value' => 'true'
            ]))
            ->create([
                'title' => 'Some link resource title',
                'resource_item_type_id' => ResourceItemType::firstWhere('type', 'HTML')->id
            ]);
    }
}

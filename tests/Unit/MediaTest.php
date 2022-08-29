<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\User;
use App\Models\Category;
use App\Models\Media;

class MediaTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_new_user_can_show_all_media()
    {
        
        $user = User::factory()->create();
 
        $response = $this->actingAs($user)
                         ->get('/media');
        $response->assertStatus(200);
    }

    public function test_new_user_can_store_new_media()
    {
        $category = Category::factory()->create();
        $user = User::find($category->user_id);
        $response = $this->actingAs($user)
                         ->post('/save-media', [
                            "form-name" => "Test Name",
                            "form-category" => $category->id,
                            "form-description" => "99",
                            "form-source" => "99"
                        ]);
        $response->assertRedirect('/media');
        
    }

    public function test_new_user_can_update_media()
    {
        $media = Media::factory()->create();
        $user = User::find($media->user_id);
        $response = $this->actingAs($user)
                         ->post('/update-media', [
                            "form-id" => $media->id,
                            "form-name" => "Test Media Name",
                            "form-category" => $media->category_id,
                            "form-description" => "Lorem ipsum, lorem.",
                            "form-source" => "http://loremipsum.com"
                        ]);
        $response->assertRedirect('/media');
        
    }

    public function test_new_user_can_delete_media()
    {
        $media = Media::factory()->create();
        $user = User::find($media->user_id);

        $response = $this->actingAs($user)
                         ->get('/delete-media/'.$media->id);
        $response->assertRedirect('/media');
        
    }
}

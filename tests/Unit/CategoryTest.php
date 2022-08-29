<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\User;
use App\Models\Category;

class CategoryTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */

    public function test_new_user_can_show_new_category()
    {
        
        $user = User::factory()->create();
 
        $response = $this->actingAs($user)
                         ->get('/category');
        $response->assertStatus(200);
    }

    public function test_new_user_can_store_new_category()
    {
        $user = User::factory()->create();
 
        $response = $this->actingAs($user)
                         ->post('/save-category', [
                            "form-name" => "Test Name",
                            "form-rank" => "99"
                        ]);
        $response->assertRedirect('/category');
        
    }

    public function test_new_user_can_update_category()
    {
        $category = Category::factory()->create();
        $user = User::find($category->user_id);
 
        $response = $this->actingAs($user)
                         ->post('/update-category', [
                            "form-id" => $category->id,
                            "form-name" => "Change Name",
                            "form-rank" => "100"
                        ]);
        $response->assertRedirect('/category');
        
    }

    public function test_new_user_can_delete_category()
    {
        $category = Category::factory()->create();
        $user = User::find($category->user_id);

        $response = $this->actingAs($user)
                         ->get('/delete-category/'.$category->id);
        $response->assertRedirect('/category');
        
    }
    

    
}

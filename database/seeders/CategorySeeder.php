<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::where('email', "test-jack@test.com")->first();
        if(isset($user))
        {
            DB::table('category')->insert([
                'user_id' => $user->id,
                'name' => "Games",
                'rank' => '1'
            ]);
    
            DB::table('category')->insert([
                'user_id' => $user->id,
                'name' => "Movies",
                'rank' => '2'
            ]);
    
            DB::table('category')->insert([
                'user_id' => $user->id,
                'name' => "Music",
                'rank' => '3'
            ]);

        }

        
    }
}

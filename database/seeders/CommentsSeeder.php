<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
// こいつらは何だ
use Illuminate\Support\Facades\DB; 
use Illuminate\Support\Str;

use App\Models\Comment;
use App\Models\Tweet;
use App\Models\User;

class CommentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Comment::factory()->count(10)->create();
    }
}

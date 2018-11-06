<?php

use Illuminate\Database\Seeder;

class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Illuminate\Support\Facades\DB::table('tags')->delete();
        \Illuminate\Support\Facades\DB::table('post_tag')->delete();
        $tags = ['PHP', 'Laravel', 'Vue', 'JavaScript','React'];
        $tags_objects = [];
        foreach($tags as $tag) {
            $t = new \App\Tag();
            $t->name = $tag;
            $t->slug = strtolower($tag);
            $t->save();
            $tags_objects[] = $t;
        }

        $posts = \App\Post::all();
        foreach($posts as $post) {
            $i = rand(0, count($tags) - 1);
            shuffle($tags_objects);
            $tag = $tags_objects[$i];
            $post->tags()->sync($tag);
        }

    }
}

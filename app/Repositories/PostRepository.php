<?php


namespace App\Repositories;

use App\Models\User;
use MongoDB\BSON\ObjectId;
use App\Models\Like;
use App\Models\Post;
use Illuminate\Http\Request;

class PostRepository
{
    public function getPost($id)
    {
        $post = Post::firstWhere('_id',$id);
        if (!$post) {
            exit('post not found');
        }
        return $post;
    }

    public function createPost(string $title, string $body, string $user_id)
    {
        return Post::create([
            'title'=>$title,
            'body'=>$body,
            'user_id'=>$user_id,
            'is_liked'=>false,
            'deleted_at'=>null
        ]);
    }

    public function editPost(Request $request, $id)
    {
        $post = Post::firstWhere('_id',$id);
        if (!$post){
            exit ('post not found');
        } else {
            $post->title = $request->get('title');
            $post->body = $request->get('body');
        }

        return $post;
    }

    public function deletePost($id)
    {
        $post = Post::firstWhere('_id',$id);

        if (!$post){
            exit ('post not found');
        }

        return $post->delete();
    }

    public function listingPosts(string $userId){
        $posts = Post::all();
        $posts->transform(function ($post, $key){
            $post->likes_count = $post->likes()->count();
            $post->user = User::firstWhere('_id', new ObjectId($post->user_id));
            $post->is_liked= \DB::table('likes')
                ->where('user_id', $userId)
                ->where('post_id', (string) $post->_id)
                ->exists();
            return $post;
        });
        return $posts;
    }



    public function markLike($id, String $user_id)
    {
        $post = Post::firstWhere('_id',$id);

        if (!$post){
            exit ('post not found');
        }

        Like::create([
            'post_id'=>$id,
            'user_id'=>$user_id
        ]);
    }
}

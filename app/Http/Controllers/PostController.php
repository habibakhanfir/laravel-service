<?php

namespace App\Http\Controllers;

use App\Repositories\PostRepository;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;


class PostController extends Controller
{


    /**
     * @var PostRepository
     */
    private $repository;

    public function __construct(PostRepository $repository)
    {

        $this->repository = $repository;
    }

    public function listing(Request $request)
    {
        $posts = $this->repository->listingPosts($request->get('user_id'));
        if (empty($posts)){
            return \response()->json([
                'success' => false,
                'message' => "Post not found",
            ], 404);
        }
        return response()->json([
            'success' => true,
            'data' => $posts,
        ]);
    }

    public function get($id)
    {
        $post = $this->repository->getPost($id);
        return response()->json([
            'success' => true,
            'data' => $post,
        ]);
    }

    public function create (Request $request){
        try {
            $post = $this->repository->createPost(
              $request->get('title'),
              $request->get('body'),
              $request->get('user_id')
            );
        } catch (\Throwable $exception){
            exit('post not created');
        }

        return response()->json($post->toArray());
    }

    public function edit(Request $request, $id)
    {
        try{
            $post = $this->repository->editPost($request,$id)->update();
        } catch(\Throwable $exception){
            exit ('post was not updated');
        }
        return "Post Updated";
        //return response()->json($post->toArray());
    }


    public function delete($id)
    {
        try{
            $post = $this->repository->deletePost($id);
        } catch(\Throwable $exception){
            exit ('post was not deleted');
        }

        return "post deleted";
    }

    public function like(Request $request, $id)
    {
        try {
            $like = $this->repository->markLike(
                $id,
                $request->get('user_id')
            );
        } catch (\Throwable $exception){
            exit('like not marked');
        }

        return response(null,204);
    }
}

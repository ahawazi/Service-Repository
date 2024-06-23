<?php

namespace App\Http\Controllers;

use App\Services\Interfaces\PostServiceInterface;
use Illuminate\Http\Request;

class PostController extends Controller
{
    protected $postService;

    public function __construct(PostServiceInterface $postService)
    {
        $this->postService = $postService;
    }

    public function index()
    {
        $posts = $this->postService->getAllPosts();
        return view('posts.index', compact('posts'));
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        $this->postService->createPost($request->all());
        return redirect()->route('posts.index');
    }

    public function show($id)
    {
        $post = $this->postService->getPostById($id);
        return view('posts.show', compact('post'));
    }

    public function edit($id)
    {
        $post = $this->postService->getPostById($id);
        return view('posts.edit', compact('post'));
    }

    public function update(Request $request, $id)
    {
        $this->postService->updatePostById($request->all(), $id);
        return redirect()->route('posts.index');
    }

    public function destroy($id)
    {
        $this->postService->deletePostById($id);
        return redirect()->route('posts.index');
    }
}
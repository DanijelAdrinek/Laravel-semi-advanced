<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;

class PostController extends Controller implements HasMiddleware
{

    public static function middleware(): array {
        return [
            'auth'
        ];
    }

    public function index() {
        $posts = Post::paginate(20);

        return view('posts.index', [
            'posts' => $posts
        ]);
    }

    public function store(Request $request) {
        $request->validate([
            'body' => 'required'
        ]);

        auth()->user()->posts()->create($request->only('body'));

        return back();
    }
}

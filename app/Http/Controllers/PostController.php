<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Http\Resources\PostResource;


class PostController extends Controller
{
    public function index() // Вывод списка элементов
    {
        return PostResource::collection(Post::with('user', 'comments')->get());
    }

    public function store(Request $request) // Создание
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'user_id' => 'required|exists:users,id',
        ]);

        $post = Post::create($data);

        return response()->json($post, 201);
    }

    public function show(string $id) // Просмотр элемента
    {
        $post = Post::with('user', 'comments')->find($id);

        if (!$post) {
            return response()->json([
                'message' => 'Post not found.'
            ], 404);
        }
        return new PostResource($post);
    }

    public function update(Request $request, $id) // Редактирование
    {
        $post = Post::find($id);

        if (!$post) {
            return response()->json([
                'message' => 'Post not found.'
            ], 404);
        }

        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $post->update($validatedData);

        return new PostResource($post);
    }

    public function destroy($id)
    {
        $post = Post::find($id);

        if (!$post) {
            return response()->json([
                'message' => 'Post not found.'
            ], 404);
        }

        $post->delete();

        return response()->json([
            'message' => 'Post deleted successfully.'
        ], 200);
    }
}

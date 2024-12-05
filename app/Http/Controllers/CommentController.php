<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Http\Resources\CommentResource;
use App\Models\Comment;
use App\Models\Post;

class CommentController extends Controller
{
    public function index() // Вывод списка элементов
    {
        return CommentResource::collection(Comment::with("user_id", "post_id", "content")->get());
    }

    public function store(Request $request) // Создание
    {
        $data = $request->validate([
            'content' => 'required',
            'user_id' => 'required|exists:users,id',
            'post_id' => 'required|exists:post,id',
        ]);

        $comment = Comment::create($data);

        return response()->json($comment, 201);
    }



    public function show(string $id) // Просмотр элемента
    {
        $comment = Comment::with("user_id", "post_id", "content")->find($id);

        if (!$comment) {
            return response()->json([
                'message' => 'Comment not found.'
            ], 404);
        }
        return new CommentResource($comment);
    }

    public function update(Request $request, $id) // Редактирование
    {
        $comment = Post::find($id);

        if (!$comment) {
            return response()->json([
                'message' => 'comment not found.'
            ], 404);
        }

        $validatedData = $request->validate([
            'content' => 'required',
            'user_id' => 'required|exists:users,id',
            'post_id' => 'required|exists:post,id',
        ]);

        $comment->update($validatedData);

        return new CommentResource($comment);
    }

    public function destroy($id)
    {
        $comment = Comment::find($id);

        if (!$comment) {
            return response()->json([
                'message' => 'Post not found.'
            ], 404);
        }

        $comment->delete();

        return response()->json([
            'message' => 'Comment deleted successfully.'
        ], 200);
    }
}

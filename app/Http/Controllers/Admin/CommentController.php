<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    use AuthorizesRequests;

    public function index(Comment $comment)
    {
        $comments = Comment::orderBy("created_at", "desc")->paginate(5);

        return view('admin.comments.index', compact('comments'));
    }

    public function destroy(Comment $comment)
    {
        $this->authorize("delete", $comment);

        $comment->delete();

        return redirect()->route("admin.comments.index")->with("success", "Comment deleted Successfully!");
    }
}

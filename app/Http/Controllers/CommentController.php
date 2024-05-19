<?php

namespace App\Http\Controllers;

use App\Http\Requests\Comment\StoreCommentRequest;
use App\Models\Comment;
use App\Models\Idea;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Idea $idea, StoreCommentRequest $request)
    {
        $validated = $request->validated();

        $validated['idea_id'] = $idea->id;
        $validated['user_id'] = auth()->id();

        Comment::create($validated);

        return redirect()->route("ideas.show", $idea->id)->with("success", "Comment posted successfully");
    }
}

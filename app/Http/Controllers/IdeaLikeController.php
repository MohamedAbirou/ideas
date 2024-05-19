<?php

namespace App\Http\Controllers;

use App\Models\Idea;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class IdeaLikeController extends Controller
{
    public function like(Idea $idea)
    {
        $liker = auth()->user();

        $liker->likes()->attach($idea->id);

        return redirect()->route("ideas.show", $idea->id)->with("success", "Idea liked Successfully");
    }

    public function unlike(Idea $idea)
    {
        $liker = auth()->user();

        $liker->likes()->detach($idea->id);

        return redirect()->route("ideas.show", $idea->id)->with("success", "Idea unliked Successfully");
    }
}

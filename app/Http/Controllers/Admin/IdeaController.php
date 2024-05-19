<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Idea;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class IdeaController extends Controller
{
    use AuthorizesRequests;

    public function index(Idea $idea)
    {
        $ideas = Idea::orderBy("created_at", "desc")->paginate(5);

        return view('admin.ideas.index', compact('ideas'));
    }

    public function destroy(Idea $idea)
    {
        $this->authorize("delete", $idea);

        $idea->delete();

        return redirect()->route("admin.ideas.index")->with("success", "Idea deleted Successfully!");
    }
}

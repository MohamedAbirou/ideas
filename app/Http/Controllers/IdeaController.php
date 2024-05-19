<?php

namespace App\Http\Controllers;

use App\Http\Requests\Idea\StoreIdeaRequest;
use App\Http\Requests\Idea\UpdateIdeaRequest;
use App\Models\Idea;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class IdeaController extends Controller
{
    use AuthorizesRequests;


    public function show(Idea $idea, User $user)
    {
        return view("ideas.show", compact('idea', 'user'));
    }

    public function store(StoreIdeaRequest $request)
    {
        $validated = $request->validated();

        $validated['user_id'] = auth()->id();

        Idea::create($validated);

        return redirect()->route("dashboard")->with("success", "Idea created Successfully!");
    }

    public function edit(Idea $idea)
    {

        $this->authorize("update", $idea);

        $editing = true;
        return view("ideas.show", compact('idea', 'editing'));
    }

    public function update(Idea $idea, UpdateIdeaRequest $request)
    {
        $this->authorize("update", $idea);

        $validated = $request->validated();

        $idea->update($validated);

        return redirect()->route("ideas.show", $idea->id)->with("success", "Idea content updated Successfully!");
    }

    public function destroy(Idea $idea)
    {

        $this->authorize("delete", $idea);

        $idea->delete();

        return redirect()->route("dashboard")->with("success", "Idea deleted Successfully!");
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\UpdateUserRequest;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    use AuthorizesRequests;


    public function show(User $user)
    {
        $ideas = $user->ideas()->paginate(2);

        return view("users.show", compact("user", "ideas"));
    }

    public function edit(User $user)
    {
        $this->authorize("update", $user);

        $editing = true;
        $ideas = $user->ideas()->paginate(2);

        return view("users.edit", compact("user", "editing", "ideas"));
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        $this->authorize("update", $user);

        $validated = $request->validated();

        if ($request->has("image")) {
            $imagePath = $request->file("image")->storePublicly("profile", "public");
            $validated['image'] = $imagePath;

            Storage::disk('public')->delete($user->image ?? '');
        }

        $user->update($validated);

        return redirect()->route("profile")->with("success", "User updated successfully!");
    }

    public function profile()
    {
        $user = auth()->user();

        return $this->show($user);
    }
}

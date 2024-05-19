<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class UserController extends Controller
{
    use AuthorizesRequests;

    public function index(Request $request)
    {
        $users = User::latest()->paginate(5);

        return view("admin.users.index", compact("users"));
    }

    public function destroy(User $user)
    {
        try {
            $this->authorize("delete", $user);

            $user->delete();

            return redirect()->route("admin.users.index")->with("success", "User deleted Successfully!");
        } catch (\Illuminate\Auth\Access\AuthorizationException $e) {
            return redirect()->route("admin.users.index", $user)->with("error", "You can't delete yourself!");
        }
    }
}

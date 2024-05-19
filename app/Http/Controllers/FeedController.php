<?php

namespace App\Http\Controllers;

use App\Models\Idea;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class FeedController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $ideas = Idea::when($request->has("search"), function (Builder $query) {
            $query->search(request("search", ""));
        })->orderBy("created_at", "desc")->paginate(5);

        return view("dashboard", compact("ideas"));
    }
}

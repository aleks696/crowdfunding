<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Project;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request, Project $project)
    {
        $request->validate([
            'text' => 'required'
        ]);

        $comment = new Comment([
            'customer_id' => Auth::id(),
            'project_id' => $project->id,
            'time' => now(),
            'text' => $request->text
        ]);
        $comment->save();

        return back();
    }
}

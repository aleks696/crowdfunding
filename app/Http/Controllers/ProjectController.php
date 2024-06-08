<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Payment;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::with('creator')->get();
        return view('projects.index', compact('projects'));
    }

    public function completed()
    {
        $projects = Project::with('creator')->where('status', 'completed')->get();
        return view('projects.index', compact('projects'));
    }

    public function mine()
    {
        $projects = Project::with('creator')->where('creator_id', Auth::id())->get();
        return view('projects.index', compact('projects'));
    }

    public function mineIncomplete()
    {
        $projects = Project::with('creator')->where('creator_id', Auth::id())->where('status', '!=', 'completed')->get();
        return view('projects.index', compact('projects'));
    }

    public function create()
    {
        return view('projects.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'info' => 'required|string',
            'description' => 'required|string',
            'goal_amount' => 'required|numeric|min:0.01',
            'photo_evidence' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $project = new Project([
            'info' => $request->input('info'),
            'description' => $request->input('description'),
            'creator_id' => Auth::id(),
            'balance' => 0,
            'goal_amount' => $request->input('goal_amount')
        ]);

        if ($request->hasFile('photo_evidence')) {
            $imagePath = $request->file('photo_evidence')->store('projects', 'public');
            $project->photo_evidence = $imagePath;
        }

        $project->save();

        return redirect()->route('home');
    }

    public function report(Project $project)
    {
        $payments = Payment::where('project_id', $project->id)->with('customer')->get();
        return view('projects.report', compact('project', 'payments'));
    }

    public function pay(Request $request, Project $project)
    {
        $request->validate([
            'amount' => 'required|numeric|min:0.01',
        ]);

        if (Auth::check()) {
            Payment::create([
                'project_id' => $project->id,
                'customer_id' => Auth::id(),
                'amount' => $request->input('amount'),
            ]);

            $project->balance += $request->input('amount');

            $project->updateStatus();

            $project->save();

            return redirect()->route('home')->with('success', 'Payment successful and project status updated!');
        } else {
            return redirect()->route('login')->with('error', 'Please login to make a payment.');
        }
    }

    public function show(Project $project)
    {
        $comments = $project->comments()->with('creator')->get();
        return view('projects.show', compact('project', 'comments'));
    }

    public function addComment(Request $request, Project $project)
    {
        $request->validate([
            'text' => 'required|string',
        ]);

        Comment::create([
            'project_id' => $project->id,
            'creator_id' => Auth::id(),
            'text' => $request->input('text'),
        ]);

        return redirect()->route('projects.show', $project->id);
    }
}


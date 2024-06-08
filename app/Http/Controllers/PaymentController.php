<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;
use App\Models\Project;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    public function store(Request $request, $projectId)
    {
        $request->validate([
            'amount' => 'required|numeric|min:0.01',
        ]);

        $project = Project::findOrFail($projectId);

        Payment::create([
            'project_id' => $project->id,
            'customer_id' => Auth::id(),
            'amount' => $request->input('amount'),
        ]);

        // Update project balance
        $project->balance += $request->input('amount');

        // Check if the project's balance meets the goal
        if ($project->balance >= $project->goal_amount) {
            $project->status = 'completed';
        }

        $project->save();

        return redirect()->route('projects.index')->with('success', 'Payment successful and project status updated!');
    }
}

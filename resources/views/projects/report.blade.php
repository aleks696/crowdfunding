@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <h1 class="fw-light bg-success" >{{ $project->info }} - Report</h1>
        <p><strong>Description:</strong> {{ $project->description }}</p>
        <p><strong>Status:</strong> {{ $project->status }}</p>
        <p><strong>Creator:</strong> {{ $project->creator->username }}</p>
        <p><strong>Balance:</strong> {{ $project->balance }}</p>
        <p><strong>Goal Amount:</strong> {{ $project->goal_amount }}</p>

        <h2 class="mt-5">Payments</h2>
        <ul class="list-group">
            @foreach($payments as $payment)
                <li class="list-group-item">
                    <strong>Customer:</strong> {{ $payment->customer->username }} <br>
                    <strong>Amount:</strong> {{ $payment->amount }} <br>
                    <strong>Date:</strong> {{ $payment->created_at }}
                </li>
            @endforeach
        </ul>

        @if($project->isCompleted() && $project->photo_evidence)
            <h2 class="mt-5">Photo Evidence</h2>
            <div class="d-flex justify-content-center">
                <img src="{{ asset('storage/' . $project->photo_evidence) }}" alt="Completed Project" class="img-fluid mb-3 w-50">
            </div>
        @endif
    </div>
@endsection

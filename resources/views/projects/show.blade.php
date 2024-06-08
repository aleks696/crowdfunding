@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <h1 class="fw-light">{{ $project->info }}</h1>
        <p><strong>Description:</strong> {{ $project->description }}</p>
        <p><strong>Status:</strong> {{ $project->status }}</p>
        <p><strong>Creator:</strong> {{ $project->creator->username }}</p>
        <p><strong>Balance:</strong> {{ $project->balance }}</p>
        <p><strong>Goal Amount:</strong> {{ $project->goal_amount }}</p>

        @if($project->photo_evidence)
            <div>
                <img src="{{ asset('storage/' . $project->photo_evidence) }}" alt="Photo Evidence" class="img-fluid">
            </div>
        @endif

        <h2 class="mt-5">Comments</h2>
        <ul class="list-group">
            @foreach($comments as $comment)
                <li class="list-group-item">
                    <strong>{{ $comment->creator->username }}</strong>
                    <span class="text-muted">{{ $comment->created_at->format('d-m-Y H:i') }}</span>
                    <p>{{ $comment->text }}</p>
                </li>
            @endforeach
        </ul>

        @if(Auth::check())
            <form action="{{ route('projects.addComment', $project->id) }}" method="POST" class="mt-4">
                @csrf
                <div class="mb-3">
                    <label for="text" class="form-label">Add Comment</label>
                    <textarea id="text" name="text" class="form-control" rows="3" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        @else
            <p>Please <a href="{{ route('login') }}">login</a> to add a comment.</p>
        @endif
    </div>
@endsection

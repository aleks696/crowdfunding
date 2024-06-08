@extends('layouts.app')

@section('content')
    <section class="py-5 text-center container">
        <div class="row py-lg-5">
            <div class="col-lg-6 col-md-8 mx-auto">
                <h1 class="fw-light">All projects</h1>
                <div class="d-flex justify-content-center">
                    <a href="{{ route('projects.index') }}" class="btn btn-primary mx-2">All Projects</a>
                    <a href="{{ route('projects.completed') }}" class="btn btn-success mx-2">Completed Projects</a>
                    @if(Auth::check())
                    <a href="{{ route('projects.mine') }}" class="btn btn-info mx-2">My Projects</a>
                    <a href="{{ route('projects.mineIncomplete') }}" class="btn btn-warning mx-2">My Incomplete Projects</a>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <div class="album py-5 bg-body-tertiary">
        <div class="container">
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                @foreach ($projects as $project)
                    <div class="col">
                        <div class="card mb-4 rounded-3 shadow-sm {{ $project->isCompleted() ? 'bg-success' : '' }}">
                            <div class="card-body">
                                <h1 class="card-title pricing-card-title">{{ $project->info }}</h1>
                                @if($project->isCompleted())
                                    <div class="d-flex justify-content-center">
                                        <img src="{{ asset('./sources/cat.jpg') }}" alt="Completed" class="img-fluid mb-3 w-50">
                                    </div>
                                    <a href="{{ route('projects.report', $project->id) }}" class="btn btn-primary">View Report</a>
                                @endif
                                <ul class="list-unstyled mt-3 mb-4">
                                    <li>
                                        <strong>Description:</strong> {{ $project->description }}<br>
                                        <strong>Status:</strong> {{ $project->status }}<br>
                                        <strong>Creator:</strong> {{ $project->creator->username }}<br>
                                        <strong>Balance:</strong> {{ $project->balance }}<br>
                                        <strong>Goal Amount:</strong> {{ $project->goal_amount }}<br>

                                        @if(Auth::check())
                                            <form method="POST" action="{{ route('projects.pay', $project->id) }}">
                                                @csrf
                                                <label for="amount">Amount:</label>
                                                <input type="number" id="amount" name="amount" step="0.01" min="0.01">
                                                <button class="btn btn-primary py-2" type="submit">Donate</button>
                                            </form>
                                        @else
                                            <p>Please <a href="{{ route('login') }}">login</a> to make a payment.</p>
                                        @endif

                                        @if (session('success'))
                                            <p>{{ session('success') }}</p>
                                        @endif
                                    </li>
                                </ul>
                                <a href="{{ route('projects.show', $project->id) }}" class="btn btn-info mt-3">View Comments</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection

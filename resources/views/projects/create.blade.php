@extends('layouts.app')

@section('content')
    <div class="d-flex align-items-center py-4 ">
        <main class="form-signin w-50 m-auto" >
            <form method="POST" action="{{ route('projects.store') }}">
                <br> <h1 class="h4 mb-5 fw-normal text-center">Create New Project</h1><br>
                @csrf
                <div class="input-group input-group-lg">
                    <span class="input-group-text" id="info">info:</span>
                    <input type="text" class="form-control" name="info" aria-label="info" aria-describedby="info" required>
                </div><br>
                <div class="input-group input-group-lg">
                    <span class="input-group-text" id="description">Description:</span>
                    <input type="text" class="form-control" name="description" aria-label="description" aria-describedby="description" required>
                </div><br>
                <div class="input-group input-group-lg">
                    <span class="input-group-text" id="goal_amount">Goal Amount:</span>
                    <input type="number" class="form-control" name="goal_amount" aria-label="goal_amount" step="0.01" aria-describedby="goal_amount" required>
                </div><br>
                <button class="btn btn-primary w-100 py-2" type="submit">Create Project</button>
            </form>
        </main>
    </div>
@endsection

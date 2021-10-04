@extends('layouts.app')

@section('content')
<header class="flex items-center mb-3 py-4">
    <div class="flex justify-between items-end w-full">
        <p class="text-gray-400 text-sm font-normal">
            <a href="/projects" class="text-gray-400 text-sm font-normal no-outline">My projects</a> / {{ $project->title }}
        </p>

        <a href="{{ $project->path() . '/edit' }}" class="btn btn-blue">Edit project</a>
    </div>

</header>
<main>
    <div class="lg:flex -mx-3">
        <div class="lg:w-3/4 px-3 mb-6">
            <div class="mb-8">
                <h2 class="text-lg text-gray-400 font-normal mb-3">Tasks</h2>

                @foreach ($project->tasks as $task)

                <div class="card mb-3">
                    <form method="POST" action="{{  $task->path() }}">
                        @method('PATCH')
                        @csrf
                        <div class="flex">
                            <input name="body" value="{{ $task->body }}" class="w-full {{ $task->completed ? 'text-gray-400' : ''}}">
                        <input type="checkbox" name="completed" onchange="this.form.submit()" {{ $task->completed ? 'checked' : ''}}>
                        </div>
                    </form>
                </div>
                @endforeach
                <div class="card mb-3">
                    <form action="{{ $project->path() . '/tasks' }}" method="POST">
                        @csrf
                        <input placeholder="Add a new task..." class="w-full" name="body"></input>
                    </form>

                </div>

            </div>


            <div class="div">
                <h2 class="text-lg text-gray-400 font-normal">General Notes</h2>

                <form method="POST" action="{{ $project->path() }}">
                    @csrf
                    @method('PATCH')
                    <textarea name="notes" class="card w-full" style="min-height: 200px;">
                        {{ $project->notes }}
                    </textarea>
                    <button type="submit" class="btn btn-blue">Save</button>
                </form>
               
            </div>

        </div>

        <div class="lg:w-1/4 px-3">
            @include('projects.card')

        </div>
    </div>

</main>

@endsection
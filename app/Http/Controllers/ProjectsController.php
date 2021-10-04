<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateProjectRequest;
use Illuminate\Http\Request;
use App\Models\Project;

class ProjectsController extends Controller
{
    public function index()
    {
        $projects = auth()->user()->projects()->latest('updated_at')->get();
        return view('projects.index', compact('projects'));
    }

    public function show(Project $project)
    {
        $this->authorize('update', $project);

        return view('projects.show', compact('project'));
    }

    protected function validateRequest()
    {
        return request()->validate([
            'title' => 'sometimes|required',
            'description' => 'sometimes|required',
            'notes' => 'nullable'
        ]);
    }

    public function store()
    {
        $project = auth()->user()->projects()->create($this->validateRequest());

        return redirect('/projects/' . $project->id);
    }

    public function create()
    {
        return view('projects.create');
    }

    public function update(UpdateProjectRequest $request)
    {
        return redirect($request->save()->path());
    }

    public function edit(Project $project)
    {
        return view('projects.edit', compact('project'));
    }
}

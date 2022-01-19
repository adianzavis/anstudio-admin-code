<?php

namespace App\Projects;

use App\Currency\Currency;
use Illuminate\Http\Request;
use App\Tasks\TaskStatus;
use App\Projects\Requests\ProjectCreateRequest;
use App\Projects\Requests\ProjectUpdateRequest;
use App\Core\Controller;
use App\Departments\Department;
use App\Customers\Customer;
use App\Users\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller {
	public function index(Request $request) {
		return view('admin.projects.index', [
			'layout' => 'side-menu',
			'projects' => Project::paginate($request->input('per_page', 9))->withQueryString(),
		]);
	}

	public function create(Request $request) {
		return view('admin.projects.create', [
			'layout' => 'side-menu',
			'departments' => Department::all()->pluck('name', 'id'),
			'customers' => Customer::all(),
			'users' => User::all()->pluck('full_name', 'id'),
			'prefilled' => [
				'customer' => Customer::find($request->get('customer')) ?? null,
			]
		]);
	}

	public function store(ProjectCreateRequest $request) {
		$projectMediator = new ProjectMediator($request->all());
		$project = $projectMediator->create();

		return redirect()->route('admin.project.index', $project)->with('success', 'Project has been created');
	}

	public function show(Request $request, Project $project) {
        $statuses = TaskStatus::with(['tasks' => function ($query) use ($project) {
            $query->where('project_id', $project->id);
        }])->get();

		return view('admin.projects.show', [
			'layout' => 'side-menu',
			'project' => $project,
            'assignees' => $project->assignees,
            'statuses' => $statuses,
            'currencies' => Currency::all(),
		]);
	}

	public function edit(Request $request, Project $project) {
		return view('admin.projects.edit', [
			'layout' => 'side-menu',

			'project' => $project,
			'departments' => Department::all()->pluck('name', 'id'),
			'customers' => Customer::all(),
			'users' => User::all()->pluck('full_name', 'id'),
		]);
	}

	public function update(ProjectUpdateRequest $request, Project $project) {
		$projectMediator = new ProjectMediator($request->all(), $project);
		$project = $projectMediator->update();

		return redirect()->route('admin.project.show', $project)->with('success', 'Project has been updated');
	}

	public function delete(Request $request, Project $project) {
		$customerMediator = new ProjectMediator($request->all(), $project);
		$customerMediator->delete();

		return redirect()->route('admin.project.index')->with('success', 'Project "' . $project->name . '" was deleted.');
	}

	public function image(Request $request, Project $project) {
		if (!Storage::disk('local')->exists($project->image) || !Auth::user()) {
			abort(404);
		}

		return Storage::download($project->image);
	}

	public function ogImage(Request $request, Project $project) {
		if (!Storage::disk('local')->exists($project->og_image) || !Auth::user()) {
			abort(404);
		}

		return Storage::download($project->og_image);
	}
}

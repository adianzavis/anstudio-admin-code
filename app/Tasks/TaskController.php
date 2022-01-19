<?php

namespace App\Tasks;

use Illuminate\Http\Request;
use App\Core\Controller;
use App\Tasks\Requests\TaskCreateRequest;
use App\Tasks\Requests\TaskUpdateRequest;
use App\Projects\Project;

class TaskController extends Controller {
    public function index(Request $request) {
        $statuses = TaskStatus::with('tasks')->get();
        $projects = Project::all();

        return view('admin.tasks.index', [
            'layout' => 'side-menu',
            'statuses' => $statuses,
            'projects' => $projects,
        ]);
    }

    public function create(TaskCreateRequest $request) {
        $taskMediator = new TaskMediator($request->all());
        $task = $taskMediator->create();

        return response()->json($task);
    }

    public function update(TaskUpdateRequest $request) {
        $taskMediator = new TaskMediator($request->all());
        $task = $taskMediator->update();

        return response()->json($task);
    }

    public function delete(Request $request, Task $task) {
        $taskMediator = new TaskMediator($request->all(), $task);
        $taskMediator->delete();

        return response('Task has been deleted', 200);
    }

    public function show(Request $request, Task $task) {
        return response()->json($task);
    }

    public function edit(Request $request) {
        return view('admin.tasks.edit', [
            'layout' => 'side-menu',
        ]);
    }

    public function updateOrder(Request $request, Task $task) {
        $mediator = new TaskMediator($request->all(), $task);
        $mediator->move();

        return response('success', 204);
    }
}

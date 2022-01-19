<?php

namespace App\Tasks;

use App\Core\Mediator;
use Illuminate\Support\Collection;

class TaskMediator extends Mediator {
    private ?Task $task;
    private Collection $data;

    public function __construct(array $data, Task $task = null) {
        $this->data = collect($data);
        $this->task = $task;
    }

    public function create() {
        $task = new Task();
        $task->fill($this->data->all());
        $task->order = 1;

        $task->money_budget = $this->data->get('money_budget')['amount'];
        $task->currency_iso = $this->data->get('money_budget')['currency'];
        $task->start = \Carbon\Carbon::create($this->data->get('dates')['start']);
        $task->deadline = \Carbon\Carbon::create($this->data->get('dates')['end']);
        $task->status()->associate($this->data->get('status_id'));
        $task->project()->associate($this->data->get('project'));

        $task->save();
        $task->assignees()->sync($this->formatAssignees($this->data->get('assignees', [])));
        $task->load('assignees');

        $this->task = $task;
        $this->moveRest();

        return $this->task;
    }

    public function update() {
        $task = Task::findOrFail($this->data['id']);
        $task->fill($this->data->all());

        $task->money_budget = $this->data->get('money_budget')['amount'];
        $task->currency_iso = $this->data->get('money_budget')['currency'];
        $task->start = \Carbon\Carbon::create($this->data->get('dates')['start']);
        $task->deadline = \Carbon\Carbon::create($this->data->get('dates')['end']);
        $task->status()->associate($this->data->get('status_id'));
        $task->project()->associate($this->data->get('project'));
        $task->save();

        $task->assignees()->sync($this->formatAssignees($this->data->get('assignees', [])));
        $task->load('assignees');

        $this->task = $task;

        return $this->task;
    }

    public function delete() {
        $this->task->delete();
    }

    public function move() {
        $this->moveTo();
        $this->moveRest();
    }

    private function formatAssignees(array $input): Collection {
        return collect($input)->map(function($assignee) {
            return $assignee['id'];
        });
    }

    private function moveRest() {
        Task::inProject($this->task->project->id)
            ->inStatus($this->task->status->id)
            ->where('id', '!=', $this->task->id)
            ->when($this->previousTask(), function($query, Task $previous) {
                return $query->where('order', '>', $previous->order);
        })->increment('order');
    }

    private function moveTo() {
        $status = TaskStatus::find($this->data->get('status'));
        $this->task->order = $this->previousTask() ? $this->previousTask()->order + 1 : 1;
        $this->task->status()->associate($status);

        $this->task->save();
    }

    private function previousTask(): ?Task {
        return $this->data->get('previous') ? Task::inProject($this->task->project->id ?? null)->find($this->data->get('previous')) : null;
    }
}

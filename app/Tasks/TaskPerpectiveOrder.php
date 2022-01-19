<?php

namespace App\Tasks;

use Illuminate\Database\Eloquent\Model;
use App\Projects\Project;
use App\Users\User;

class TaskPerpectiveOrder extends Model {
	protected $table = 'tasks_perspective_order';

	public function user() {
		return $this->belongsTo(User::class);
	}

	public function project() {
		return $this->belongsTo(Project::class, 'project_id', 'id');
	}

	public function task() {
		return $this->belongsTo(Task::class, 'task_id', 'id');
	}

	public function prev_task() {
		return $this->belongsTo(Task::class, 'prev_task', 'id');
	}

	public function next_task() {
		return $this->belongsTo(Task::class, 'next_task', 'id');
	}

	public function project_prev_task() {
		return $this->belongsTo(Task::class, 'project_prev_task', 'id');
	}

	public function project_next_task() {
		return $this->belongsTo(Task::class, 'project_next_task', 'id');
	}

	public function scopeFindInPerspectiveUserProject(User $user, Project $project) {
		return $this->where('user_id', $user)->where('project_id', $project);
	}

	public function scopeFindInPerspectiveUser(User $user) {
		return $this->where('user_id', $user);
	}

}

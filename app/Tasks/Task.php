<?php

namespace App\Tasks;

use Illuminate\Database\Eloquent\Model;
use App\Projects\Project;
use App\Casts\IntervalCast;
use App\Users\User;
use App\Currency\Currency;

class Task extends Model {

    protected $casts = [
        'duration' => IntervalCast::class,
        'duration_budget' => IntervalCast::class,
        'start' => 'date',
        'deadline' => 'date',
    ];

    protected $fillable = [
        'name',
        'duration',
        'duration_budget',
        'description',
        'deadline',
    ];

    protected $appends = [
        'formatted_deadline',
        'formatted_duration',
        'formatted_duration_budget',
    ];

    protected $with = ['assignees'];

	public function assignees() {
		return $this->belongsToMany(User::class);
	}

	public function project() {
		return $this->belongsTo(Project::class, 'project_id', 'id');
	}

	public function status() {
		return $this->belongsTo(TaskStatus::class, 'status_id', 'id');
	}

	public function currency() {
	    return $this->hasOne(Currency::class, 'iso', 'currency_iso');
    }

	public function scopeInProject($query, $id) {
        return $this->where('project_id', $id);
    }

    public function scopeInStatus($query, $id) {
	    return $this->where('status_id', $id);
    }

    public function getFormattedDeadlineAttribute() {
	    return $this->deadline->toDateString();
    }

    public function getFormattedDurationAttribute() {
	    return $this->duration->spec();
    }

    public function getFormattedDurationBudgetAttribute() {
        return $this->duration_budget->spec();
    }
}

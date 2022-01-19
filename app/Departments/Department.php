<?php

namespace App\Departments;


use Illuminate\Database\Eloquent\Model;
use App\Projects\Project;


class Department extends Model {
    protected $fillable = [
        'name',
        'description',
    ];

    public function projects() {
        return $this->belongsToMany(Project::class);
    }
}

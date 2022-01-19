<?php

namespace App\Projects;

use Illuminate\Database\Eloquent\Model;

class ProjectStatus extends Model {
    protected $fillable = [
        'name',
        'description'
    ];

    public function project() {
        return $this->belongsToMany(Project::class);
    }
}

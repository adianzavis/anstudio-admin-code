<?php

namespace App\Projects;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\Users\User;

class ProjectComment extends Model {

    protected $casts = [
        'created_at' => 'datetime',
    ];

    protected $fillable = [
        'comment',
    ];

    public function project() {
        return $this->belongsTo(Project::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}

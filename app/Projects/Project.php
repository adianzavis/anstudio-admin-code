<?php

namespace App\Projects;

use Illuminate\Database\Eloquent\Model;
use App\Departments\Department;
use App\Customers\Customer;
use App\Users\User;

class Project extends Model {
	protected $fillable = [
		'name',
		'summary',
		'total_description',
		'web',
		'facebook',
		'instagram',
		'google_disk',
		'site_content',
		'public',
		'public_author',
		'title',
		'meta_description',
		'meta_keywords',
		'og_title',
		'og_site_name',
		'og_description',
		'og_url',
	];

	public function customer() {
		return $this->belongsTo(Customer::class, 'customer_id', 'id');
	}

	public function departments() {
		return $this->belongsToMany(Department::class);
	}

	public function assignees() {
		return $this->belongsToMany(User::class);
	}

	public function comments() {
		return $this->hasMany(ProjectComment::class);
	}

    public function departmentsString() {
        return $this->departments->map(function($department, $key) {
            return $department->name;
        })->implode(', ');
    }
}

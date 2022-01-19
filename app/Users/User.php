<?php

namespace App\Users;

use App\Departments\Department;
use App\Tasks\Task;
use App\Invoices\Details\InvoiceDetails;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Projects\Project;

class User extends Authenticatable {
    use HasFactory, Notifiable;

    protected $fillable = [
        'email',
        'name',
        'surname',
        'position',
        'phone',
        'description',
        'street',
        'postcode',
        'city',
        'country',
        'iban',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $appends = ['full_name', 'avatar_path'];

    public function departments() {
        return $this->belongsToMany(Department::class);
    }

    public function projects() {
        return $this->belongsToMany(Project::class);
    }

    public function tasks() {
        return $this->belongsToMany(Task::class);
    }

    public function invoiceDetails() {
        return $this->belongsTo(InvoiceDetails::class, 'invoice_detail_id', 'id');
    }

    public function getFullNameAttribute() {
        return $this->name . " " . $this->surname;
    }

    public function getAvatarPathAttribute() {
        return $this->avatar ? route('admin.user.avatar', $this->id) : null;
    }

    public function departmentsString() {
        return $this->departments->map(function($department, $key) {
            return $department->name;
        })->implode(', ');
    }
}

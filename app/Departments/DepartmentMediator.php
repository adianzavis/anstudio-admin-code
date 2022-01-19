<?php

namespace App\Departments;

use App\Core\Mediator;
use Illuminate\Http\Request;

class DepartmentMediator extends Mediator {
    private ?Department $department;
    private Request $request;

    public function __construct(Request $request, Department $department = null) {
        $this->request = $request;
        $this->department = $department;
    }

    public function create() {
        $department = new Department();

        $department->fill($this->request->all());
        $department->save();

        return $department;
    }

    public function enable() {
        $this->department->active = true;
        $this->department->save();
    }

    public function disable() {
        $this->department->active = false;
        $this->department->save();
    }

    public function delete() {
        $this->department->delete();
    }
}

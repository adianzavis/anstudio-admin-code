<?php

namespace App\Projects;

use App\Core\Mediator;
use Illuminate\Support\Collection;
use App\Projects\Project;
use App\View\Format;

class ProjectMediator extends Mediator {
    private ?Project $project;
    private Collection $data;

    public function __construct(array $data, Project $project = null) {
        $this->data = collect($data);
        $this->project = $project;

        $this->formatUrls();
    }

    public function create() {
        $project = new Project();

        $project->fill($this->data->all());
        $project->customer()->associate($this->data->get('customer', []));

        if ($this->data->has('og_image'))
            $project->og_image = $this->data->get('og_image')->store('social');

        if ($this->data->has('image'))
            $project->image = $this->data->get('image')->store('projects');

        $project->save();

        $project->departments()->attach($this->data->get('departments', []));
        $project->assignees()->attach($this->data->get('assignees', []));

        return $project;
    }

    public function update() {
        $project = $this->project;

        if (!is_null($this->data->get('og_image')) && $this->data->get('og_image') != $project->og_image)
            $project->og_image = $this->data->get('og_image')->store('social');

        if (!is_null($this->data->get('image')) && $this->data->get('image') != $project->image)
            $project->image = $this->data->get('image')->store('projects');

        $this->data->put('public', $this->data->has('public'));
        $this->data->put('public_author', $this->data->has('public_author'));
        $this->data->put('image', $project->image);
        $this->data->put('og_image', $project->og_image);

        $project->fill($this->data->all());
        $project->customer()->associate($this->data->get('customer', []));

        $project->save();

        $project->departments()->sync($this->data->get('departments', []));
        $project->assignees()->sync($this->data->get('assignees', []));

        return $project;
    }

    public function delete() {
        $this->project->departments()->detach($this->project->departments);
        $this->project->assignees()->detach($this->project->assignees);

        $this->project->delete();
    }

    public function formatUrls() {
        $this->data->put('web', $this->data->get('web') ? Format::url($this->data->get('web')) : null);
        $this->data->put('facebook', $this->data->get('facebook') ? Format::url($this->data->get('facebook')) : null);
        $this->data->put('instagram', $this->data->get('instagram') ? Format::url($this->data->get('instagram')) : null);
        $this->data->put('google_disk', $this->data->get('google_disk') ? Format::url($this->data->get('google_disk')) : null);
    }
}

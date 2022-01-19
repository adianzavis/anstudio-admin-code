<?php

namespace App\Projects;

use App\Core\Mediator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class ProjectCommentMediator extends Mediator {
    private ?ProjectComment $projectComment;
    private Collection $data;

    public function __construct(array $data, Project $projectComment = null) {
        $this->data = collect($data);
        $this->projectComment = $projectComment;
    }

    public function create() {
        $projectComment = new ProjectComment();

        $projectComment->comment = $this->data->get('comment');
        $projectComment->user()->associate(Auth::id());
        $projectComment->project()->associate($this->data->get('project'));

        $projectComment->save();

        return $projectComment;
    }

    public function delete() {
        $this->projectComment->delete();
    }
}

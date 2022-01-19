<?php

namespace App\Providers;

use Collective\Html\FormFacade;
use Illuminate\Support\ServiceProvider;

class FormServiceProvider extends ServiceProvider {

    public function boot() {
        $this->loadViewsFrom(resource_path('views/admin/forms'), 'form');
        $this->registerComponents();
    }

    private function registerComponents() {
        FormFacade::component(
            'textGroup',
            'form::groups.text',
            ['name', 'value', 'label', 'attributes' => []]
        );

        FormFacade::component(
            'textAreaGroup',
            'form::groups.textarea',
            ['name', 'value', 'label', 'attributes' => []]
        );

        FormFacade::component(
            'passwordGroup',
            'form::groups.password',
            ['name', 'value', 'label', 'attributes' => []]
        );

        FormFacade::component(
            'toggleGroup',
            'form::groups.toggle',
            ['name', 'value', 'checked', 'label', 'attributes' => []]
        );
    }

}

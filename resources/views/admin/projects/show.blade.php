@extends('/admin/layout/' . $layout)

@section('subhead')
	<title>Project</title>
@endsection

@section('breadcrumb')
    <a href="">Anstudio</a>
    <i data-feather="chevron-right" class="breadcrumb__icon"></i>
    <a href="{{ route('admin.project.index') }}">Projects</a>
    <i data-feather="chevron-right" class="breadcrumb__icon"></i>
    <a href="" class="breadcrumb--active">{{ $project->name }}</a>
@endsection

@section('subcontent')
	<div id="project">
        <div class="intro-y flex items-center mt-8">
            <h2 class="text-lg font-medium mr-auto">Project</h2>
        </div>
        <!-- BEGIN: Profile Info -->
        <div class="intro-y box px-5 pt-5 mt-5">
            <div class="flex flex-col lg:flex-row border-b border-gray-200 dark:border-dark-5 pb-5 -mx-5">
                <div class="flex flex-1 px-5 items-center justify-center lg:justify-start">
                    <img class="rounded-full w-20 h-20 sm:w-24 sm:h-24 lg:w-32 lg:h-32 object-cover" src="{{ route('admin.project.image', $project) }}">
                    <div class="ml-5">
                        <div class="w-24 sm:w-40 truncate sm:whitespace-normal font-medium text-lg">{{ $project->name }}</div>
                        @if ($project->customer)
                            <a href="{{ route('admin.customer.show', $project->customer) }}">
                                <div class="text-gray-600">{{ $project->customer->name }} {{ $project->customer->surname }}</div>
                            </a>
                        @endif
                    </div>
                </div>
                <div class="mt-6 lg:mt-0 flex-1 dark:text-gray-300 px-5 border-l border-r border-gray-200 dark:border-dark-5 border-t lg:border-t-0 pt-5 lg:pt-0">
                    <div class="font-medium text-center lg:text-left lg:mt-3">Links</div>
                    <div class="flex flex-col justify-center items-center lg:items-start">
                        @if ($project->web)
                            <a href="{{ url($project->web) }}" target="_blank" class="truncate sm:whitespace-normal flex items-center mt-3">
                                <i data-feather="link" class="w-4 h-4 mr-2"></i> Web
                            </a>
                        @endif
                        @if ($project->instagram)
                            <a href="{{ url($project->instagram) }}" target="_blank" class="truncate sm:whitespace-normal flex items-center mt-3">
                                <i data-feather="instagram" class="w-4 h-4 mr-2"></i> Instagram
                            </a>
                        @endif
                        @if ($project->facebook)
                            <a href="{{ url($project->facebook) }}" target="_blank" class="truncate sm:whitespace-normal flex items-center mt-3">
                                <i data-feather="facebook" class="w-4 h-4 mr-2"></i> Facebook
                            </a>
                        @endif
                        @if ($project->google_disk)
                            <a href="{{ url($project->google_disk) }}" target="_blank" class="truncate sm:whitespace-normal flex items-center mt-3">
                                <i data-feather="folder" class="w-4 h-4 mr-2"></i> Google drive
                            </a>
                        @endif
                    </div>
                </div>
                <div class="mt-6 lg:mt-0 flex-1 px-5 border-t lg:border-0 border-gray-200 dark:border-dark-5 pt-5 lg:pt-0">
                    <div class="font-medium text-center lg:text-left lg:mt-5">Assignees</div>
                    <div class="truncate sm:whitespace-normal flex items-center mt-3">
                        <i data-feather="tag" class="w-4 h-4 mr-2"></i>
                        @foreach($project->assignees as $key => $assignee)
                            <span><a href="{{ route('admin.user.show', $assignee) }}">@if($key != 0) {{ ', ' }} @endif {{ $assignee->name }}</a></span>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="nav nav-tabs flex-col sm:flex-row justify-center lg:justify-start" role="tablist" id="tasks">
                <a id="dashboard-tab" data-toggle="tab" data-target="#dashboard-frame" href="#dashboard" class="tab py-4 sm:mr-8 active" role="tab" aria-controls="dashboard" aria-selected="false">
                    <i class="w-4 h-4 mr-2" data-feather="bar-chart-2"></i> Dashboard
                </a>
                <a id="description-tab" data-toggle="tab" data-target="#description-frame" href="#description" class="tab py-4 sm:mr-8" role="tab" aria-selected="false">
                    <i class="w-4 h-4 mr-2" data-feather="book"></i> Description
                </a>
                <a id="tasks-tab" data-toggle="tab" data-target="#tasks-frame" href="#tasks" class="tab py-4 sm:mr-8" role="tab" aria-controls="tasks" aria-selected="false">
                    <i class="w-4 h-4 mr-2" data-feather="coffee"></i> Tasks
                </a>
                <a id="invoices-tab" data-toggle="tab" data-target="#invoices" href="javascript:;" class="py-4 sm:mr-8" role="tab" aria-selected="false">
                    <i class="w-4 h-4 mr-2" data-feather="shield"></i> Invoices
                </a>
                <a id="change-password-tab" href="{{ route('admin.project.edit', $project) }}" class="py-4 sm:mr-8 flex items-center" role="tab" aria-selected="false">
                    <i class="w-4 h-4 mr-2" data-feather="edit"></i> Edit project
                </a>
            </div>
        </div>
        <!-- END: Profile Info -->
        <div class="tab-content mt-5">
            <div id="dashboard-frame" class="tab-pane active" role="tabpanel" aria-labelledby="dashboard-tab">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <div class="col-span-1 grid gap-6">
                        <div class="intro-y box col-span-12">
                            <div class="flex items-center px-5 py-5 sm:py-0 border-b border-gray-200 dark:border-dark-5">
                                <h2 class="font-medium text-base mr-auto py-5">Project description</h2>
                            </div>
                            <div class="p-3 m-2 bg-dark-2">
                                <div class="tab-content relative short-description">
                                    <div class="ck ck-content description-content">
                                        {!! $project->total_description !!}
                                    </div>
                                    <a class="blur" onclick="document.querySelector('#description-tab').click()">
                                        <i data-feather="eye" class="w-4 h-4 mr-2"></i>View full specification
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="description-frame" class="tab-pane" role="tabpanel" aria-labelledby="description-tab">
                <div class="grid grid-cols-12 gap-6">
                    <div class="intro-y box col-span-12">
                        <div class="flex items-center px-5 py-5 sm:py-0 border-b border-gray-200 dark:border-dark-5">
                            <h2 class="font-medium text-base mr-auto py-5">Project description</h2>
                        </div>
                        <div class="p-3 m-2 bg-dark-2">
                            <div class="tab-content relative">
                                <div class="ck ck-content max-h-75vh overflow-scroll">
                                    {!! $project->total_description !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="tasks-frame" class="tab-pane" role="tabpanel" aria-labelledby="dashboard-tab">
                <div id="app-tasks"></div>
            </div>
        </div>
        <div id="notification-message" class="hidden">
            <div class="alert show flex items-center justify-between mb-1 p-10" role="alert">
                <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-alert-triangle text-white w-6 h-6 mr-2 w-6 h-6 mr-2">
                    <path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"></path>
                    <line x1="12" y1="9" x2="12" y2="13"></line>
                    <line x1="12" y1="17" x2="12.01" y2="17"></line>
                </svg>
                <span class="pl-1 pr-10 text-white" id="text">Example notification</span>
            </div>
        </div>
    </div>
    <script>
        window.statuses = @json($statuses->keyBy('id'));
        window.assignees = @json($assignees);
        window.token = '{{ csrf_token() }}';
        window.projectId = {{ $project->id }};
        window.availableCurrencies = @json($currencies);

        document.querySelectorAll('.tab').forEach(e => {
            if(e.href.substr(e.href.indexOf('#')) === window.location.hash) {
                document.querySelector(document.querySelector('.tab.active').getAttribute('data-target')).classList.remove('active');
                document.querySelector('.tab.active').classList.remove('active');

                e.classList.add('active');
                document.querySelector(e.getAttribute('data-target')).classList.add('active');
            }
        });
    </script>
    <script type="text/javascript" src="{{ mix('admin/tasks/app.js') }}"></script>

    @include('admin.components.messages')
@endsection

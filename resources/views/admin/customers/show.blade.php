@extends('/admin/layout/' . $layout)

@section('subhead')
	<title>Profile</title>
@endsection

@section('breadcrumb')
    <a href="">Anstudio</a>
    <i data-feather="chevron-right" class="breadcrumb__icon"></i>
    <a href="{{ route('admin.customer.index') }}">Customers</a>
    <i data-feather="chevron-right" class="breadcrumb__icon"></i>
    <a href="" class="breadcrumb--active">{{ $customer->name }} {{ $customer->surname }}</a>
@endsection

@section('subcontent')
	<div class="intro-y flex items-center mt-8">
		<h2 class="text-lg font-medium mr-auto">Profile</h2>
	</div>
	<!-- BEGIN: Profile Info -->
	<div class="intro-y box px-5 pt-5 mt-5">
		<div class="flex flex-col lg:flex-row border-b border-dark-5 pb-5 -mx-5">
			<div class="flex flex-1 px-5 items-center justify-center lg:justify-start">
				<img alt="customer avatar" class="w-24 h-24 rounded-full object-cover" src="{{ route('admin.customer.avatar', $customer) }}">
				<div class="ml-5">
					<div class="w-24 sm:w-40 truncate sm:whitespace-normal font-medium text-lg">{{ $customer->name }} {{ $customer->surname }}</div>
					<div class="text-gray-600">{{ $customer->position }}</div>
				</div>
			</div>
			<div class="mt-6 lg:mt-0 flex-1 text-gray-300 px-5 border-l border-r border-dark-5 border-t lg:border-t-0 pt-5 lg:pt-0">
				<div class="font-medium text-center lg:text-left lg:mt-3">Contact Details</div>
				<div class="flex flex-col justify-center items-center lg:items-start mt-4">
					<div class="truncate sm:whitespace-normal flex items-center">
                        <a href="mailto:{{ $customer->email }}">
                            <i data-feather="mail" class="w-4 h-4 mr-2"></i>{{ $customer->email }}
                        </a>
					</div>
					@if($customer->instagram)
                        <div class="truncate sm:whitespace-normal flex items-center mt-3">
                            <a href="{{ $customer->instagram }}">
                                <i data-feather="instagram" class="w-4 h-4 mr-2"></i>{{ $customer->instagram_name }}
                            </a>
                        </div>
                    @endif
                    @if($customer->facebook)
                        <div class="truncate sm:whitespace-normal flex items-center mt-3">
                            <a href="{{ $customer->facebook }}">
                                <i data-feather="facebook" class="w-4 h-4 mr-2"></i>{{ $customer->facebook_name }}
                            </a>
                        </div>
                    @endif
					<div class="truncate sm:whitespace-normal flex items-center mt-3">
                        <a href="tel:{{ $customer->phone }}">
                            <i data-feather="phone" class="w-4 h-4 mr-2"></i>{{ $customer->phone }}
                        </a>
					</div>
				</div>
			</div>
			<div class="mt-6 lg:mt-0 flex-1 flex items-center justify-center px-5 border-t lg:border-0 border-dark-5 pt-5 lg:pt-0">
				<div class="text-center rounded-md w-32 py-3">
					<div class="font-medium text-theme-10 text-xl">{{ $customer->projects->count() }}</div>
					<div class="text-gray-600">Done projects</div>
				</div>
				<div class="text-center rounded-md w-32 py-3">
					<div class="font-medium text-theme-10 text-xl">{{ $customer->projects->count() }}</div>
					<div class="text-gray-600">Working projects</div>
				</div>
			</div>
		</div>
		<div class="nav nav-tabs flex-col sm:flex-row justify-center lg:justify-start" role="tablist">
			<a id="profile-tab" data-toggle="tab" data-target="#profile" href="javascript:;" class="py-4 sm:mr-8 flex items-center active" role="tab" aria-controls="profile" aria-selected="true">
				<i class="w-4 h-4 mr-2" data-feather="user"></i> Review
			</a>
			<a id="projects-tab" data-toggle="tab" data-target="#projects" href="javascript:;" class="py-4 sm:mr-8 flex items-center" role="tab" aria-selected="false">
				<i class="w-4 h-4 mr-2" data-feather="shield"></i> Projects
			</a>
			<a id="account-tab" data-toggle="tab" data-target="#account" href="javascript:;" class="py-4 sm:mr-8 flex items-center" role="tab" aria-selected="false">
				<i class="w-4 h-4 mr-2" data-feather="shield"></i> Invoices
			</a>
			<a id="change-password-tab" data-toggle="tab" data-target="#change-password" href="{{ route('admin.customer.edit', $customer) }}" class="py-4 sm:mr-8 flex items-center" role="tab" aria-selected="false">
				<i class="w-4 h-4 mr-2" data-feather="edit"></i> Edit profile
			</a>
		</div>
	</div>
	<!-- END: Profile Info -->
	<div class="tab-content mt-5">
		<div id="profile" class="tab-pane active" role="tabpanel" aria-labelledby="profile-tab">
			<div class="grid grid-cols-12 gap-6">
				<div class="intro-y box col-span-12 lg:col-span-6">
					<div class="flex items-center px-5 py-5 sm:py-0 border-b border-dark-5">
						<h2 class="font-medium text-base mr-auto py-5">Customer data</h2>
					</div>
					<div class="p-5">
						<div class="tab-content">
							<div id="work-in-progress-new" class="tab-pane active" role="tabpanel" aria-labelledby="work-in-progress-new-tab">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-3">
                                    <div class="col-span-1">
                                        <div><strong>First name</strong></div>
                                        <div>{{ $customer->name }}</div>
                                    </div>
                                    <div class="col-span-1">
                                        <div><strong>Last name</strong></div>
                                        <div>{{ $customer->surname }}</div>
                                    </div>
                                    <div class="col-span-1">
                                        <div><strong>Position</strong></div>
                                        <div>{{ $customer->position }}</div>
                                    </div>
                                    <div class="col-span-1">
                                        <div><strong>Based in</strong></div>
                                        <div>{{ $customer->based }}</div>
                                    </div>
                                    <div class="col-span-1">
                                        <div><strong>Phone</strong></div>
                                        <div>{{ $customer->phone }}</div>
                                    </div>
                                    <div class="col-span-1">
                                        <div><strong>Email</strong></div>
                                        <div>{{ $customer->email }}</div>
                                    </div>
                                </div>
							</div>
						</div>
					</div>
				</div>
                @if ($customer->invoiceDetails)
                    <div class="intro-y box col-span-12 lg:col-span-6">
                        <div class="flex items-center px-5 py-5 sm:py-0 border-b border-dark-5">
                            <h2 class="font-medium text-base mr-auto py-5">Billing data</h2>
                        </div>
                        <div class="p-5">
                            <div class="tab-content">
                                <div id="work-in-progress-new" class="tab-pane active" role="tabpanel" aria-labelledby="work-in-progress-new-tab">
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-3">
                                        <div class="col-span-1">
                                            <div><strong>Company</strong></div>
                                            <div>{{ $customer->invoiceDetails->company }}</div>
                                        </div>
                                        <div class="col-span-1">
                                            <div><strong>Street</strong></div>
                                            <div>{{ $customer->invoiceDetails->street }}</div>
                                        </div>
                                        <div class="col-span-1">
                                            <div><strong>City</strong></div>
                                            <div>{{ $customer->invoiceDetails->city }}</div>
                                        </div>
                                        <div class="col-span-1">
                                            <div><strong>Postcode</strong></div>
                                            <div>{{ $customer->invoiceDetails->postcode }}</div>
                                        </div>
                                        <div class="col-span-1">
                                            <div><strong>Country</strong></div>
                                            <div>{{ $customer->invoiceDetails->country }}</div>
                                        </div>
                                        @if ($customer->invoiceDetails->ico)
                                            <div class="col-span-1">
                                                <div><strong>IČO</strong></div>
                                                <div>{{ $customer->invoiceDetails->ico }}</div>
                                            </div>
                                        @endif
                                        @if ($customer->invoiceDetails->dic)
                                            <div class="col-span-1">
                                                <div><strong>DIČ</strong></div>
                                                <div>{{ $customer->invoiceDetails->dic }}</div>
                                            </div>
                                        @endif
                                        @if ($customer->invoiceDetails->icdph)
                                            <div class="col-span-1">
                                                <div><strong>IČ DPH</strong></div>
                                                <div>{{ $customer->invoiceDetails->icdph }}</div>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
			</div>
		</div>
        <div id="projects" class="tab-pane" role="tabpanel" aria-labelledby="projects-tab">
            @if($customer->projects->count())
                <div class="grid grid-cols-12 gap-4">
                    @foreach ($customer->projects as $project)
                        <div class="intro-y col-span-6 md:col-span-6">
                            <div class="box">
                                <div class="flex flex-col lg:flex-row items-center p-5 border-b border-gray-200 dark:border-dark-5">
                                    <div class="w-24 h-24 lg:w-12 lg:h-12 image-fit lg:mr-1">
                                        <img alt="Rubick Tailwind HTML Admin Template" class="rounded-full" src="{{ route('admin.project.image', $project) }}">
                                    </div>
                                    <div class="lg:ml-2 lg:mr-auto text-center lg:text-left mt-3 lg:mt-0">
                                        <a href="" class="font-medium">{{ $project->name }}</a>
                                        <div class="text-gray-600 text-xs mt-0.5">{{ $project->departmentsString() }}</div>
                                    </div>
                                    <div class="flex -ml-2 lg:ml-0 lg:justify-end mt-3 lg:mt-0">
                                        <a href="" class="w-8 h-8 rounded-full flex items-center justify-center border dark:border-dark-5 ml-2 text-gray-500 zoom-in tooltip" title="Instagram">
                                            <i class="w-3 h-3" data-feather="instagram"></i>
                                        </a>
                                        <a href="" class="w-8 h-8 rounded-full flex items-center justify-center border dark:border-dark-5 ml-2 text-gray-500 zoom-in tooltip" title="External link">
                                            <i class="w-3 h-3" data-feather="external-link"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="flex flex-wrap lg:flex-nowrap items-center justify-center p-5">
                                    <div class="w-full lg:w-1/2 mb-4 lg:mb-0 mr-auto">
                                        <div class="flex text-gray-600 text-xs">
                                            <div class="mr-auto">Progress</div>
                                            <div>20%</div>
                                        </div>
                                        <div class="progress h-1 mt-2">
                                            <div class="progress-bar w-1/4 bg-theme-1" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                    <a href="" class="btn btn-outline-secondary py-1 mr-2">Add task</a>
                                    <a href="{{ route('admin.project.show', $project) }}" class="btn btn-primary py-1 px-2">Open</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <h3 class="text-center">This customer has no project yet. Create new project <a class="text-primary-2" href="{{ route('admin.project.create', ['customer' => $customer]) }}">here.</a></h3>
            @endif
        </div>
	</div>

    @include('admin.components.messages')
@endsection

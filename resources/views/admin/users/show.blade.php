@extends('/admin/layout/' . $layout)

@section('subhead')
	<title>Profile</title>
@endsection

@section('breadcrumb')
    <a href="">Anstudio</a>
    <i data-feather="chevron-right" class="breadcrumb__icon"></i>
    <a href="{{ route('admin.user.index') }}">Users</a>
    <i data-feather="chevron-right" class="breadcrumb__icon"></i>
    <a href="" class="breadcrumb--active">{{ $user->name }} {{ $user->surname }}</a>
@endsection

@section('subcontent')
	<div class="intro-y flex items-center mt-8">
		<h2 class="text-lg font-medium mr-auto">Profile</h2>
	</div>
	<!-- BEGIN: Profile Info -->
	<div class="intro-y box px-5 pt-5 mt-5">
		<div class="flex flex-col lg:flex-row border-b border-gray-200 dark:border-dark-5 pb-5 -mx-5">
			<div class="flex flex-1 px-5 items-center justify-center lg:justify-start">
				<img alt="Rubick Tailwind HTML Admin Template" class="w-24 h-24 rounded-full object-cover" src="{{ route('admin.user.avatar', $user) }}">
				<div class="ml-5">
					<div class="w-24 sm:w-40 truncate sm:whitespace-normal font-medium text-lg">{{ $user->name }} {{ $user->surname }}</div>
					<div class="text-gray-600">{{ $user->position }}</div>
				</div>
			</div>
			<div class="mt-6 lg:mt-0 flex-1 dark:text-gray-300 px-5 border-l border-r border-gray-200 dark:border-dark-5 border-t lg:border-t-0 pt-5 lg:pt-0">
				<div class="font-medium text-center lg:text-left lg:mt-3">Contact Details</div>
				<div class="flex flex-col justify-center items-center lg:items-start mt-4">
					<div class="truncate sm:whitespace-normal flex items-center">
                        <a href="mailto:{{ $user->email }}"><i data-feather="mail" class="w-4 h-4 mr-2"></i>{{ $user->email }}</a>
					</div>
					<div class="truncate sm:whitespace-normal flex items-center mt-3">
                        <a href="tel:{{ $user->phone }}"><i data-feather="phone" class="w-4 h-4 mr-2"></i>{{ $user->phone }}</a>
					</div>
				</div>
			</div>
			<div class="mt-6 lg:mt-0 flex-1 flex items-center justify-center px-5 border-t lg:border-0 border-gray-200 dark:border-dark-5 pt-5 lg:pt-0">
				<div class="text-center rounded-md w-20 py-3">
					<div class="font-medium text-theme-1 dark:text-theme-10 text-xl">{{ $user->projects->count() }}</div>
					<div class="text-gray-600">Projects</div>
				</div>
				<div class="text-center rounded-md w-20 py-3">
					<div class="font-medium text-theme-1 dark:text-theme-10 text-xl">{{ $user->tasks->count() }}</div>
					<div class="text-gray-600">Tasks</div>
				</div>
				<div class="text-center rounded-md w-20 py-3">
					<div class="font-medium text-theme-1 dark:text-theme-10 text-xl">10</div>
					<div class="text-gray-600">Hours</div>
				</div>
			</div>
		</div>
		<div class="nav nav-tabs flex-col sm:flex-row justify-center lg:justify-start" role="tablist">
			<a id="profile-tab" data-toggle="tab" data-target="#profile" href="javascript:;" class="py-4 sm:mr-8 flex items-center active" role="tab" aria-controls="profile" aria-selected="true">
				<i class="w-4 h-4 mr-2" data-feather="user"></i> Reviews
			</a>
			<a id="account-tab" data-toggle="tab" data-target="#account" href="javascript:;" class="py-4 sm:mr-8 flex items-center" role="tab" aria-selected="false">
				<i class="w-4 h-4 mr-2" data-feather="shield"></i> Invoices
			</a>
			<a id="account-tab" data-toggle="tab" data-target="#account" href="javascript:;" class="py-4 sm:mr-8 flex items-center" role="tab" aria-selected="false">
				<i class="w-4 h-4 mr-2" data-feather="shield"></i> Tasks
			</a>
			<a id="change-password-tab" data-toggle="tab" data-target="#change-password" href="{{ route('admin.user.edit', $user) }}" class="py-4 sm:mr-8 flex items-center" role="tab" aria-selected="false">
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
                                        <div>{{ $user->name }}</div>
                                    </div>
                                    <div class="col-span-1">
                                        <div><strong>Last name</strong></div>
                                        <div>{{ $user->surname }}</div>
                                    </div>
                                    <div class="col-span-1">
                                        <div><strong>Departments</strong></div>
                                        <div>{{ $user->departmentsString() }}</div>
                                    </div>
                                    <div class="col-span-1">
                                        <div><strong>Phone</strong></div>
                                        <div>{{ $user->phone }}</div>
                                    </div>
                                    <div class="col-span-1">
                                        <div><strong>Email</strong></div>
                                        <div>{{ $user->email }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @if ($user->invoiceDetails)
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
                                            <div>{{ $user->invoiceDetails->company }}</div>
                                        </div>
                                        <div class="col-span-1">
                                            <div><strong>Street</strong></div>
                                            <div>{{ $user->invoiceDetails->street }}</div>
                                        </div>
                                        <div class="col-span-1">
                                            <div><strong>City</strong></div>
                                            <div>{{ $user->invoiceDetails->city }}</div>
                                        </div>
                                        <div class="col-span-1">
                                            <div><strong>Postcode</strong></div>
                                            <div>{{ $user->invoiceDetails->postcode }}</div>
                                        </div>
                                        <div class="col-span-1">
                                            <div><strong>Country</strong></div>
                                            <div>{{ $user->invoiceDetails->country }}</div>
                                        </div>
                                        @if ($user->invoiceDetails->ico)
                                            <div class="col-span-1">
                                                <div><strong>IČO</strong></div>
                                                <div>{{ $user->invoiceDetails->ico }}</div>
                                            </div>
                                        @endif
                                        @if ($user->invoiceDetails->dic)
                                            <div class="col-span-1">
                                                <div><strong>DIČ</strong></div>
                                                <div>{{ $user->invoiceDetails->dic }}</div>
                                            </div>
                                        @endif
                                        @if ($user->invoiceDetails->icdph)
                                            <div class="col-span-1">
                                                <div><strong>IČ DPH</strong></div>
                                                <div>{{ $user->invoiceDetails->icdph }}</div>
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
	</div>

    @include('admin.components.messages')
@endsection

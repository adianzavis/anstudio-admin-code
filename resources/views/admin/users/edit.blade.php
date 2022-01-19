@extends('/admin/layout/' . $layout)

@section('subhead')
	<title>Edit profile</title>
@endsection

@section('breadcrumb')
    <a href="">Anstudio</a>
    <i data-feather="chevron-right" class="breadcrumb__icon"></i>
    <a href="">Users</a>
    <i data-feather="chevron-right" class="breadcrumb__icon"></i>
    <a href="{{ route('admin.user.show', $user) }}">{{ $user->name }} {{ $user->surname }}</a>
    <i data-feather="chevron-right" class="breadcrumb__icon"></i>
    <a href="" class="breadcrumb--active">Edit</a>
@endsection

@section('subcontent')
	<div class="intro-y flex items-center mt-8">
		<h2 class="text-lg font-medium mr-auto">Update Profile</h2>
	</div>
	<div id="edit-form" class="grid grid-cols-12 gap-6">
		<!-- BEGIN: Profile Menu -->
		<div class="col-span-12 lg:col-span-4 xxl:col-span-3 flex lg:block flex-col-reverse">
			<div class="intro-y box mt-5">
				<div class="relative flex items-center p-5">
					<img alt="User image" class="w-12 h-12 rounded-full object-cover" src="{{ route('admin.user.avatar', $user) }}">
					<div class="ml-4 mr-auto">
						<div class="font-medium text-base">Adrian Zavis</div>
						<div class="text-gray-600">{{ $user->position }}</div>
					</div>
				</div>
				<div class="left-navigation nav-tabs">
					<a id="personal-tab" data-toggle="tab" data-target="#personal" href="#personal" class="item active">
						<i data-feather="user" class="icon"></i> Personal data
					</a>
					<a id="billing-tab" data-toggle="tab" data-target="#billing" href="#billing" class="item">
						<i data-feather="activity" class="icon"></i> Billing details
					</a>
					<a id="password-tab" data-toggle="tab" data-target="#password" href="#password" class="item">
						<i data-feather="lock" class="icon"></i> Change Password
					</a>
				</div>
				<div class="p-5 border-t border-gray-200 dark:border-dark-5 flex">
					<button form="update-user-form" type="submit" class="btn btn-primary py-1 px-2">Save profile</button>
				</div>
			</div>
		</div>
        <div class="tab-content col-span-12 lg:col-span-8 xxl:col-span-9">
            <div id="personal" class="tab-pane active" role="tabpanel" aria-labelledby="dashboard-tab">
                <div class="intro-y box lg:mt-5">
                    <div class="flex items-center p-5 border-b border-gray-200 dark:border-dark-5">
                        <h2 class="font-medium text-base mr-auto">Personal Informations</h2>
                    </div>
                    <div class="p-5">
                        <form action="{{ route('admin.user.update', $user) }}" method="POST" enctype="multipart/form-data" id="update-user-form" class="flex flex-col-reverse xl:flex-row flex-col">
                            @csrf
                            <div class="flex-1 mt-6 xl:mt-0">
                                <div class="grid grid-cols-12 gap-2">
                                    <div class="col-span-6">
                                        {{ Form::textGroup('name', old('name', $user->name), 'First name') }}
                                    </div>
                                    <div class="col-span-6">
                                        {{ Form::textGroup('surname', old('surname', $user->surname), 'Last name') }}
                                    </div>
                                    <div class="col-span-6">
                                        {{ Form::textGroup('phone', old('phone', $user->phone), 'Phone') }}
                                    </div>
                                    <div class="col-span-6">
                                        {{ Form::textGroup('email', old('email', $user->email), 'E-mail') }}
                                    </div>
                                    <div class="col-span-6">
                                        <label for="departments" class="form-label">Department</label>
                                        {{ Form::select('departments[]', $departments, $user->departments, ['class' => 'tail-select w-full', 'id' => 'departments', 'multiple']) }}
                                    </div>
                                    <div class="col-span-6">
                                        {{ Form::textGroup('position', old('position', $user->position), 'Position') }}
                                    </div>
                                    <div class="col-span-12">
                                        {{ Form::textAreaGroup('description', old('description', $user->description), 'Description', ['placeholder' => '...']) }}
                                    </div>
                                </div>
                            </div>
                            <div class="w-52 mx-auto xl:mr-0 xl:ml-6">
                                <div class="border-2 border-dashed shadow-sm border-gray-200 border-dark-5 rounded-md p-5 photo-select-template-wrapper">
                                    <div class="h-60 md:h-40 relative image-fit cursor-pointer zoom-in mx-auto">
                                        <img class="rounded-md photo-select-template" src="{{ route('admin.user.avatar', $user) }}">
                                        <img class="photo-select-original hidden" src="{{ route('admin.user.avatar', $user) }}">
                                    </div>
                                    <div class="mx-auto cursor-pointer relative mt-5">
                                        <button type="button" class="btn btn-primary w-full">Select Photo</button>
                                        {{ Form::file('avatar', ['class' => 'w-full h-full top-0 left-0 absolute opacity-0 photo-select']) }}
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="intro-y box mt-5">
                    <div class="flex items-center p-5 border-b border-gray-200 dark:border-dark-5">
                        <h2 class="font-medium text-base mr-auto">Address</h2>
                    </div>
                    <div class="p-5">
                        <div class="flex-1 mt-6 xl:mt-0">
                            <div class="grid grid-cols-12 gap-2">
                                <div class="col-span-12 md:col-span-6">
                                    {{ Form::textGroup('street', old('street', $user->street), 'Street', ['placeholder' => 'Kúpelná 5']) }}
                                </div>
                                <div class="col-span-12 md:col-span-6">
                                    {{ Form::textGroup('postcode', old('postcode', $user->postcode), 'Postcode', ['placeholder' => '901 05']) }}
                                </div>
                                <div class="col-span-12 md:col-span-6">
                                    {{ Form::textGroup('city', old('city', $user->city), 'City', ['placeholder' => 'Bratislava']) }}
                                </div>
                                <div class="col-span-12 md:col-span-6">
                                    {{ Form::textGroup('country', old('country', $user->country), 'Country', ['placeholder' => 'Slovakia']) }}
                                </div>
                            </div>
                        </div>
                        <div class="flex justify-end mt-4">
                            <a href="" class="text-theme-6 flex items-center">
                                <i data-feather="trash-2" class="w-4 h-4 mr-1"></i> Delete Account
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div id="billing" class="tab-pane" role="tabpanel" aria-labelledby="dashboard-tab">
                <div class="intro-y box lg:mt-5">
                    <div class="flex items-center p-5 border-b border-gray-200 dark:border-dark-5">
                        <h2 class="font-medium text-base mr-auto">Billing details</h2>
                    </div>
                    <div class="p-5">
                        <div class="grid grid-cols-12 gap-2">
                            <div class="col-span-12">
                                {{ Form::textGroup('iban', old('iban', $user->iban ?? null), 'IBAN', ['form' => 'update-user-form', 'class' => 'form-control']) }}
                            </div>
                            <div class="col-span-12 md:col-span-6">
                                {{ Form::toggleGroup('invoiceable', 1, old('invoiceable', $user->invoiceDetails), 'Invoiceable', ['form' => 'update-user-form', 'class' => 'form-check-switch invoice-data-toggle']) }}
                            </div>
                            <div class="col-span-12 md:col-span-6">
                                {{ Form::toggleGroup('dph', 1, old('dph', $user->invoiceDetails->dph ?? null), 'DPH', ['form' => 'update-user-form', 'class' => 'form-check-switch invoice-data-switch opacity-75', (!$user->invoiceDetails) ? 'disabled' : 'enabled']) }}
                            </div>
                            <div class="col-span-12 md:col-span-6">
                                {{ Form::textGroup('company', old('company', $user->invoiceDetails->company ?? null), 'Company', ['form' => 'update-user-form', 'class' => 'form-control invoice-data-switch opacity-75', (!$user->invoiceDetails) ? 'disabled' : 'enabled']) }}
                            </div>
                            <div class="col-span-12 md:col-span-6">
                                {{ Form::textGroup('street', old('street', $user->invoiceDetails->street ?? null), 'Street', ['form' => 'update-user-form', 'class' => 'form-control invoice-data-switch opacity-75', (!$user->invoiceDetails) ? 'disabled' : 'enabled']) }}
                            </div>
                            <div class="col-span-12 md:col-span-6">
                                {{ Form::textGroup('city', old('city', $user->invoiceDetails->city ?? null), 'City', ['form' => 'update-user-form', 'class' => 'form-control invoice-data-switch opacity-75', (!$user->invoiceDetails) ? 'disabled' : 'enabled']) }}
                            </div>
                            <div class="col-span-12 md:col-span-6">
                                {{ Form::textGroup('postcode', old('postcode', $user->invoiceDetails->postcode ?? null), 'Postcode', ['form' => 'update-user-form', 'class' => 'form-control invoice-data-switch opacity-75', (!$user->invoiceDetails) ? 'disabled' : 'enabled']) }}
                            </div>
                            <div class="col-span-12 md:col-span-6">
                                {{ Form::textGroup('country', old('country', $user->invoiceDetails->country ?? null), 'Country', ['form' => 'update-user-form', 'class' => 'form-control invoice-data-switch opacity-75', (!$user->invoiceDetails) ? 'disabled' : 'enabled']) }}
                            </div>
                            <div class="col-span-12 md:col-span-6">
                                {{ Form::textGroup('ico', old('ico', $user->invoiceDetails->ico ?? null), 'ICO', ['form' => 'update-user-form', 'class' => 'form-control invoice-data-switch opacity-75', (!$user->invoiceDetails) ? 'disabled' : 'enabled']) }}
                            </div>
                            <div class="col-span-12 md:col-span-6">
                                {{ Form::textGroup('dic', old('dic', $user->invoiceDetails->dic ?? null), 'DIC', ['form' => 'update-user-form', 'class' => 'form-control invoice-data-switch opacity-75', (!$user->invoiceDetails) ? 'disabled' : 'enabled']) }}
                            </div>
                            <div class="col-span-12 md:col-span-6">
                                {{ Form::textGroup('icdph', old('icdph', $user->invoiceDetails->icdph ?? null), 'ICDPH', ['form' => 'update-user-form', 'class' => 'form-control invoice-data-switch opacity-75', (!$user->invoiceDetails) ? 'disabled' : 'enabled']) }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="password" class="tab-pane" role="tabpanel" aria-labelledby="dashboard-tab">
                <div class="intro-y box lg:mt-5">
                    <div class="flex items-center p-5 border-b border-gray-200 dark:border-dark-5">
                        <h2 class="font-medium text-base mr-auto">Change password</h2>
                    </div>
                    <div class="p-5">
                        <div class="grid grid-cols-2 gap-4">
                            <div class="col-span-2 md:col-span-1">
                                {{ Form::passwordGroup('password', null, 'Password', ['class' => 'form-control']) }}
                            </div>
                            <div class="col-span-2 md:col-span-1">
                                {{ Form::passwordGroup('password', null, 'Repeat password', ['class' => 'form-control']) }}
                            </div>
                        </div>
                        <div class="flex justify-end">
                            <button type="button" class="btn btn-primary mt-3">Change password</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
	</div>

    <script>
        document.querySelector('.invoice-data-toggle').addEventListener('change', e => {
            if (!e.target.checked)
                document.querySelectorAll('.invoice-data-switch').forEach(el => {
                    el.classList.add('opacity-75');
                    el.disabled = true;
                    el.value = null;
                    el.checked = false;
                });
            else
                document.querySelectorAll('.invoice-data-switch').forEach(el => {
                    el.classList.remove('opacity-75');
                    el.disabled = false;
                });
        });

        if ('{{ old('invoiceable', $user->invoiceDetails) }}') {
            const invoiceAbleCheckbox = document.querySelector('.invoice-data-toggle');
            invoiceAbleCheckbox.dispatchEvent(new Event("change"));
        }
    </script>
@endsection

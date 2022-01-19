@extends('/admin/layout/' . $layout)

@section('subhead')
	<title>Update Profile - Rubick - Tailwind HTML Admin Template</title>
@endsection

@section('breadcrumb')
    <a href="">Anstudio</a>
    <i data-feather="chevron-right" class="breadcrumb__icon"></i>
    <a href="{{ route('admin.customer.index') }}">Customers</a>
    <i data-feather="chevron-right" class="breadcrumb__icon"></i>
    <a href="{{ route('admin.customer.show', $customer) }}">{{ $customer->name }} {{ $customer->surname }}</a>
    <i data-feather="chevron-right" class="breadcrumb__icon"></i>
    <a href="" class="breadcrumb--active">Edit</a>
@endsection

@section('subcontent')
	<div class="intro-y flex items-center mt-8">
		<h2 class="text-lg font-medium mr-auto">Update Customer</h2>
	</div>
	<div class="grid grid-cols-12 gap-6">
        {!! Form::open(['route' => ['admin.customer.update', $customer], 'method' => 'POST', 'files' => true, 'class' => 'col-span-12 lg:col-span-8 xxl:col-span-9']) !!}
            @csrf
			<div class="intro-y box lg:mt-5">
				<div class="flex items-center p-5 border-b border-gray-200 border-dark-5">
					<h2 class="font-medium text-base mr-auto">Personal Information</h2>
				</div>
				<div class="p-5">
					<div class="flex flex-col-reverse xl:flex-row flex-col">
						<div class="flex-1 mt-6 xl:mt-0">
                            <div class="grid grid-cols-12 gap-2 w-full">
                                <div class="col-span-12 md:col-span-6">
                                    {{ Form::textGroup('name', old('name', $customer->name), 'First name') }}
                                </div>
                                <div class="col-span-12 md:col-span-6">
                                    {{ Form::textGroup('surname', old('surname', $customer->surname), 'Last name') }}
                                </div>
                                <div class="col-span-12 md:col-span-6">
                                    {{ Form::textGroup('position', old('position', $customer->position), 'Position') }}
                                </div>
                                <div class="col-span-12 md:col-span-6">
                                    {{ Form::textGroup('based', old('based', $customer->based), 'Based in') }}
                                </div>
                                <div class="col-span-12 md:col-span-6">
                                    {{ Form::textGroup('phone', old('phone', $customer->phone), 'Phone') }}
                                </div>
                                <div class="col-span-12 md:col-span-6">
                                    {{ Form::textGroup('email', old('email', $customer->email), 'E-mail') }}
                                </div>
                                <div class="col-span-12 md:col-span-6">
                                    {{ Form::textGroup('facebook', old('facebook', $customer->facebook), 'Facebook') }}
                                </div>
                                <div class="col-span-12 md:col-span-6">
                                    {{ Form::textGroup('instagram', old('instagram', $customer->instagram), 'Instagram') }}
                                </div>
                                <div class="col-span-12">
                                    {{ Form::textAreaGroup('description', old('description', $customer->description), 'Description') }}
                                </div>
                            </div>
						</div>
						<div class="w-52 mx-auto xl:mr-0 xl:ml-6">
                            <div class="border-2 border-dashed shadow-sm border-gray-200 border-dark-5 rounded-md p-5 photo-select-template-wrapper">
                                <div class="h-60 md:h-40 relative image-fit cursor-pointer zoom-in mx-auto">
                                    <img class="rounded-md photo-select-template" src="{{ route('admin.customer.avatar', $customer) }}">
                                    <img class="photo-select-original hidden" src="{{ route('admin.customer.avatar', $customer) }}">
                                </div>
                                <div class="mx-auto cursor-pointer relative mt-5">
                                    <button type="button" class="btn btn-primary w-full">Select Photo</button>
                                    {{ Form::file('avatar', ['class' => 'w-full h-full top-0 left-0 absolute opacity-0 photo-select']) }}
                                </div>
                            </div>
						</div>
					</div>
				</div>
			</div>
			<div class="intro-y box mt-5">
				<div class="flex items-center p-5 border-b border-gray-200 border-dark-5">
					<h2 class="font-medium text-base mr-auto">Billing details</h2>
				</div>
				<div class="p-5">
					<div class="flex-1 mt-6 xl:mt-0">
                        <div class="grid grid-cols-12 gap-2 mt-3">
                            <div class="col-span-12 md:col-span-6">
                                {{ Form::toggleGroup('invoiceable', 1, old('invoiceable', $customer->invoiceDetails), 'Invoiceable', ['class' => 'form-check-switch invoice-data-toggle']) }}
                            </div>
                            <div class="col-span-12 md:col-span-6">
                                {{ Form::toggleGroup('dph', 1, old('dph', $customer->invoiceDetails->dph ?? null), 'DPH', ['class' => 'form-check-switch invoice-data-switch opacity-75', (!$customer->invoiceDetails) ? 'disabled' : 'enabled']) }}
                            </div>
                            <div class="col-span-12 md:col-span-6">
                                {{ Form::textGroup('company', old('company', $customer->invoiceDetails->company ?? null), 'Company', ['class' => 'form-control invoice-data-switch opacity-75', (!$customer->invoiceDetails) ? 'disabled' : 'enabled']) }}
                            </div>
                            <div class="col-span-12 md:col-span-6">
                                {{ Form::textGroup('street', old('street', $customer->invoiceDetails->street ?? null), 'Street', ['class' => 'form-control invoice-data-switch opacity-75', (!$customer->invoiceDetails) ? 'disabled' : 'enabled']) }}
                            </div>
                            <div class="col-span-12 md:col-span-6">
                                {{ Form::textGroup('city', old('city', $customer->invoiceDetails->city ?? null), 'City', ['class' => 'form-control invoice-data-switch opacity-75', (!$customer->invoiceDetails) ? 'disabled' : 'enabled']) }}
                            </div>
                            <div class="col-span-12 md:col-span-6">
                                {{ Form::textGroup('postcode', old('postcode', $customer->invoiceDetails->postcode ?? null), 'Postcode', ['class' => 'form-control invoice-data-switch opacity-75', (!$customer->invoiceDetails) ? 'disabled' : 'enabled']) }}
                            </div>
                            <div class="col-span-12 md:col-span-6">
                                {{ Form::textGroup('country', old('country', $customer->invoiceDetails->country ?? null), 'Country', ['class' => 'form-control invoice-data-switch opacity-75', (!$customer->invoiceDetails) ? 'disabled' : 'enabled']) }}
                            </div>
                            <div class="col-span-12 md:col-span-6">
                                {{ Form::textGroup('ico', old('ico', $customer->invoiceDetails->ico ?? null), 'ICO', ['class' => 'form-control invoice-data-switch opacity-75', (!$customer->invoiceDetails) ? 'disabled' : 'enabled']) }}
                            </div>
                            <div class="col-span-12 md:col-span-6">
                                {{ Form::textGroup('dic', old('dic', $customer->invoiceDetails->dic ?? null), 'DIC', ['class' => 'form-control invoice-data-switch opacity-75', (!$customer->invoiceDetails) ? 'disabled' : 'enabled']) }}
                            </div>
                            <div class="col-span-12 md:col-span-6">
                                {{ Form::textGroup('icdph', old('icdph', $customer->invoiceDetails->icdph ?? null), 'ICDPH', ['class' => 'form-control invoice-data-switch opacity-75', (!$customer->invoiceDetails) ? 'disabled' : 'enabled']) }}
                            </div>
                        </div>
                        <div class="flex w-full justify-between">
                            <a href="javascript:;" data-toggle="modal" data-target="#delete-modal-preview" type="submit" class="text-theme-6 flex items-center focus:outline-none mt-3">
                                <i data-feather="trash-2" class="w-4 h-4 mr-1"></i> Delete Account
                            </a>
                            <button type="submit" class="btn btn-primary w-20 mt-3">Save</button>
                        </div>
					</div>
				</div>
			</div>
        {{ Form::close() }}
	</div>

    <div id="delete-modal-preview" class="modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body p-0">
                    <div class="p-5 text-center">
                        <svg class="w-16 h-16 text-theme-6 mx-auto mt-3">
                            <use xlink:href="{{ asset('admin/images/reject-icon.svg#id') }}"></use>
                        </svg>
                        <div class="text-3xl mt-5">Are you sure?</div>
                        <div class="text-gray-600 mt-2">
                            Do you really want to delete <strong class="text-red-500">{{ $customer->name }} {{ $customer->surname }}</strong>? <br />
                            You cannot undone this action.
                        </div>
                    </div>
                    <form action="{{ route('admin.customer.delete', $customer) }}" method="POST" class="px-5 pb-8 text-center">
                        @csrf
                        <button type="button" data-dismiss="modal" class="btn btn-outline-secondary w-24 dark:border-dark-5 dark:text-gray-300 mr-1">
                            Cancel
                        </button>
                        <button type="submit" class="btn btn-danger w-24">
                            Delete
                        </button>
                    </form>
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

        if ('{{ old('invoiceable', $customer->invoiceDetails) }}') {
            const invoiceAbleCheckbox = document.querySelector('.invoice-data-toggle');
            invoiceAbleCheckbox.dispatchEvent(new Event("change"));
        }
    </script>
@endsection

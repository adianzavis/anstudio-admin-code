@extends('/admin/layout/' . $layout)

@section('subhead')
	<title>Create customer</title>
@endsection

@section('breadcrumb')
    <a href="">Anstudio</a>
    <i data-feather="chevron-right" class="breadcrumb__icon"></i>
    <a href="{{ route('admin.customer.index') }}">Customers</a>
    <i data-feather="chevron-right" class="breadcrumb__icon"></i>
    <a href="" class="breadcrumb--active">Create</a>
@endsection

@section('subcontent')
	<div class="flex items-center mt-8">
		<h2 class="text-lg font-medium mr-auto">New customer</h2>
	</div>

	<div class="box py-10 sm:py-20 mt-5">
		<div class="wizard flex flex-col lg:flex-row justify-center px-5 sm:px-20">
			<div class="form-step-indicator active" data-step-indicator="1">
				<button class="">1</button>
				<div class="">Personal data</div>
			</div>
			<div class="form-step-indicator" data-step-indicator="2">
				<button>2</button>
				<div>Invoice data</div>
			</div>
		</div>
            {!! Form::open(['route' => 'admin.customer.create', 'method' => 'POST', 'files' => true]) !!}
            @csrf
            <div class="px-5 sm:px-20 mt-10 pt-10 border-t border-dark-5 form-container">
                <div class="form-step" data-step="1">
                    <div class="font-medium text-base">Personal data</div>
                    <div class="flex flex-col md:flex-row gap-y-8 md:gap-y-0 md:gap-x-8 mt-3">
                        <div class="w-full md:w-52 mx-auto xl:mr-0 flex-shrink-0">
                            <div class="border-2 border-dashed shadow-sm border-dark-5 p-5 photo-select-template-wrapper">
                                <div class="h-60 md:h-40 relative image-fit cursor-pointer zoom-in mx-auto">
                                    <img class="rounded-md photo-select-template" alt="Rubick Tailwind HTML Admin Template" src="{{ asset('admin/images/profile-17.jpg') }}">
                                </div>
                                <div class="mx-auto cursor-pointer relative mt-5">
                                    <button type="button" class="btn btn-primary w-full">Select Photo</button>
                                    {{ Form::file('avatar', ['class' => 'w-full h-full top-0 left-0 absolute opacity-0 photo-select']) }}
                                </div>
                            </div>
                        </div>
                        <div class="grid grid-cols-12 gap-2 w-full">
                            <div class="col-span-12 md:col-span-6">
                                {{ Form::textGroup('name', null, 'First name', ['placeholder' => 'Jozef']) }}
                            </div>
                            <div class="col-span-12 md:col-span-6">
                                {{ Form::textGroup('surname', null, 'Last name', ['placeholder' => 'Repan']) }}
                            </div>
                            <div class="col-span-12 md:col-span-6">
                                {{ Form::textGroup('position', null, 'Position', ['placeholder' => 'CEO']) }}
                            </div>
                            <div class="col-span-12 md:col-span-6">
                                {{ Form::textGroup('based', null, 'Based in', ['placeholder' => 'Bratislava']) }}
                            </div>
                            <div class="col-span-12 md:col-span-6">
                                {{ Form::textGroup('phone', null, 'Phone', ['placeholder' => '+421 111 222 333']) }}
                            </div>
                            <div class="col-span-12 md:col-span-6">
                                {{ Form::textGroup('email', null, 'E-mail', ['placeholder' => 'example@noreply.sk']) }}
                            </div>
                            <div class="col-span-12 md:col-span-6">
                                {{ Form::textGroup('facebook', null, 'Facebook', ['placeholder' => 'facebook.com/example']) }}
                            </div>
                            <div class="col-span-12 md:col-span-6">
                                {{ Form::textGroup('instagram', null, 'Instagram', ['placeholder' => 'instagram.com/example']) }}
                            </div>
                            <div class="col-span-12">
                                {{ Form::textAreaGroup('description', null, 'Description', ['placeholder' => '...']) }}
                            </div>
                            <div class="col-span-12 flex items-center justify-center sm:justify-end mt-5">
                                <button class="btn btn-primary w-24 ml-2" type="button" data-step-to="2">Next</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-step disappear hidden invoice-details" data-step="2">
                    <div class="font-medium text-base">Invoice data</div>
                    <div class="grid grid-cols-12 gap-2 mt-3">
                        <div class="col-span-12 md:col-span-6">
                            {{ Form::toggleGroup('invoiceable', 1, null, 'Invoiceable', ['class' => 'form-check-switch invoice-data-toggle']) }}
                        </div>
                        <div class="col-span-12 md:col-span-6">
                            {{ Form::toggleGroup('dph', 1, null, 'DPH', ['class' => 'form-check-switch invoice-data-switch opacity-75', 'disabled']) }}
                        </div>
                        <div class="col-span-12 md:col-span-6">
                            {{ Form::textGroup('company', null, 'Company', ['class' => 'form-control invoice-data-switch opacity-75', 'disabled']) }}
                        </div>
                        <div class="col-span-12 md:col-span-6">
                            {{ Form::textGroup('street', null, 'Street', ['class' => 'form-control invoice-data-switch opacity-75', 'disabled']) }}
                        </div>
                        <div class="col-span-12 md:col-span-6">
                            {{ Form::textGroup('city', null, 'City', ['class' => 'form-control invoice-data-switch opacity-75', 'disabled']) }}
                        </div>
                        <div class="col-span-12 md:col-span-6">
                            {{ Form::textGroup('postcode', null, 'Postcode', ['class' => 'form-control invoice-data-switch opacity-75', 'disabled']) }}
                        </div>
                        <div class="col-span-12 md:col-span-6">
                            {{ Form::textGroup('country', null, 'Country', ['class' => 'form-control invoice-data-switch opacity-75', 'disabled']) }}
                        </div>
                        <div class="col-span-12 md:col-span-6">
                            {{ Form::textGroup('ico', null, 'ICO', ['class' => 'form-control invoice-data-switch opacity-75', 'disabled']) }}
                        </div>
                        <div class="col-span-12 md:col-span-6">
                            {{ Form::textGroup('dic', null, 'DIC', ['class' => 'form-control invoice-data-switch opacity-75', 'disabled']) }}
                        </div>
                        <div class="col-span-12 md:col-span-6">
                            {{ Form::textGroup('icdph', null, 'ICDPH', ['class' => 'form-control invoice-data-switch opacity-75', 'disabled']) }}
                        </div>
                        <div class="col-span-12 flex items-center justify-center sm:justify-end mt-5">
                            <button class="btn btn-secondary w-24" type="button" data-step-to="1">Previous</button>
                            <button class="btn btn-primary w-24 ml-2" type="submit">Next</button>
                        </div>
                    </div>
                </div>
            </div>
        {!! Form::close() !!}
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

        if ('{{ old('invoiceable') }}') {
            const invoiceAbleCheckbox = document.querySelector('.invoice-data-toggle');
            invoiceAbleCheckbox.dispatchEvent(new Event("change"));
        }
    </script>
@endsection

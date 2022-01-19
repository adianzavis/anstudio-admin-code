@extends('/admin/layout/' . $layout)

@section('subhead')
    <title>Companies</title>
@endsection

@section('breadcrumb')
    <a href="">Anstudio</a>
    <i data-feather="chevron-right" class="breadcrumb__icon"></i>
    <a href="{{ route('admin.company.index') }}">Companies</a>
    <i data-feather="chevron-right" class="breadcrumb__icon"></i>
    <a class="breadcrumb--active">Create</a>
@endsection

@section('subcontent')
    <div class="flex items-center mt-8">
        <h2 class="intro-y text-lg font-medium mr-auto">New Company</h2>
    </div>

    <form action="{{ route('admin.company.create') }}" method="POST" enctype="multipart/form-data" class="intro-y box py-10 sm:py-20 mt-5" id="wizard">
        @csrf
        <div class="top-navigation nav-tabs">
            <a id="base-tab" data-toggle="tab" data-target="#base" href="#base" class="item active">
                <button type="button">1</button>
                <div class="label">Base Info</div>
            </a>
            <a id="billing-tab" data-toggle="tab" data-target="#billing" href="#billing" class="item">
                <button type="button">2</button>
                <div class="label">Billing data</div>
            </a>
        </div>
        <div class="tab-content">
            <div id="base" class="tab-pane active" role="tabpanel" aria-labelledby="dashboard-tab">
                <div class="px-5 sm:px-20 mt-10 pt-10 border-t border-gray-200 dark:border-dark-5">
                    <div class="font-medium text-base">Base Info</div>
                    <div class="flex flex-col md:flex-row gap-y-8 md:gap-y-0 md:gap-x-8 mt-5">
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
                        <div class="grid grid-cols-12 gap-2 w-full mt-3">
                            <div class="col-span-12 md:col-span-6">
                                {{ Form::textGroup('name', null, 'Name', ['placeholder' => 'anstudio s.r.o.']) }}
                            </div>
                            <div class="col-span-12 md:col-span-6">
                                    <label for="assignees">Assignees</label>
                                    {{ Form::select('assignees[]', $users, null, ['class' => 'tail-select w-full mt-1', 'id' => 'assignees', 'multiple']) }}
                            </div>
                            <div class="col-span-12">
                                {{ Form::textAreaGroup('description', null, 'Description', ['placeholder' => '...']) }}
                            </div>
                            <div class="intro-y col-span-12 flex items-center justify-center sm:justify-end mt-5">
                                <button type="button" data-toggle="click" data-target="#billing-tab" class="btn btn-primary w-24 ml-2">Next</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div id="address" class="tab-pane" role="tabpanel" aria-labelledby="dashboard-tab">
                <div class="px-5 sm:px-20 mt-10 pt-10 border-t border-gray-200 dark:border-dark-5">
                    <div class="font-medium text-base">Personal data</div>
                    <div class="grid grid-cols-12 gap-2 mt-3">
                        <div class="col-span-12 md:col-span-6">
                            {{ Form::textGroup('street', null, 'Street', ['placeholder' => 'Kúpelná 5']) }}
                        </div>
                        <div class="col-span-12 md:col-span-6">
                            {{ Form::textGroup('postcode', null, 'Postcode', ['placeholder' => '901 05']) }}
                        </div>
                        <div class="col-span-12 md:col-span-6">
                            {{ Form::textGroup('city', null, 'City', ['placeholder' => 'Bratislava']) }}
                        </div>
                        <div class="col-span-12 md:col-span-6">
                            {{ Form::textGroup('country', null, 'Country', ['placeholder' => 'Slovakia']) }}
                        </div>
                        <div class="intro-y col-span-12 flex items-center justify-center sm:justify-end mt-5">
                            <button type="button" data-toggle="click" data-target="#base-tab" class="btn btn-secondary w-24 ml-2">Previous</button>
                            <button type="button" data-toggle="click" data-target="#billing-tab" class="btn btn-primary w-24 ml-2">Next</button>
                        </div>
                    </div>
                </div>
            </div>

            <div id="billing" class="tab-pane" role="tabpanel" aria-labelledby="dashboard-tab">
                <div class="px-5 sm:px-20 mt-10 pt-10 border-t border-gray-200 dark:border-dark-5">
                    <div class="font-medium text-base">Billing data</div>
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
                        <div class="intro-y col-span-12 flex items-center justify-center sm:justify-end mt-5">
                            <button type="button" data-toggle="click" data-target="#address-tab" class="btn btn-secondary w-24 ml-2">Previous</button>
                            <button type="submit" class="btn btn-primary w-24 ml-2">Save</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

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

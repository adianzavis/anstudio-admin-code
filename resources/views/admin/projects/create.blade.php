@extends('/admin/layout/' . $layout)

@section('subhead')
	<title>Create project</title>
@endsection

@section('breadcrumb')
    <a href="">Anstudio</a>
    <i data-feather="chevron-right" class="breadcrumb__icon"></i>
    <a href="{{ route('admin.project.index') }}">Projects</a>
    <i data-feather="chevron-right" class="breadcrumb__icon"></i>
    <a href="" class="breadcrumb--active">Create</a>
@endsection

@section('subcontent')
	<div class="intro-y flex flex-col sm:flex-row items-center mt-8">
		<h2 class="text-lg font-medium mr-auto">New project</h2>
	</div>
	<form action="{{ route('admin.project.store') }}" method="POST" enctype="multipart/form-data" class="pos intro-y grid grid-cols-12 gap-5 mt-5">
		<!-- BEGIN: Post Content -->
        @csrf
		<div class="intro-y col-span-12 lg:col-span-8">
            {{ Form::textGroup('name', null, null, ['placeholder' => 'Project name...', 'class' => 'form-control intro-y py-3 px-4 box pr-10 placeholder-theme-13 w-full']) }}
			<div class="post intro-y overflow-hidden box mt-5">
				<div class="post__tabs nav nav-tabs flex-col sm:flex-row bg-gray-300 dark:bg-dark-2 text-gray-600" role="tablist">
					<a title="Fill in the article content" data-toggle="tab" data-target="#description" href="javascript:;" class="tooltip w-full sm:w-40 py-4 text-center flex justify-center items-center active" id="description-tab" role="tab" aria-controls="content" aria-selected="true">
						<i data-feather="file-text" class="w-4 h-4 mr-2"></i> Info
					</a>
					<a title="Adjust the meta title" data-toggle="tab" data-target="#page_data" href="javascript:;" class="tooltip w-full sm:w-40 py-4 text-center flex justify-center items-center" id="page_data-tab" role="tab" aria-selected="false">
						<i data-feather="code" class="w-4 h-4 mr-2"></i> Subpage data
					</a>
					<a title="Use search keywords" data-toggle="tab" data-target="#seo" href="javascript:;" class="tooltip w-full sm:w-40 py-4 text-center flex justify-center items-center" id="seo-tab" role="tab" aria-selected="false">
						<i data-feather="align-left" class="w-4 h-4 mr-2"></i> SEO
					</a>
				</div>
				<div class="post__content tab-content p-5">
					<div id="description" class="tab-pane active" role="tabpanel" aria-labelledby="description-tab">
						<div class="grid grid-cols-12 gap-2 gap-x-4 mt-3">
							<div class="col-span-12">
                                {{ Form::textGroup('summary', null, 'Few words about') }}
							</div>
							<div class="col-span-12 mb-3">
								<label for="total_description" class="form-label">Total description</label>
                                <textarea id="total_description" name="total_description" class="editor"> {{ old('total_description', '<p>Project description.</p>')  }} </textarea>
                            </div>
                            <div class="col-span-12 md:row-span-4 lg:col-span-3 md:w-52 max-w-full xl:mr-0">
                                <label for="image" class="form-label">Project image</label>
                                <div class="border-2 border-dashed shadow-sm border-dark-5 p-5 photo-select-template-wrapper">
                                    <div class="h-36 md:h-40 relative image-fit cursor-pointer zoom-in mx-auto">
                                        <img class="rounded-md photo-select-template" alt="image" src="{{ asset('admin/images/profile-17.jpg') }}">
                                    </div>
                                    <div class="mx-auto cursor-pointer relative mt-5">
                                        <button type="button" class="btn btn-primary w-full">Select Image</button>
                                        {{ Form::file('image', ['class' => 'w-full h-full top-0 left-0 absolute opacity-0 photo-select']) }}
                                    </div>
                                </div>
                            </div>
                            <div class="col-span-12 lg:col-span-9">
                                {{ Form::textGroup('web', null, 'Web page', ['placeholder' => 'test.example.com']) }}
                            </div>
                            <div class="col-span-12 lg:col-span-9">
                                {{ Form::textGroup('facebook', null, 'Facebook page', ['placeholder' => 'facebook.com/example']) }}
                            </div>
                            <div class="col-span-12 lg:col-span-9">
                                {{ Form::textGroup('instagram', null, 'Instagram page', ['placeholder' => 'instagram.com/example.com']) }}
                            </div>
                            <div class="col-span-12 lg:col-span-9">
                                {{ Form::textGroup('google_disk', null, 'Google disk direcotry', ['placeholder' => 'disk.google.com/u1/example']) }}
                            </div>
						</div>
					</div>
                    <div id="page_data" class="tab-pane" role="tabpanel" aria-labelledby="page_data-tab">
                        <div class="grid grid-cols-12 gap-2 mt-3">
                            <div class="col-span-12">
                                <label for="site_content" class="form-label">Site content</label>
                                <textarea id="site_content" name="site_content" class="editor"> {{ old('site_content', '<p>Site content.</p>')  }} </textarea>
                            </div>
                        </div>
                    </div>
                    <div id="seo" class="tab-pane" role="tabpanel" aria-labelledby="seo-tab">
                        <div class="grid grid-cols-12 gap-2 mt-3">
                            <div class="col-span-12">
                                {{ Form::textGroup('title', null, 'Title') }}
                            </div>
                            <div class="col-span-12">
                                {{ Form::textGroup('meta_description', null, 'Meta description') }}
                            </div>
                            <div class="col-span-12">
                                {{ Form::textGroup('meta_keywords', null, 'Meta keywords') }}
                            </div>
                            <div class="col-span-12">
                                {{ Form::textGroup('og_title', null, 'OG Title') }}
                            </div>
                            <div class="col-span-12">
                                {{ Form::textGroup('og_site_name', null, 'OG Site name') }}
                            </div>
                            <div class="col-span-12">
                                {{ Form::textGroup('og_description', null, 'OG Description') }}
                            </div>
                            <div class="w-full md:w-52 mx-auto xl:mr-0 flex-shrink-0">
                                <label for="og_image" class="form-label">OG Image</label>
                                <div class="border-2 border-dashed shadow-sm border-dark-5 p-5 photo-select-template-wrapper">
                                    <div class="h-20 md:h-24 relative image-fit cursor-pointer zoom-in mx-auto">
                                        <img class="rounded-md photo-select-template" alt="og_image" src="{{ asset('admin/images/profile-17.jpg') }}">
                                    </div>
                                    <div class="mx-auto cursor-pointer relative mt-5">
                                        <button type="button" class="btn btn-primary w-full">Select Photo</button>
                                        {{ Form::file('og_image', ['class' => 'w-full h-full top-0 left-0 absolute opacity-0 photo-select']) }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
				</div>
			</div>
		</div>
		<!-- END: Post Content -->
		<!-- BEGIN: Post Info -->
		<div class="col-span-12 lg:col-span-4">
			<div class="intro-y box p-5">
				<h2 class="font-medium text-base mb-4">Meta data</h2>
                <div class="flex flex-row justify-start gap-x-10 mb-5">
                    <div class="flex flex-col items-start mt-3">
                        {{ Form::toggleGroup('public', 1, null, 'Published on website', ['class' => 'form-check-switch invoice-data-toggle']) }}
                    </div>
                    <div class="flex flex-col items-start mt-3">
                        {{ Form::toggleGroup('public_author', 1, null, 'Show Author Name', ['class' => 'form-check-switch invoice-data-toggle']) }}
                    </div>
                </div>
				<div>
					<label class="form-label">Customer</label>
					<div class="dropdown client-dropdown">
						<div class="dropdown-toggle btn w-full btn-outline-secondary dark:bg-dark-2 dark:border-dark-2 flex items-center justify-start" role="button" aria-expanded="false">
							<div class="w-6 h-6 image-fit mr-3">
								<img class="rounded selected-image" alt="client" src="{{ ($prefilled['customer']) ? route('admin.customer.avatar', $prefilled['customer']) : asset('admin/images/profile-17.jpg') }}">
							</div>
							<div class="truncate selected-label">{{ ($prefilled['customer']) ? $prefilled['customer']->name . ' ' . $prefilled['customer']->surname : "Select customer..." }}</div>
							<i class="w-4 h-4 ml-auto" data-feather="chevron-down"></i>
                            <input class="selected-value" type="hidden" name="customer" value="{{ ($prefilled['customer']) ? $prefilled['customer']->id : null }}">
						</div>
						<div class="dropdown-menu w-full" data-target=".client-dropdown">
							<div class="dropdown-menu__content box dark:bg-dark-1 p-2">
								@foreach ($customers as $customer)
									<a href="javascript:;" data-id="{{ $customer->id }}" class="image-option dropdown-item flex items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md">
										<div class="w-6 h-6 absolute image-fit mr-3">
											<img class="rounded image-dropdown-image" alt="{{ $customer->name }}" src="{{ route('admin.customer.avatar', $customer) }}">
										</div>
										<div class="ml-8 pl-1 image-dropdown-name">{{ $customer->name }} {{ $customer->surname }}</div>
									</a>
								@endforeach
							</div>
						</div>
					</div>
				</div>
				<div class="mt-3">
					<label for="departments" class="form-label">Department</label>
                    {{ Form::select('departments[]', $departments, null, ['class' => 'tail-select w-full', 'id' => 'departments', 'multiple']) }}
				</div>
				<div class="mt-3">
					<label for="assignees" class="form-label">Assignees</label>
                    {{ Form::select('assignees[]', $users, null, ['class' => 'tail-select w-full', 'id' => 'assignees', 'multiple']) }}
				</div>
                <div class="w-full sm:w-auto flex pt-4 sm:mt-0">
                    <button type="submit" class="btn btn-primary shadow-md flex items-center">Save project</button>
                </div>
			</div>
		</div>
		<!-- END: Post Info -->
	</form>
    @include('admin.components.messages')
@endsection

@extends('/admin/layout/' . $layout)

@section('subhead')
	<title>Projects</title>
@endsection

@section('breadcrumb')
    <a href="">Anstudio</a>
    <i data-feather="chevron-right" class="breadcrumb__icon"></i>
    <a href="" class="breadcrumb--active">Projects</a>
@endsection

@section('subcontent')
	<h2 class="intro-y text-lg font-medium mt-10">All Projects</h2>
	<div class="grid grid-cols-12 gap-6 mt-5">
		<div class="intro-y col-span-12 flex flex-wrap sm:flex-nowrap items-center mt-2">
			<a href="{{ route('admin.project.create') }}" class="btn btn-primary shadow-md mr-2">Add New Project</a>
			<div class="dropdown">
				<button class="dropdown-toggle btn px-2 box text-gray-700 dark:text-gray-300" aria-expanded="false">
					<span class="w-5 h-5 flex items-center justify-center">
						<i class="w-4 h-4" data-feather="plus"></i>
					</span>
				</button>
				<div class="dropdown-menu w-40">
					<div class="dropdown-menu__content box dark:bg-dark-1 p-2">
						<a href="" class="flex items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md">
							<i data-feather="users" class="w-4 h-4 mr-2"></i> Add Group
						</a>
						<a href="" class="flex items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md">
							<i data-feather="message-circle" class="w-4 h-4 mr-2"></i> Send Message
						</a>
					</div>
				</div>
			</div>
            <div class="hidden md:block mx-auto text-gray-600">Showing {{ $projects->firstItem() }} to {{ $projects->lastItem() }} of {{ $projects->total() }} entries</div>
			<div class="w-full sm:w-auto mt-3 sm:mt-0 sm:ml-auto md:ml-0">
				<div class="w-56 relative text-gray-700 dark:text-gray-300">
					<input type="text" class="form-control w-56 box pr-10 placeholder-theme-13" placeholder="Search...">
					<i class="w-4 h-4 absolute my-auto inset-y-0 mr-3 right-0" data-feather="search"></i>
				</div>
			</div>
		</div>
		<!-- BEGIN: Users Layout -->
		@foreach ($projects as $project)
			<div class="intro-y col-span-12 md:col-span-6">
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
		<!-- END: Users Layout -->
		<!-- BEGIN: Pagination -->
        <div class="intro-y col-span-12 flex flex-wrap sm:flex-row sm:flex-nowrap items-center">
            <ul class="pagination">
                <li>
                    <a class="pagination__link" href="">
                        <i class="w-4 h-4" data-feather="chevrons-left"></i>
                    </a>
                </li>
                <li>
                    <a class="pagination__link" href="">
                        <i class="w-4 h-4" data-feather="chevron-left"></i>
                    </a>
                </li>
                @foreach($projects->getUrlRange(1, $projects->lastPage()) as $key => $url)
                    @if($key <= 2 || $key > $projects->lastPage() - 2 || abs($key - $projects->currentPage()) <= 1)
                        <li>
                            <a class="pagination__link @if($projects->currentPage() === $key) {{ 'pagination__link--active' }} @endif" href="{{ $url }}">{{ $key }}</a>
                        </li>
                    @elseif($key+1 <= 2 || $key+1 > $projects->lastPage() - 2 || abs(($key+1) - $projects->currentPage()) <= 1)
                        <li>
                            <a class="pagination__link" href="">...</a>
                        </li>
                    @endif
                @endforeach
                <li>
                    <a class="pagination__link" href="">
                        <i class="w-4 h-4" data-feather="chevron-right"></i>
                    </a>
                </li>
                <li>
                    <a class="pagination__link" href="">
                        <i class="w-4 h-4" data-feather="chevrons-right"></i>
                    </a>
                </li>
            </ul>
            {{ Form::open(['url' => url()->full(), 'method' => 'GET']) }}
                {{ Form::select('per_page', ['9' => 9, '18' => 18, '27' => 27], $projects->perPage(), ['class' => 'w-20 form-select box mt-3 sm:mt-0']) }}
            {{ Form::close() }}
        </div>
		<!-- END: Pagination -->
	</div>

	@include('admin.components.messages')
@endsection

@extends('/admin/layout/' . $layout)

@section('subhead')
    <title>Companies</title>
@endsection

@section('breadcrumb')
    <a href="">Anstudio</a>
    <i data-feather="chevron-right" class="breadcrumb__icon"></i>
    <a href="" class="breadcrumb--active">Companies</a>
@endsection

@section('subcontent')
    <h2 class="intro-y text-lg font-medium mt-10">All Companies</h2>
    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="intro-y col-span-12 flex flex-wrap sm:flex-nowrap items-center mt-2">
            <a href="{{ route('admin.company.create') }}" class="btn btn-primary shadow-md mr-2">Add New Company</a>
            <div class="hidden md:block mx-auto text-gray-600">Showing {{ $companies->firstItem() }} to {{ $companies->lastItem() }} of {{ $companies->total() }} entries</div>
            <div class="w-full sm:w-auto mt-3 sm:mt-0 sm:ml-auto md:ml-0">
                <div class="w-56 relative text-gray-700 dark:text-gray-300">
                    <input type="text" class="form-control w-56 box pr-10 placeholder-theme-13" placeholder="Search...">
                    <i class="w-4 h-4 absolute my-auto inset-y-0 mr-3 right-0" data-feather="search"></i>
                </div>
            </div>
        </div>
        <!-- BEGIN: Users Layout -->
        @foreach ($companies as $company)
            <div class="intro-y col-span-12 md:col-span-6">
                <a href="{{ route('admin.company.edit', $company) }}">
                    <div class="box">
                        <div class="flex flex-col lg:flex-row items-center p-5">
                            <div class="w-24 h-24 lg:w-12 lg:h-12 image-fit lg:mr-1">
                                <img alt="Rubick Tailwind HTML Admin Template" class="rounded-full" src="{{ route('admin.company.avatar', $company) }}">
                            </div>
                            <div class="lg:ml-2 lg:mr-auto text-center lg:text-left mt-3 lg:mt-0">
                                <a href="{{ route('admin.company.edit', $company) }}" class="font-medium">{{ $company->name }}</a>
                            </div>
                            <div class="flex mt-4 lg:mt-0">
                                <a href="{{ route('admin.company.edit', $company) }}" class="btn btn-primary py-1 px-2">Edit</a>
                            </div>
                        </div>
                    </div>
                </a>
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
                @foreach($companies->getUrlRange(1, $companies->lastPage()) as $key => $url)
                    @if($key <= 2 || $key > $companies->lastPage() - 2 || abs($key - $companies->currentPage()) <= 1)
                        <li>
                            <a class="pagination__link @if($companies->currentPage() === $key) {{ 'pagination__link--active' }} @endif" href="{{ $url }}">{{ $key }}</a>
                        </li>
                    @elseif($key+1 <= 2 || $key+1 > $companies->lastPage() - 2 || abs(($key+1) - $companies->currentPage()) <= 1)
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
            {{ Form::select('per_page', ['9' => 9, '18' => 18, '27' => 27], $companies->perPage(), ['class' => 'w-20 form-select box mt-3 sm:mt-0']) }}
            {{ Form::close() }}
        </div>
        <!-- END: Pagination -->
    </div>

    @include('admin.components.messages')
@endsection

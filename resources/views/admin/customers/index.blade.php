@extends('/admin/layout/' . $layout)

@section('subhead')
	<title>Customers</title>
@endsection

@section('breadcrumb')
    <a href="">Anstudio</a>
    <i data-feather="chevron-right" class="breadcrumb__icon"></i>
    <a href="" class="breadcrumb--active">Customers</a>
@endsection

@section('subcontent')
	<h2 class="intro-y text-lg font-medium mt-10">All customers</h2>
	<div class="grid grid-cols-12 gap-6 mt-5">
		<div class="intro-y col-span-12 flex flex-wrap sm:flex-nowrap items-center mt-2">
			<a href="{{ route('admin.customer.create') }}" class="btn btn-primary shadow-md mr-2">Add New Customer</a>
			<div class="hidden md:block mx-auto text-gray-600">Showing {{ $customers->firstItem() }} to {{ $customers->lastItem() }} of {{ $customers->total() }} entries</div>
			<div class="w-full sm:w-auto mt-3 sm:mt-0 sm:ml-auto md:ml-0">
				<div class="w-56 relative text-gray-300">
					<input type="text" class="form-control w-56 box pr-10 placeholder-theme-13" placeholder="Search...">
					<i class="w-4 h-4 absolute my-auto inset-y-0 mr-3 right-0" data-feather="search"></i>
				</div>
			</div>
		</div>
		<!-- BEGIN: Users Layout -->
		@foreach ($customers as $customer)
			<div class="intro-y col-span-12 md:col-span-6 lg:col-span-4">
				<div class="box">
					<div class="flex items-start px-5 pt-5">
						<div class="w-full flex flex-col lg:flex-row items-center">
							<div class="w-16 h-16 image-fit">
								<img class="rounded-full" src="{{ route('admin.customer.avatar', $customer) }}">
							</div>
							<div class="lg:ml-4 text-center lg:text-left mt-3 lg:mt-0">
								<a href="" class="font-medium">{{ $customer->name }} {{ $customer->surname }}</a>
								<div class="text-gray-600 text-xs mt-0.5">{{ $customer->position }}</div>
							</div>
						</div>
						<div class="absolute right-0 top-0 mr-5 mt-3 dropdown">
							<a class="dropdown-toggle w-5 h-5 block" href="javascript:;" aria-expanded="false">
								<i data-feather="more-horizontal" class="w-5 h-5 text-gray-300"></i>
							</a>
							<div class="dropdown-menu w-40">
								<div class="dropdown-menu__content box bg-dark-1 p-2">
									<a href="{{ route('admin.customer.edit', $customer) }}" class="flex items-center block p-2 transition duration-300 ease-in-out bg-primary hover:bg-dark-2 rounded-md">
										<i data-feather="edit-2" class="w-4 h-4 mr-2"></i> Edit
									</a>
								</div>
							</div>
						</div>
					</div>
					<div class="text-center lg:text-left p-5">
						<div class="flex items-center justify-center lg:justify-start text-gray-600 mt-5">
							<i data-feather="mail" class="w-3 h-3 mr-2"></i> {{ $customer->email }}
						</div>
						<div class="flex items-center justify-center lg:justify-start text-gray-600 mt-1">
							<i data-feather="phone" class="w-3 h-3 mr-2"></i> {{ $customer->phone }}
						</div>
					</div>
					<div class="text-center lg:text-right p-5 border-t border-dark-5">
						<a href="mailto:{{ $customer->email }}" class="btn btn-primary py-1 px-2 mr-2">Message</a>
						<a href="{{ route('admin.customer.show', $customer) }}" class="btn btn-outline-secondary py-1 px-2">Profile</a>
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
                @foreach($customers->getUrlRange(1, $customers->lastPage()) as $key => $url)
                    @if($key <= 2 || $key > $customers->lastPage() - 2 || abs($key - $customers->currentPage()) <= 1)
                        <li>
                            <a class="pagination__link @if($customers->currentPage() === $key) {{ 'pagination__link--active' }} @endif" href="{{ $url }}">{{ $key }}</a>
                        </li>
                    @elseif($key+1 <= 2 || $key+1 > $customers->lastPage() - 2 || abs(($key+1) - $customers->currentPage()) <= 1)
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
                {{ Form::select('per_page', ['9' => 9, '18' => 18, '27' => 27], $customers->perPage(), ['class' => 'w-20 form-select box mt-3 sm:mt-0']) }}
            {{ Form::close() }}
		</div>
		<!-- END: Pagination -->
	</div>

    @include('admin.components.messages')
@endsection

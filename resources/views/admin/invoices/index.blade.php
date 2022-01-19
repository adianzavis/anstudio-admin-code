@extends('/admin/layout/' . $layout)

@section('subhead')
	<title>CRUD Data List - Rubick - Tailwind HTML Admin Template</title>
@endsection

@section('subcontent')
	<h2 class="text-lg font-medium mt-10">All invoices</h2>
	<div class="grid grid-cols-12 gap-6 mt-5">
        <div class="col-span-12 flex flex-wrap sm:flex-nowrap items-center mt-3">
            <div class="dropdown">
                <button class="dropdown-toggle btn btn-primary shadow-md" aria-expanded="false">
					<span class="flex items-center justify-center">
						<i class="w-4 h-4 mr-1" data-feather="plus"></i> Add New Invoice
					</span>
                </button>
                <div class="dropdown-menu w-40">
                    <div class="dropdown-menu__content box dark:bg-dark-1 p-2">
                        <a href="{{ route('admin.invoice.incoming.create') }}" class="flex items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md">
                            <i data-feather="plus" class="w-4 h-4 mr-2"></i> Income
                        </a>
                        <a href="" class="flex items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md">
                            <i data-feather="minus" class="w-4 h-4 mr-2"></i> Outcome
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-span-12 grid grid-cols-12 gap-2 mt-3">
                <div class="col-span-12 md:col-span-6 lg:col-span-3">
                    <label for="update-profile-form-2" class="form-label">Outcome/Income</label>
                    <select id="update-profile-form-2" class="tail-select w-full" multiple>
                        <option value="1">Income</option>
                        <option value="2">Outcome</option>
                    </select>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-3">
                    <label for="update-profile-form-2" class="form-label">Department</label>
                    <select id="update-profile-form-2" class="tail-select w-full" multiple>
                        <option value="1">Programming</option>
                        <option value="2">Design</option>
                        <option value="3">Marketing</option>
                        <option value="4">Photography</option>
                        <option value="5">Management</option>
                    </select>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-3">
                    <label for="update-profile-form-2" class="form-label">User</label>
                    <select id="update-profile-form-2" class="tail-select w-full" multiple>
                        <option>Adrian Zaviš</option>
                        <option>Dominik Sušila</option>
                        <option>Nikolas Kolínek</option>
                    </select>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-3 flex gap-2">
                    <div>
                        <label for="update-profile-form-2" class="form-label">Search</label>
                        <div class="w-full relative text-gray-700 dark:text-gray-300">
                            <input type="text" class="form-control w-full box pr-10 placeholder-theme-13" placeholder="Search...">
                            <i class="w-4 h-4 absolute my-auto inset-y-0 mr-3 right-0" data-feather="search"></i>
                        </div>
                    </div>
                    <div class="flex items-end">
                        <button class="btn btn-primary shadow-md mr-2 mb-0.25">Search</button>
                    </div>
                </div>
            </div>
        </div>
		<!-- BEGIN: Data List -->
		<div class="col-span-12 overflow-auto lg:overflow-visible mt-3">
			<table class="table table-report -mt-2">
				<thead>
					<tr>
						<th class="whitespace-nowrap">ASSIGNEES</th>
						<th class="whitespace-nowrap">INVOICE SUBJECT</th>
						<th class="text-center whitespace-nowrap">PRICE</th>
						<th class="text-center whitespace-nowrap">STATUS</th>
						<th class="text-center whitespace-nowrap">ACTIONS</th>
					</tr>
				</thead>
				<tbody>
					@foreach (array_slice($fakers, 0, 9) as $faker)
						<tr>
							<td class="w-40">
								<div class="flex">
									<div class="w-10 h-10 image-fit zoom-in">
										<img alt="Rubick Tailwind HTML Admin Template" class="tooltip rounded-full" src="{{ asset('dist/images/filip.jpg') }}" title="Filip Čižmár">
									</div>
									<div class="w-10 h-10 image-fit zoom-in -ml-5">
										<img alt="Rubick Tailwind HTML Admin Template" class="tooltip rounded-full" src="{{ asset('dist/images/profile-photo.jpg') }}" title="Filip Čižmár">
									</div>
									<div class="w-10 h-10 image-fit zoom-in -ml-5">
										<img alt="Rubick Tailwind HTML Admin Template" class="tooltip rounded-full" src="{{ asset('dist/images/filip.jpg') }}" title="Filip Čižmár">
									</div>
								</div>
							</td>
							<td>
								<a href="" class="font-medium whitespace-nowrap">{{ $faker['products'][0]['name'] }}</a>
								<div class="text-gray-600 text-xs whitespace-nowrap mt-0.5">{{ $faker['products'][0]['category'] }}</div>
							</td>
							<td class="text-center">{{ $faker['stocks'][0] }}.00€</td>
							<td class="w-40">
								<div class="flex items-center justify-center {{ $faker['true_false'][0] ? 'text-theme-9' : 'text-theme-6' }}">
									<i data-feather="check-square" class="w-4 h-4 mr-2"></i> {{ $faker['true_false'][0] ? 'Payed' : 'Waiting' }}
								</div>
							</td>
							<td class="table-report__action w-56">
								<div class="flex justify-center items-center">
									<a class="flex items-center mr-3" href="javascript:;">
										<i data-feather="check-square" class="w-4 h-4 mr-1"></i> Edit
									</a>
									<a class="flex items-center text-theme-6" href="javascript:;" data-toggle="modal" data-target="#delete-confirmation-modal">
										<i data-feather="trash-2" class="w-4 h-4 mr-1"></i> Delete
									</a>
								</div>
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
		<!-- END: Data List -->
		<!-- BEGIN: Pagination -->
		<div class="col-span-12 flex flex-wrap sm:flex-row sm:flex-nowrap items-center">
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
				<li>
					<a class="pagination__link" href="">...</a>
				</li>
				<li>
					<a class="pagination__link" href="">1</a>
				</li>
				<li>
					<a class="pagination__link pagination__link--active" href="">2</a>
				</li>
				<li>
					<a class="pagination__link" href="">3</a>
				</li>
				<li>
					<a class="pagination__link" href="">...</a>
				</li>
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
			<select class="w-20 form-select box mt-3 sm:mt-0">
				<option>10</option>
				<option>25</option>
				<option>35</option>
				<option>50</option>
			</select>
		</div>
		<!-- END: Pagination -->
	</div>
	<!-- BEGIN: Delete Confirmation Modal -->
	<div id="delete-confirmation-modal" class="modal" tabindex="-1" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-body p-0">
					<div class="p-5 text-center">
						<i data-feather="x-circle" class="w-16 h-16 text-theme-6 mx-auto mt-3"></i>
						<div class="text-3xl mt-5">Are you sure?</div>
						<div class="text-gray-600 mt-2">Do you really want to delete these records? <br>This process cannot be undone.</div>
					</div>
					<div class="px-5 pb-8 text-center">
						<button type="button" data-dismiss="modal" class="btn btn-outline-secondary w-24 mr-1">Cancel</button>
						<button type="button" class="btn btn-danger w-24">Delete</button>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- END: Delete Confirmation Modal -->
@endsection

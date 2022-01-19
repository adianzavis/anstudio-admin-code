@extends('/admin/layout/' . $layout)

@section('subhead')
	<title>New invoice</title>
@endsection

@section('subcontent')
	<div class="intro-y flex items-center mt-8">
		<h2 class="text-lg font-medium mr-auto">New invoice</h2>
	</div>
	<div class="grid grid-cols-12 gap-6 mt-5">
		<div class="intro-y col-span-12 lg:col-span-6">
			<!-- BEGIN: Form Layout -->
			<div class="intro-y box p-5">
				<div>
					<label for="crud-form-1" class="form-label">Invoice number</label>
					<input id="crud-form-1" type="text" class="form-control w-full" placeholder="2021003">
				</div>
				<div class="mt-3">
					<label for="crud-form-2" class="form-label">Category</label>
					<select data-placeholder="Select department of invoice" class="tail-select w-full" id="crud-form-2" multiple>
						<option value="1">Programming</option>
						<option value="2">Design</option>
						<option value="3">Marketing</option>
						<option value="4">Photography</option>
						<option value="4">Other</option>
					</select>
				</div>
				<div class="mt-3">
					<div class="sm:grid grid-cols-2 gap-2">
						<div>
							<label for="input-wizard-6" class="form-label">Seller company</label>
							<select id="input-wizard-6" class="tail-select w-full">
								<option>anstudio s.r.o.</option>
								<option>tovareň na sny s.r.o.</option>
							</select>
						</div>
						<div>
							<label for="input-wizard-6" class="form-label">Customer company</label>
							<select id="input-wizard-6" class="tail-select w-full">
								<option>Simon s.r.o.</option>
								<option>Upvision s.r.o.</option>
								<option>Icewarp s.r.o.</option>
							</select>
						</div>
					</div>
				</div>
				<div class="mt-3">
					<label class="form-label">Invoice items</label>
					<table class="w-full">
						<!-- Invoice item component -->
						<tr>
							<td>
								<div class="sm:grid grid-cols-12 gap-2">
									<div class="input-group col-span-12">
										<div id="input-group-3" class="input-group-text">Name</div>
										<input type="text" class="form-control" placeholder="Item" aria-describedby="input-group-3">
									</div>
									<div class="input-group mt-2 col-span-6 sm:mt-0">
										<div id="input-group-4" class="input-group-text">Price</div>
										<input type="text" class="form-control" placeholder="1000" aria-describedby="input-group-4">
									</div>
									<div class="input-group col-span-6">
										<select id="input-wizard-6" class="tail-select w-full">
											<option>Adrian Zaviš</option>
											<option>Dominik Sušila</option>
											<option>Nikolas Kolínek</option>
										</select>
									</div>
								</div>
							</td>
						</tr>
						<!-- End of item component -->
					</table>
				</div>
				<div class="mt-3">
					<a href="" class="text-theme-1 block font-normal inline-block">Add item</a>
				</div>
				<div class="mt-3">
					<label>Include VAT</label>
					<div class="mt-2">
						<input type="checkbox" class="form-check-switch">
					</div>
				</div>
				<div class="mt-3">
					<label>Description</label>
					<div class="mt-2">
						<textarea class="w-full form-control" placeholder="Your description..."></textarea>
					</div>
				</div>
				<div class="text-right mt-5">
					<button type="button" class="btn btn-outline-secondary w-24 mr-1">Cancel</button>
					<button type="button" class="btn btn-primary w-24">Save</button>
				</div>
			</div>
			<!-- END: Form Layout -->
		</div>
	</div>
@endsection

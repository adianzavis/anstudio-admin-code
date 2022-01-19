<?php

namespace App\Customers;

use Illuminate\Http\Request;
use App\Customers\Requests\CustomerCreateRequest;
use App\Customers\Requests\CustomerUpdateRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Core\Controller;

class CustomerController extends Controller {
    public function index(Request $request) {
        return view('admin.customers.index', [
            'layout' => 'side-menu',
            'customers' => Customer::paginate($request->input('per_page', 9))->withQueryString(),
        ]);
    }

    public function create(Request $request) {
        return view('admin.customers.create', [
            'layout' => 'side-menu',
        ]);
    }

    public function store(CustomerCreateRequest $request) {
        $customerMediator = new CustomerMediator($request->all());
        $customer = $customerMediator->create();

        return redirect()->route('admin.customer.show', $customer)->with('success', 'The customer was created. Please treat him/her right');
    }

    public function show(Request $request, Customer $customer) {
        return view('admin.customers.show', [
            'layout' => 'side-menu',
            'customer' => $customer,
        ]);
    }

    public function edit(Request $request, Customer $customer) {
        return view('admin.customers.edit', [
            'layout' => 'side-menu',
            'customer' => $customer,
        ]);
    }

    public function update(CustomerUpdateRequest $request, Customer $customer) {
        $customerMediator = new CustomerMediator($request->all(), $customer);
        $customer = $customerMediator->update();

        return redirect()->route('admin.customer.show', $customer)->with('success', 'The customer "'.$customer->name.' '.$customer->surname.'" was updated.');
    }

    public function delete(Request $request, Customer $customer) {
        $customerMediator = new CustomerMediator($request->all(), $customer);
        $customerMediator->delete();

        return redirect()->route('admin.customer.index')->with('success', 'The customer "'.$customer->name.' '.$customer->surname.'" was deleted.');
    }

    public function avatar(Request $request, Customer $customer) {
        if (!Storage::disk('local')->exists($customer->avatar) || !Auth::user()) {
            abort(404);
        }

        return Storage::download($customer->avatar);
    }
}

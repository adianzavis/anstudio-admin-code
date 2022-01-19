<?php

namespace App\Customers;

use App\Core\Mediator;
use App\Customers\Customer;
use Illuminate\Support\Collection;
use App\Invoices\Details\InvoiceDetailsMediator;

class CustomerMediator extends Mediator {
    private ?Customer $customer;
    private Collection $data;

    public function __construct(array $data, Customer $customer = null) {
        $this->data = collect($data);
        $this->customer = $customer;
    }

    public function create() {
        $customer = new Customer();
        $customer->fill($this->data->all());

        if ($this->data->get('invoiceable'))
        $customer->invoiceDetails()->associate((new InvoiceDetailsMediator($this->data->all()))->create());

        if ($this->data->has('avatar'))
            $customer->avatar = $this->data->get('avatar')->store('avatars');

        $customer->save();
        return $customer;
    }

    public function update() {
        $customer = $this->customer;
        $customer->fill($this->data->all());

        if ($this->data->get('invoiceable')) {
            $invoiceDetailsMediator = new InvoiceDetailsMediator($this->data->all(), $customer->invoiceDetails);
            $newDetails = $invoiceDetailsMediator->createIfDifferent();

            if ($newDetails)
                $customer->invoiceDetails()->associate($newDetails);
        } else if($customer->invoiceDetails)
            $customer->invoiceDetails()->dissociate();

        if ($this->data->has('avatar'))
            $customer->avatar = $this->data->get('avatar')->store('avatars');

        $customer->save();
        return $customer;
    }

    public function delete() {
        $this->customer->delete();
    }
}

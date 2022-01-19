<?php

namespace App\Companies;

use App\Core\Mediator;
use Illuminate\Support\Collection;
use App\Invoices\Details\InvoiceDetailsMediator;

class CompanyMediator extends Mediator {
    private ?Company $company;
    private Collection $data;

    public function __construct(array $data, Company $company = null) {
        $this->data = collect($data);
        $this->company = $company;
    }

    public function create() {
        $company = new Company();
        $company->fill($this->data->all());

        if ($this->data->get('invoiceable'))
            $company->invoiceDetails()->associate((new InvoiceDetailsMediator($this->data->all()))->create());

        if ($this->data->has('avatar'))
            $company->avatar = $this->data->get('avatar')->store('avatars');

        $company->save();
        $company->assignees()->attach($this->data->get('assignees', []));

        return $company;
    }

    public function update() {
        $company = $this->company;
        $company->fill($this->data->all());

        if ($this->data->get('invoiceable')) {
            $invoiceDetailsMediator = new InvoiceDetailsMediator($this->data->all(), $company->invoiceDetails);
            $newDetails = $invoiceDetailsMediator->createIfDifferent();

            if ($newDetails)
                $company->invoiceDetails()->associate($newDetails);
        } else if($company->invoiceDetails)
            $company->invoiceDetails()->dissociate();

        if ($this->data->has('avatar'))
            $company->avatar = $this->data->get('avatar')->store('avatars');

        $company->save();
        $company->assignees()->sync($this->data->get('assignees', []));

        return $company;
    }

    public function delete() {
        $this->company->delete();
    }
}

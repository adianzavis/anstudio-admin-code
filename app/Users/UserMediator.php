<?php

namespace App\Users;

use App\Core\Mediator;
use App\Invoices\Details\InvoiceDetailsMediator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;

class UserMediator extends Mediator {
    private ?User $user;
    private Collection $data;

    public function __construct(array $data, User $user = null) {
        $this->data = collect($data);
        $this->user = $user;
    }

    public function create() {
        $user = new User();
        if ($this->data->get('invoiceable')) {
            $user->invoiceDetails()->associate((new InvoiceDetailsMediator($this->data->all()))->create());
        }

        $user->fill($this->data->all());
        $user->password = Hash::make('123456789');

        if ($this->data->has('avatar'))
            $user->avatar = $this->data->get('avatar')->store('avatars');

        $user->save();
        $user->departments()->attach($this->data->get('departments', []));

        $this->user = $user;
        return $user;
    }

    public function update() {
        $user = $this->user;

        $user->fill($this->data->all());

        if ($this->data->get('invoiceable')) {
            $invoiceDetailsMediator = new InvoiceDetailsMediator($this->data->all(), $user->invoiceDetails);
            $newDetails = $invoiceDetailsMediator->createIfDifferent();

            if ($newDetails)
                $user->invoiceDetails()->associate($newDetails);
        } else if($user->invoiceDetails)
            $user->invoiceDetails()->dissociate();

        if ($this->data->has('avatar'))
            $user->avatar = $this->data->get('avatar')->store('avatars');

        $user->save();

        $user->departments()->sync($this->data->get('departments', []));

        $this->user = $user;
        return $user;
    }
}

<?php

namespace App\Invoices\Incoming;

use Illuminate\Http\Request;
use App\Core\Controller;

class IncomingInvoiceController extends Controller {
    public function create(Request $request) {
        return view('admin.invoices.incoming.create', [
            'layout' => 'side-menu',
        ]);
    }
}

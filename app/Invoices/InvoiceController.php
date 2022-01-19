<?php

namespace App\Invoices;

use Illuminate\Http\Request;
use App\Core\Controller;

class InvoiceController extends Controller {
    public function index(Request $request) {
        return view('admin.invoices.index', [
            'layout' => 'side-menu',
        ]);
    }
}

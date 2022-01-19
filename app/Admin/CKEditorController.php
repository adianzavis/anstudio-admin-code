<?php

namespace App\Admin;

use App\Customers\Customer;
use Illuminate\Http\Request;
use App\Core\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CKEditorController extends Controller {
    public function upload(Request $request) {
        $path = $request->file('upload')->store('blog');

        return response()->json([
            'url' => route('admin.ckeditor.download', basename($path)),
        ]);
    }

    public function download(Request $request, string $filename) {
        $path = 'blog/'.$filename;
        if (!Storage::disk('local')->exists($path)) {
            abort(404);
        }

        return Storage::download($path);
    }
}

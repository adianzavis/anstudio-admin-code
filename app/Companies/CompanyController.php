<?php

namespace App\Companies;

use Illuminate\Http\Request;
use App\Core\Controller;
use App\Users\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Companies\Requests\CompanyCreateRequest;
use App\Companies\Requests\CompanyUpdateRequest;

class CompanyController extends Controller {
    public function index(Request $request) {
        return view('admin.companies.index', [
            'layout' => 'side-menu',
            'companies' => Company::paginate($request->input('per_page', 9))->withQueryString(),
        ]);
    }

    public function create(Request $request) {
        return view('admin.companies.create', [
            'layout' => 'side-menu',
            'users' => User::all()->pluck('full_name', 'id'),
        ]);
    }

    public function store(CompanyCreateRequest $request) {
        $companyMediator = new CompanyMediator($request->all());
        $company = $companyMediator->create();

        return redirect()->route('admin.company.index', $company)->with('success', 'The company was created.');
    }

    // TODO: show company data
    public function show(Request $request, Company $company) {
        return view('admin.companies.show', [
            'layout' => 'side-menu',
            'company' => $company,
        ]);
    }

    public function edit(Request $request, Company $company) {
        return view('admin.companies.edit', [
            'layout' => 'side-menu',
            'users' => User::all()->pluck('full_name', 'id'),
            'company' => $company,
        ]);
    }

    public function update(CompanyUpdateRequest $request, Company $company) {
        $companyMediator = new CompanyMediator($request->all(), $company);
        $company = $companyMediator->update();

        return redirect()->route('admin.company.edit', $company)->with('success', 'The company "'.$company->name.'" was updated.');
    }

    public function delete(Request $request, Company $company) {
        $companyMediator = new CompanyMediator($request->all(), $company);
        $companyMediator->delete();

        return redirect()->route('admin.company.index')->with('success', 'The company "'.$company->name.'" was deleted.');
    }

    public function avatar(Request $request, Company $company) {
        if (!Storage::disk('local')->exists($company->avatar) || !Auth::user()) {
            abort(404);
        }

        return Storage::download($company->avatar);
    }
}

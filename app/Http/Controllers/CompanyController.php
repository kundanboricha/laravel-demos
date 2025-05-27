<?php
namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function index(Request $request)
    {
        $query = Company::query();

        // ✅ Global search
        if ($search = $request->input('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            });
        }

        // ✅ Filter by company_type dropdown
        if ($type = $request->input('company_type')) {
            $query->where('company_type', $type);
        }

        // ✅ Sorting
        $sortField = $request->input('sort_by', 'name');
        $sortOrder = $request->input('sort_order', 'asc');

        if (in_array($sortField, ['name', 'email', 'company_type']) && in_array($sortOrder, ['asc', 'desc'])) {
            $query->orderBy($sortField, $sortOrder);
        }

        $companies = $query->paginate(10)->appends($request->query());

        return view('companies.index', compact('companies'));
    }

    public function create()
    {
        return view('companies.create');
    }

    public function store(Request $request)
    {
        // ✅ Inline validation
        $data = $request->validate([
            'name'         => 'required|string|max:255',
            'email'        => 'required|email|unique:companies,email',
            'company_type' => 'required|in:A Type,B Type,C Type',
            'gender'       => 'required|in:Male,Female,Other',
            'interests'    => 'nullable|array',
            'image'        => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // ✅ Handle file upload
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('companies', 'public');
        }

        // ✅ Create the company
        Company::create($data);

        return redirect()->route('companies.index')->with('success', 'Company created!');
    }

    public function edit(Company $company)
    {
        return view('companies.edit', compact('company'));
    }

    public function update(Request $request, Company $company)
    {
        $validated = $request->validate([
            'name'         => 'required|string|max:255',
            'email'        => 'required|email|unique:companies,email,' . $company->id,
            'company_type' => 'required|in:A Type,B Type,C Type',
            'gender'       => 'required|in:Male,Female,Other',
            'interests'    => 'nullable|array',
        ]);

        $company->update($validated);

        return redirect()->route('companies.index')->with('success', 'Company updated!');
    }

    public function destroy(Company $company)
    {
        $company->delete();
        return redirect()->route('companies.index')->with('success', 'Company deleted!');
    }

}

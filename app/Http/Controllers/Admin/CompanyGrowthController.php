<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CompanyGrowth;
use Illuminate\Http\Request;

class CompanyGrowthController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $growths = CompanyGrowth::orderBy('year', 'asc')->get();
        return view('admin.company_growth.index', compact('growths'));
    }

    public function create()
    {
        return view('admin.company_growth.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'year' => 'required|integer|unique:company_growths,year',
            'revenue' => 'required|numeric|min:0',
        ]);

        CompanyGrowth::create($request->only(['year', 'revenue']));
        return redirect()->route('admin.company_growth.index')->with('success', 'Growth data added.');
    }

    public function edit(CompanyGrowth $companyGrowth, $id)
    {
        $companyGrowth = CompanyGrowth::findOrFail($id);
        return view('admin.company_growth.edit', compact('companyGrowth', 'id'));
    }

    public function update(Request $request, CompanyGrowth $companyGrowth)
    {
        $request->validate([
            'year' => 'required|integer|unique:company_growths,year,' . $companyGrowth->id,
            'revenue' => 'required|numeric|min:0',
        ]);

        $companyGrowth->update($request->only(['year', 'revenue']));
        return redirect()->route('admin.company_growth.index')->with('success', 'Growth data updated.');
    }

    public function destroy(CompanyGrowth $companyGrowth)
    {
        $companyGrowth->delete();
        return back()->with('success', 'Growth data deleted.');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Branches;

class BranchesController extends Controller
{
    public function index()
    {
        $branches = Branches::all();
        return view('branches.index', compact('branches'));
    }

    public function create()
    {
        return view('branches.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'government' => 'required|string|max:255',
        ]);

        $branch = new Branches();
        $branch->name = $validatedData['name'];
        $branch->government = $validatedData['government'];
        $branch->organization_id = 1; // Manually added
        $branch->save();

        return redirect()->route('branches.index')->with('success', 'Branch created successfully');
    }



    public function edit($id)
    {
        $branch = Branches::findOrFail($id);
        return view('branches.edit', compact('branch'));
    }
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'government' => 'required|string|max:255',
        ]);

        $branch = Branches::findOrFail($id);
        $branch->name = $validatedData['name'];
        $branch->government = $validatedData['government'];
        $branch->save();

        return redirect()->route('branches.index')->with('success', 'Branch updated successfully');
    }

    public function destroy($id)
    {
        $branch = Branches::findOrFail($id);
        $branch->delete();
        return redirect()->route('branches.index')->with('success', 'Branch deleted successfully');
    }
}

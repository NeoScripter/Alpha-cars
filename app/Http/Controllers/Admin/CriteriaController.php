<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Criteria;
use Illuminate\Http\Request;

class CriteriaController extends Controller
{
    public function edit(Criteria $criteria)
    {
        $criteria = Criteria::first();

        return view('admin.criteria', compact('criteria'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'carTypes' => 'nullable|array',
            'carTypes.*' => 'required|string|max:255',
            'carSubtypes' => 'nullable|array',
            'carSubtypes.*' => 'required|string|max:255',
            'carMakes' => 'nullable|array',
            'carMakes.*' => 'required|string|max:255',
            'workTerms' => 'nullable|array',
            'workTerms.*' => 'required|string|max:255',
            'rating' => 'nullable|array',
            'rating.*' => 'required|string|max:255',
        ]);

        $criteria = Criteria::first();


        $criteria->update($validated);

        return redirect()->route('admin.criteria.edit')->with([
            'status' => 'success',
            'message' => 'Информация обновлена!',
        ]);
    }
}

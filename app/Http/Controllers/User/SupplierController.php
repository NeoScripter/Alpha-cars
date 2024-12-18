<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    public function index()
    {

        $options = Supplier::preloadFilters();

        $filters = request()->only(['carType', 'carSubtype', 'carMake', 'name', 'rating', 'workTerms']);

        $perPage = request('perPage', session('perPage', 20));

        // Store the perPage value in the session
        session(['perPage' => $perPage]);

        $suppliers = Supplier::query()
            ->search($filters)
            ->with('managers')
            ->paginate($perPage);

        return view('user.index', compact('suppliers', 'options', 'perPage'));
    }

    public function show(Supplier $supplier) {

        $supplier->load([
            'managers.managerReviews.user',
            'supplierReviews.user'
        ]);
        return view('user.supplier', compact('supplier'));
    }
}

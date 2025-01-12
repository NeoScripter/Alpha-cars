<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\ManagerReview;
use App\Models\Supplier;
use App\Models\SupplierReview;
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

        $userId = auth()->id();

        $managerIds = ManagerReview::select('manager_id')->where('user_id', $userId)
            ->pluck('manager_id')
            ->mapWithKeys(function ($id) {
                return [$id => true];
            })
            ->all();

        return view('user.index', compact('suppliers', 'options', 'perPage', 'managerIds'));
    }

    public function show(Supplier $supplier)
    {

        $supplier->load([
            'managers.managerReviews.user',
            'supplierReviews.user'
        ]);

        $userId = auth()->id();

        $existingReview = SupplierReview::select('id')->where('user_id', $userId)
            ->where('supplier_id', $supplier->id)
            ->first();

        $canComment = $existingReview ? false : true;

        return view('user.supplier', compact('supplier', 'canComment'));
    }
}

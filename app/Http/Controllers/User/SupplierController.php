<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    public function index()
    {
        /* $suppliers = Supplier::select([
            'id',
            'name',
            'carType',
            'carSubtype',
            'carMake',
            'rating',
            'workTerms',
            'supervisor',
        ])->with('managers')->paginate(10); */

        $options = Supplier::preloadFilters();

        $filters = request()->only(['carType', 'carSubtype', 'carMake', 'name', 'rating', 'workTerms']);

        $suppliers = Supplier::query()
            ->search($filters)
            ->with('managers')
            ->paginate(10);

        return view('user.index', compact('suppliers', 'options'));
    }
}

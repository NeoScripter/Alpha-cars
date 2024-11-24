<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    public function index()
    {
        $suppliers = Supplier::select([
            'id',
            'name',
            'carType',
            'carSubtype',
            'carMake',
            'rating',
            'workTerms',
            'supervisor',
        ])->get();

        return view('user.index', compact('suppliers'));
    }
}

<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Supplier;
use App\Models\SupplierReview;
use Illuminate\Http\Request;

class SupplierReviewController extends Controller
{
    public function store(Request $request)
    {

        $validated = $request->validate([
            'stars' => 'required|numeric|min:1|max:5',
            'content' => 'required|string|max:255',
            'supplier_id' => 'required|exists:suppliers,id',
        ]);

        $userId = auth()->id();

        $validated['user_id'] = $userId;
        $supplier = Supplier::find($validated['supplier_id']);

        $existingReview = SupplierReview::select('id')->where('user_id', $userId)
            ->where('supplier_id', $validated['supplier_id'])
            ->first();

        if ($existingReview) {
            return redirect()->back()->withErrors([
                'message' => 'Вы уже оставили отзыв для этого поставщика.',
            ]);
        }

        SupplierReview::create($validated);

        $supplierReviews = SupplierReview::select('stars')->where('supplier_id', $validated['supplier_id'])->pluck('stars');

        $averageRating = round($supplierReviews->average(), 1);

        $supplier->update(['stars' => $averageRating]);

        return redirect()->back()->with([
            'status' => 'success',
            'message' => 'Спасибо за оставленный отзыв!',
        ]);
    }
}

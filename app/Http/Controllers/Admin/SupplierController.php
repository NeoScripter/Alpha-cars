<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SupplierController extends Controller
{
    // Display a listing of suppliers
    public function index($search = null)
    {
        $suppliers = Supplier::latest();

        if ($search) {
            $suppliers->where(function ($query) use ($search) {
                $query->where('name', 'like', "%{$search}%");
            });
        }

        $suppliers = $suppliers->paginate(10);

        return view('admin.admin', compact('suppliers'));
    }

    // Delete a supplier
    public function destroy(Supplier $supplier)
    {
        if ($supplier->image) {
            Storage::disk('public')->delete($supplier->image);
        }
        $supplier->delete();

        return redirect()->route('admin')->with([
            'status' => 'success',
            'message' => 'Поставщик удален!',
        ]);
    }

    // Edit a supplier
    public function edit(Supplier $supplier)
    {
        return view('admin.supplier.edit', compact('supplier'));
    }

    // Store a new supplier
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'emails' => 'nullable|array',
            'phones' => 'nullable|array',
            'website' => 'nullable|url',
            'platform_address' => 'nullable|string|max:255',
            'unload_address' => 'nullable|string|max:255',
            'legal_entity' => 'nullable|string|max:255',
            'itn' => 'nullable|string|max:255',
            'rrc' => 'nullable|string|max:255',
            'rating' => 'nullable|string|max:255',
            'carType' => 'nullable|array',
            'carSubtype' => 'nullable|array',
            'carMake' => 'nullable|array',
            'workTerms' => 'nullable|string|max:255',
            'supervisor' => 'nullable|string|max:255',
            'dkp' => 'nullable|boolean',
            'image_spec' => 'nullable|boolean',
            'signees' => 'nullable|string|max:255',
            'warantees' => 'nullable|boolean',
            'payWithoutPTC' => 'nullable|boolean',
            'image' => 'nullable|image|max:1024',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('suppliers', 'public');
        }

        Supplier::create(array_merge($validated, [
            'image' => $imagePath,
            'emails' => json_encode($validated['emails'] ?? []),
            'phones' => json_encode($validated['phones'] ?? []),
            'carType' => json_encode($validated['carType'] ?? []),
            'carSubtype' => json_encode($validated['carSubtype'] ?? []),
            'carMake' => json_encode($validated['carMake'] ?? []),
        ]));

        return redirect()->route('supplier.create')->with([
            'status' => 'success',
            'message' => 'Поставщик успешно создан!',
        ]);
    }

    // Update an existing supplier
    public function update(Request $request, Supplier $supplier)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'stars' => 'nullable|numeric|min:0|max:5',
            'emails' => 'nullable|array',
            'phones' => 'nullable|array',
            'website' => 'nullable|url',
            'platform_address' => 'nullable|string|max:255',
            'unload_address' => 'nullable|string|max:255',
            'legal_entity' => 'nullable|string|max:255',
            'itn' => 'nullable|string|max:255',
            'rrc' => 'nullable|string|max:255',
            'rating' => 'nullable|string|max:255',
            'carType' => 'nullable|array',
            'carSubtype' => 'nullable|array',
            'carMake' => 'nullable|array',
            'workTerms' => 'nullable|string|max:255',
            'supervisor' => 'nullable|string|max:255',
            'dkp' => 'nullable|boolean',
            'image_spec' => 'nullable|boolean',
            'signees' => 'nullable|string|max:255',
            'warantees' => 'nullable|boolean',
            'payWithoutPTC' => 'nullable|boolean',
            'image' => 'nullable|image|max:1024',
        ]);

        if ($request->hasFile('image')) {
            if ($supplier->image) {
                Storage::disk('public')->delete($supplier->image);
            }

            $imagePath = $request->file('image')->store('suppliers', 'public');
            $supplier->image = $imagePath;
        }

        $supplier->update(array_merge($validated, [
            'image' => $supplier->image,
            'emails' => json_encode($validated['emails'] ?? []),
            'phones' => json_encode($validated['phones'] ?? []),
            'carType' => json_encode($validated['carType'] ?? []),
            'carSubtype' => json_encode($validated['carSubtype'] ?? []),
            'carMake' => json_encode($validated['carMake'] ?? []),
        ]));

        return redirect()->route('supplier.update', $supplier->id)->with([
            'status' => 'success',
            'message' => 'Поставщик успешно обновлен!',
        ]);
    }
}

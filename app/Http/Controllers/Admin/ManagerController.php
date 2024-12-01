<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Manager;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ManagerController extends Controller
{
    // Display a listing of managers
    public function index($search = null)
    {
        $managers = Manager::latest()->paginate(10);

        if ($search) {
            $managers->where(function ($query) use ($search) {
                $query->where('name', 'like', "%{$search}%")
                      ->orWhere('email', 'like', "%{$search}%");
            });
        }

        $suppliers = Supplier::all(['id', 'name']);


        return view('admin.managers', compact('managers', 'suppliers'));
    }

    // Delete a manager
    public function destroy(Manager $manager)
    {
        if ($manager->image) {
            Storage::disk('public')->delete($manager->image);
        }
        $manager->delete();

        return redirect()->route('admin.manager.index')->with([
            'status' => 'success',
            'message' => 'Менеджер удален!',
        ]);
    }

    // Edit a manager
    public function edit(Manager $manager)
    {
        $suppliers = Supplier::all(['id', 'name']);
        return view('admin.manager.edit', compact('manager', 'suppliers'));
    }

    // Store a new manager
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:255|regex:/^[\d-]+$/',
            'email' => 'required|email|unique:managers,email',
            'supplier_id' => 'required|exists:suppliers,id',
            'image' => 'nullable|image|max:1024',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('managers', 'public');
        }

        Manager::create(array_merge($validated, [
            'image' => $imagePath,
        ]));

        return redirect()->route('admin.manager.index')->with([
            'status' => 'success',
            'message' => 'Менеджер успешно создан!',
        ]);
    }

    // Update an existing manager
    public function update(Request $request, Manager $manager)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:255|regex:/^[\d-]+$/',
            'email' => 'required|email|unique:managers,email,' . $manager->id,
            'supplier_id' => 'required|exists:suppliers,id',
            'image' => 'nullable|image|max:1024',
        ]);

        if ($request->hasFile('image')) {
            if ($manager->image) {
                Storage::disk('public')->delete($manager->image);
            }

            $imagePath = $request->file('image')->store('managers', 'public');
            $manager->image = $imagePath;
        }

        $manager->update(array_merge($validated, [
            'image' => $manager->image,
        ]));

        return redirect()->route('admin.manager.index')->with([
            'status' => 'success',
            'message' => 'Менеджер успешно обновлен!',
        ]);
    }
}

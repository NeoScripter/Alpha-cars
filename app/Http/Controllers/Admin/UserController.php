<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Enums\UserRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    // Display a listing of users
    public function index($search = null)
    {
        $currentUser = Auth::user();

        // Only show users the current user is allowed to see
        $users = User::latest();

        if ($currentUser->role === UserRole::Editor->value) {
            $users->where('role', UserRole::User->value);
        } else {
            $users->whereNot('role', UserRole::Admin->value);
        }

        if ($search) {
            $users->where(function ($query) use ($search) {
                $query->where('name', 'like', "%{$search}%")
                      ->orWhere('email', 'like', "%{$search}%");
            });
        }

        $users = $users->paginate(10);

        return view('admin.users', compact('users'));
    }

    // Delete a user
    public function destroy(User $user)
    {
        $currentUser = Auth::user();

        // Prevent deletion if the current user does not have permission
        if ($currentUser->role === UserRole::Editor->value && $user->role !== UserRole::User->value) {
            return redirect()->route('admin.users.index')->with([
                'status' => 'success',
                'message' => 'Редактор не может удалить администратора.',
            ]);
        }

        if ($user->role === UserRole::Admin->value) {
            return redirect()->route('admin.users.index')->with([
                'status' => 'success',
                'message' => 'Администратора нельзя удалить.',
            ]);
        }

        $user->delete();

        return redirect()->route('admin.users.index')->with([
            'status' => 'success',
            'message' => 'Пользователь успешно удален.',
        ]);
    }

    // Edit a user
    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    // Store a new user
    public function store(Request $request)
{
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|string|min:8|confirmed',
        'role' => 'in:user,editor',
        'image' => 'nullable|image|max:1024',
    ]);

    $imagePath = null;
    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('users', 'public');
    }

    User::create([
        'name' => $validated['name'],
        'email' => $validated['email'],
        'password' => bcrypt($validated['password']),
        'role' => $validated['role'] ?? UserRole::User->value,
        'image' => $imagePath,
    ]);

    return redirect()->route('admin.users.index')->with([
        'status' => 'success',
        'message' => 'Пользователь успешно создан.',
    ]);
}


    // Update an existing user

    public function update(Request $request, User $user)
{
    $currentUser = Auth::user();

    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,' . $user->id,
        'password' => 'nullable|string|min:8|confirmed',
        'role' => 'in:user,editor',
        'image' => 'nullable|image|max:1024',
    ]);

    // Prevent editors from modifying roles
    if ($currentUser->role !== 'admin') {
        unset($validated['role']);
    }

    if ($request->hasFile('image')) {
        if ($user->image) {
            Storage::disk('public')->delete($user->image);
        }

        $imagePath = $request->file('image')->store('users', 'public');
        $user->image = $imagePath;
    }

    $user->update([
        'name' => $validated['name'],
        'email' => $validated['email'],
        'password' => bcrypt($validated['password'] ?? $user->password),
        'role' => $validated['role'] ?? UserRole::User->value,
        'image' => $imagePath ?? '',
        ]);

    return redirect()->route('admin.users.index')->with([
        'status' => 'success',
        'message' => 'Пользователь успешно обновлен.',
    ]);
}

}

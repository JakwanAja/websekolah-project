<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        
        // Manual check untuk super admin
        $this->middleware(function ($request, $next) {
            if (!auth()->user() || auth()->user()->role !== 'super admin') {
                abort(403, 'Unauthorized. Only Super Admin can access User Management.');
            }
            return $next($request);
        });
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = User::query();

        // Filter by role
        if ($request->filled('role')) {
            $query->where('role', $request->role);
        }

        // Filter by status (active/inactive)
        if ($request->filled('status')) {
            if ($request->status === 'active') {
                $query->whereNotNull('email_verified_at');
            } elseif ($request->status === 'inactive') {
                $query->whereNull('email_verified_at');
            }
        }

        // Search by name or email
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        $users = $query->orderBy('created_at', 'desc')->paginate(10)->appends($request->all());
        
        // Roles untuk filter
        $roles = ['admin' => 'Admin', 'super admin' => 'Super Admin'];

        return view('dashboard.users.index', compact('users', 'roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = ['admin' => 'Admin', 'super admin' => 'Super Admin'];
        return view('dashboard.users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:admin,super admin',
            'status' => 'required|in:active,inactive',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'email_verified_at' => $request->status === 'active' ? now() : null,
        ]);

        return redirect()->route('dashboard.users.index')
                        ->with('success', 'User berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return view('dashboard.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        // Prevent super admin from editing other super admins (except themselves)
        if ($user->role === 'super admin' && $user->id !== auth()->id()) {
            return redirect()->route('dashboard.users.index')
                           ->with('error', 'Tidak dapat mengedit Super Admin lain!');
        }

        $roles = ['admin' => 'Admin', 'super admin' => 'Super Admin'];
        return view('dashboard.users.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        // Prevent super admin from editing other super admins
        if ($user->role === 'super admin' && $user->id !== auth()->id()) {
            return redirect()->route('dashboard.users.index')
                           ->with('error', 'Tidak dapat mengedit Super Admin lain!');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'password' => 'nullable|string|min:8|confirmed',
            'role' => 'required|in:admin,super admin',
            'status' => 'required|in:active,inactive',
        ]);

        $userData = [
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'email_verified_at' => $request->status === 'active' ? now() : null,
        ];

        if ($request->filled('password')) {
            $userData['password'] = Hash::make($request->password);
        }

        $user->update($userData);

        return redirect()->route('dashboard.users.index')
                        ->with('success', 'User berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        // Prevent super admin from deleting other super admins
        if ($user->role === 'super admin') {
            return redirect()->route('dashboard.users.index')
                           ->with('error', 'Tidak dapat menghapus Super Admin!');
        }

        // Prevent deleting self
        if ($user->id === auth()->id()) {
            return redirect()->route('dashboard.users.index')
                           ->with('error', 'Tidak dapat menghapus akun sendiri!');
        }

        $user->delete();

        return redirect()->route('dashboard.users.index')
                        ->with('success', 'User berhasil dihapus!');
    }

    /**
     * Toggle user status (active/inactive)
     */
    public function toggleStatus(User $user)
    {
        // Prevent super admin from toggling other super admins
        if ($user->role === 'super admin' && $user->id !== auth()->id()) {
            return redirect()->route('dashboard.users.index')
                           ->with('error', 'Tidak dapat mengubah status Super Admin lain!');
        }

        $user->update([
            'email_verified_at' => $user->email_verified_at ? null : now()
        ]);

        $status = $user->email_verified_at ? 'diaktifkan' : 'dinonaktifkan';
        
        return redirect()->route('dashboard.users.index')
                        ->with('success', "User berhasil {$status}!");
    }
}
<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Get the authenticated user and their roles and permissions
     */
    public function authUser() {
        $user = auth()->user();
        if($user) $user->load('roles.permissions');
        return response()->json(compact('user'));
    }

    /**
     * Handle an authentication attempt.
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
 
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return response()->json(['user' => auth()->user()]);
        }
 
        return response()->json([
            'errors' => [
                'email' => 'The provided credentials do not match our records.'
            ],
            'message' => 'The provided credentials do not match our records.'
        ], 401);
    } 

    /**
     * Log the user out of the application.
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return response(null, 204);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::with('roles.permissions')->get();
        return response()->json(compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request)
    {
        $validated = $request->validated();

        $user = new User;

        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->password = $validated['password'];

        $user->save();

        $roles = [];
        if($validated['role_admin']) $roles[] = 'admin';
        if($validated['role_writer']) $roles[] = 'writer';
        $user->syncRoles($roles);

        $user->load('roles.permissions');

        return response()->json(['user' => $user], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequest $request, User $user)
    {
        $validated = $request->validated();

        $user->name = $validated['name'];
        $user->email = $validated['email'];
        if($validated['password']) $user->password = $validated['password'];

        $user->save();

        $roles = [];
        if($validated['role_admin']) $roles[] = 'admin';
        if($validated['role_writer']) $roles[] = 'writer';
        $user->syncRoles($roles);

        $user->load('roles.permissions');

        return response()->json(['user' => $user]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        if($user->hasRole('super admin')) abort(400, "Super admin can't be deleted");
        $user->delete();
        return response(null, 204);
    }
}

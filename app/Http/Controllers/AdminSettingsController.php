<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminSettingsController extends Controller
{

    public function __construct()
{
    $this->middleware('auth');
}

    public function index()
    {
        $admin = Auth::user(); // Get the currently logged-in admin
        return view('admin.settings', compact('admin'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:users,email,' . Auth::id(),
            'password' => 'nullable|min:8|confirmed',
        ]);

        $admin = Auth::user();
        $admin->email = $request->email;

        if ($request->filled('password')) {
            $admin->password = Hash::make($request->password);
        }

        $admin->save();

        return redirect()->route('admin.settings')->with('success', 'Settings updated successfully.');
    }
}


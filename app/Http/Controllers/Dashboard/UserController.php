<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:users_read')->only(['index']);
        $this->middleware('permission:users_create')->only(['create', 'store']);
        $this->middleware('permission:users_update')->only(['edit', 'update']);
        $this->middleware('permission:users_delete')->only(['destroy']);
        $this->middleware('protect.demo')->only(['update', 'destroy']);
    }

    public function index(Request $request)
    {
        $users = User::whereKeyNot(auth()->id())
            ->when($request->search, function ($query) use ($request) {
                $query->where(function ($q) use ($request) {
                    $q->where('first_name', 'like', '%' . $request->search . '%')
                      ->orWhere('last_name', 'like', '%' . $request->search . '%')
                      ->orWhere('email', 'like', '%' . $request->search . '%');
                });
            })
            ->latest()
            ->get();

        return view('dashboard.users.index', compact('users'));
    }

    public function create()
    {
        return view('dashboard.users.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'first_name'    => 'required|string|max:255',
            'last_name'     => 'required|string|max:255',
            'email'         => 'required|email|max:255|unique:users,email',
            'password'      => 'required|string|min:6|confirmed',
            'image'         => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'permissions'   => 'nullable|array',
            'permissions.*' => 'string|exists:permissions,name',
        ]);

        $data['password'] = Hash::make($data['password']);
        $data['image']    = $this->uploadImage($request) ?? 'default.png';

        $permissions = $data['permissions'] ?? [];
        unset($data['permissions']);

        $user = User::create($data);
        $user->syncPermissions($permissions);

        session()->flash('success', __('Added Successfully'));
        return redirect()->route('dashboard.users.index');
    }

    public function edit(User $user)
    {
        return view('dashboard.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $data = $request->validate([
            'first_name'    => 'required|string|max:255',
            'last_name'     => 'required|string|max:255',
            'email'         => ['required', 'email', 'max:255', Rule::unique('users', 'email')->ignore($user->id)],
            'image'         => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'permissions'   => 'nullable|array',
            'permissions.*' => 'string|exists:permissions,name',
        ]);

        if ($request->hasFile('image')) {
            $this->deleteOldImage($user->image);
            $data['image'] = $this->uploadImage($request);
        } else {
            unset($data['image']);
        }

        $permissions = $data['permissions'] ?? [];
        unset($data['permissions']);

        $user->update($data);
        $user->syncPermissions($permissions);

        session()->flash('success', __('Updated Successfully'));
        return redirect()->route('dashboard.users.index');
    }

    public function destroy(User $user)
    {
        $this->deleteOldImage($user->image);
        $user->delete();

        session()->flash('success', __('Deleted Successfully'));
        return redirect()->route('dashboard.users.index');
    }

    protected function uploadImage(Request $request): ?string
    {
        if (! $request->hasFile('image')) {
            return null;
        }

        $file = $request->file('image');
        $filename = Str::random(20) . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('uploads/user_images'), $filename);

        return $filename;
    }

    protected function deleteOldImage(?string $image): void
    {
        if (! $image || $image === 'default.png') {
            return;
        }

        $path = public_path('uploads/user_images/' . $image);
        if (file_exists($path)) {
            @unlink($path);
        }
    }
}

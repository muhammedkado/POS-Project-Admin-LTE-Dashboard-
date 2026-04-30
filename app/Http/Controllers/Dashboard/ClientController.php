<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:clients_read')->only(['index']);
        $this->middleware('permission:clients_create')->only(['create', 'store']);
        $this->middleware('permission:clients_update')->only(['edit', 'update']);
        $this->middleware('permission:clients_delete')->only(['destroy']);
    }

    public function index(Request $request)
    {
        $clients = Client::when($request->search, function ($query) use ($request) {
                $query->where('name', 'like', '%' . $request->search . '%');
            })
            ->latest()
            ->get();

        return view('dashboard.clients.index', compact('clients'));
    }

    public function create()
    {
        return view('dashboard.clients.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'    => 'required|string|max:255',
            'phone'   => 'nullable|array',
            'phone.*' => 'nullable|string|max:50',
            'address' => 'nullable|string',
        ]);

        $data['phone'] = array_values(array_filter($data['phone'] ?? [], fn ($v) => filled($v)));

        Client::create($data);

        session()->flash('success', __('Added Successfully'));
        return redirect()->route('dashboard.clients.index');
    }

    public function edit(Client $client)
    {
        return view('dashboard.clients.edit', compact('client'));
    }

    public function update(Request $request, Client $client)
    {
        $data = $request->validate([
            'name'    => 'required|string|max:255',
            'phone'   => 'nullable|array',
            'phone.*' => 'nullable|string|max:50',
            'address' => 'nullable|string',
        ]);

        $data['phone'] = array_values(array_filter($data['phone'] ?? [], fn ($v) => filled($v)));

        $client->update($data);

        session()->flash('success', __('Updated Successfully'));
        return redirect()->route('dashboard.clients.index');
    }

    public function destroy(Client $client)
    {
        $client->delete();

        session()->flash('success', __('Deleted Successfully'));
        return redirect()->route('dashboard.clients.index');
    }
}

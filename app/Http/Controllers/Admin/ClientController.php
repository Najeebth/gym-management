<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\MembershipPlan;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $clients = Client::query()
            ->with('membershipPlan')
            ->search($request->string('search')->toString() ?: null)
            ->status($request->string('status')->toString() ?: null)
            ->forPlan($request->integer('plan') ?: null)
            ->orderByDesc('join_date')
            ->paginate(20)
            ->withQueryString();

        $plans = MembershipPlan::query()->orderBy('name')->get();

        return view('admin.clients.index', compact('clients', 'plans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $plans = MembershipPlan::where('is_active', true)->orderBy('name')->get();

        return view('admin.clients.create', compact('plans'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $this->validated($request);

        $client = Client::create([
            ...$data,
            'created_by' => $request->user()->id,
        ]);

        return redirect()
            ->route('admin.clients.show', $client)
            ->with('status', 'Client created.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Client $client)
    {
        $client->load(['membershipPlan', 'createdBy']);

        return view('admin.clients.show', compact('client'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Client $client)
    {
        $plans = MembershipPlan::orderBy('name')->get();

        return view('admin.clients.edit', compact('client', 'plans'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Client $client)
    {
        $client->update($this->validated($request, $client));

        return redirect()
            ->route('admin.clients.show', $client)
            ->with('status', 'Client updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Client $client)
    {
        $client->delete();

        return redirect()
            ->route('admin.clients.index')
            ->with('status', 'Client removed.');
    }

    private function validated(Request $request, ?Client $client = null): array
    {
        // Name is edited independently via the EditClientName Livewire component
        // once a client exists, so the big form no longer submits it on update.
        $nameRule = $client ? 'sometimes' : 'required';

        return $request->validate([
            'membership_plan_id' => ['required', 'exists:membership_plans,id'],
            'first_name' => [$nameRule, 'string', 'max:100'],
            'last_name' => [$nameRule, 'string', 'max:100'],
            'email' => ['required', 'email', 'max:255', 'unique:clients,email,'.($client?->id)],
            'phone' => ['required', 'string', 'max:20'],
            'date_of_birth' => ['nullable', 'date'],
            'gender' => ['nullable', 'in:male,female,other'],
            'address' => ['nullable', 'string', 'max:255'],
            'city' => ['nullable', 'string', 'max:255'],
            'postal_code' => ['nullable', 'string', 'max:20'],
            'country' => ['nullable', 'string', 'max:255'],
            'join_date' => ['required', 'date'],
            'status' => ['required', 'in:active,inactive,frozen,cancelled'],
            'emergency_contact_name' => ['nullable', 'string', 'max:255'],
            'emergency_contact_phone' => ['nullable', 'string', 'max:20'],
            'notes' => ['nullable', 'string'],
        ]);
    }
}

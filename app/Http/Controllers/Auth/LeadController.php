<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Lead;
use App\Http\Requests\LeadRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Notification;

use App\Notifications\LeadAssigned;
class LeadController extends Controller
{
    use AuthorizesRequests;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Lead::query();

        $user = Auth::user();

        if($user->isAgent('agent')){
            $query->where('assigned_to', $user->id);
        }

        if ($status = $request->input('status')) {
            $query->where('status', $status);
        }

        if ($agentId = $request->input('assigned_to')) {
            $query->where('assigned_to', $agentId);
        }

        $sort = $request->input('sort', 'id');
        $direction = $request->input('direction', 'asc');
        $query->sortable($sort, $direction);

        $leads = $query->paginate(10)->appends($request->query());
        $agents = User::role('agent')->get();

        return view('pages.leads.index', compact('leads', 'agents'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', Lead::class);
        $agents = User::role('agent')->get();
        return view('pages.leads.add-edit-lead',compact('agents'));
    }

   public function store(LeadRequest $request)
    {
        $this->authorize('create', Lead::class);
        $validated = $request->validated();
        $lead = Lead::create($validated);

        // Notify assigned agent
        $agent = User::find($lead->assigned_to);
        if ($agent) {
            Notification::send($agent, new LeadAssigned($lead));
        }
        return redirect()->route('leads.index')->with('msg', 'Lead created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */

    public function show(Lead $lead)
    {
        $this->authorize('view', $lead);
        return view('pages.leads.show-lead',compact('lead'));
    }

    public function edit(Lead $lead)
    {
        $this->authorize('edit', $lead);
        $agents = User::where('role', 'agent')->get();
        return view('pages.leads.add-edit-lead',compact('agents','lead'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(LeadRequest $request, Lead $lead)
    {
        $this->authorize('update', $lead);
        $validated = $request->validated();
        $lead->update([
            'name'        => $validated['name'],
            'email'       => $validated['email'],
            'phone'       => $validated['phone'] ?? null,
            'status'      => $validated['status'],
            'assigned_to' => $validated['assigned_to'] ?? null,
            'notes'       => $validated['notes'] ?? null,
        ]);

        return redirect()->route('leads.index')->with('msg', 'Lead updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Lead $lead)
    {
        $this->authorize('delete', $lead);
        $lead->delete();
        return redirect()->route('leads.index')->with('msg', 'Lead deleted successfully.');
    }
}

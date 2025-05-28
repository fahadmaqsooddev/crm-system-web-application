@extends('layouts.master')

@section('title', 'Leads')

@section('content-header', 'Leads')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h3 class="card-title">All Leads</h3>
               @can('create', App\Models\Lead::class)
                    <a href="{{ route('leads.create') }}" class="btn btn-primary ml-auto">Add Lead</a>
                @endcan
            </div>

            <x-alert type="success" :message="session('msg')" class="my-3 mx-3 col-md-6" />

            <div class="card-body">
                <!-- Filter Form -->
            
            <form method="GET" action="{{ route('leads.index') }}" class="mb-4">
                <div class="row g-2">
                    <!-- Status Filter -->
                    <div class="col-md-5">
                        <select name="status" class="form-control">
                            <option value="" disabled {{ request('status') ? '' : 'selected' }}>Search by Status</option>
                            @foreach(['new', 'contacted', 'closed'] as $status)
                                <option value="{{ $status }}" {{ request('status') === $status ? 'selected' : '' }}>
                                    {{ ucfirst($status) }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Agent Filter -->
                    <div class="col-md-5">
                        <select name="assigned_to" class="form-control">
                            <option value="" disabled {{ request('assigned_to') ? '' : 'selected' }}>Search by Agent</option>
                            @foreach($agents as $agent)
                                <option value="{{ $agent->id }}" {{ request('assigned_to') == $agent->id ? 'selected' : '' }}>
                                    {{ $agent->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Submit Button -->
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary w-100">Filter</button>
                    </div>
                </div>
            </form>


                <!-- Leads Table -->
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>{!! sortable_link('id', 'Sr.no') !!}</th>
                            <th>{!! sortable_link('name', 'Name') !!}</th>
                            <th>{!! sortable_link('email', 'Email') !!}</th>
                            <th>{!! sortable_link('phone', 'Phone') !!}</th>
                            <th>{!! sortable_link('status', 'Status') !!}</th>
                            <th>{!! sortable_link('assigned_to', 'Assigned To') !!}</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($leads as $key => $lead)
                            <tr id="row-{{ $lead->id }}">
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $lead->name }}</td>
                                <td>{{ $lead->email }}</td>
                                <td>{{ $lead->phone }}</td>
                                <td>{{ ucfirst($lead->status) }}</td>
                                <td>{{ $lead->user->name ?? 'Unassigned' }}</td>
                                <td>
                                    <div class="btn-group" role="group" aria-label="Actions">

                                          @can('view', $lead)
                                                <a href="{{ route('leads.show', $lead->id) }}" class="btn btn-sm btn-info">
                                                    <i class="fas fa-eye"></i> View
                                                </a>
                                          @endcan
                                         @can('update', $lead)
                                            <a href="{{ route('leads.edit', $lead->id) }}" class="btn btn-sm btn-warning">
                                                <i class="fas fa-edit"></i> Edit
                                            </a>
                                         @endcan
                                        
                                        @can('delete', $lead)
                                            <form 
                                                action="{{ route('leads.destroy', $lead->id) }}" 
                                                method="POST" 
                                                style="display:inline-block;" 
                                                onsubmit="return confirm('Are you sure you want to delete this lead?');"
                                            >
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">
                                                    <i class="fas fa-trash"></i> Delete
                                                </button>
                                            </form>
                                        @endcan
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="d-flex justify-content-end mt-3">
                    {!! $leads->links('pagination::bootstrap-4') !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

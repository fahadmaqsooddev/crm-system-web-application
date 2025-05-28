@extends('layouts.master')

@section('title', isset($lead) ? 'Edit Lead' : 'Add Lead')

@section('content-header', isset($lead) ? 'Edit Lead' : 'Add Lead')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">{{ isset($lead) ? 'Edit Lead' : 'Add Lead' }}</h3>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ isset($lead) ? route('leads.update', $lead->id) : route('leads.store') }}">
                    @csrf
                    @if(isset($lead))
                        @method('PUT')
                    @endif
                    <div class="row">
                        <!-- Name -->
                        <div class="col-md-6 form-group">
                            <label for="name">Name <span class="text-danger">*</span></label>
                            <input 
                                type="text" 
                                name="name" 
                                class="form-control @error('name') is-invalid @enderror" 
                                value="{{ old('name', $lead->name ?? '') }}" 
                            >
                            @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <!-- Email -->
                        <div class="col-md-6 form-group">
                            <label for="email">Email <span class="text-danger">*</span></label>
                            <input 
                                type="email" 
                                name="email" 
                                class="form-control @error('email') is-invalid @enderror" 
                                value="{{ old('email', $lead->email ?? '') }}" 
                            >
                            @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="row">
                        <!-- Phone -->
                        <div class="col-md-6 form-group">
                            <label for="phone">Phone</label>
                            <input 
                                type="text" 
                                name="phone" 
                                class="form-control @error('phone') is-invalid @enderror" 
                                value="{{ old('phone', $lead->phone ?? '') }}" 
                            >
                            @error('phone') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <!-- Status -->
                        <div class="col-md-6 form-group">
                            <label for="status">Status <span class="text-danger">*</span></label>
                            <select name="status" class="form-control">
                                <option value="" disabled selected>Select Status</option>
                                @foreach(['new', 'contacted', 'closed'] as $status)
                                    <option value="{{ $status }}" 
                                        {{ old('status', $lead->status ?? '') === $status ? 'selected' : '' }}>
                                        {{ ucfirst($status) }}
                                    </option>
                                @endforeach
                            </select>
                            @error('status') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="row">
                        <!-- Assigned To -->
                        <div class="col-md-6 form-group">
                            <label for="assigned_to">Assign to Agent <span class="text-danger">*</span></label>
                            <select name="assigned_to" class="form-control">
                                <option value="" disabled selected>Select Agent</option>
                                @foreach($agents as $agent)
                                    <option value="{{ $agent->id }}"
                                        {{ old('assigned_to', $lead->assigned_to ?? '') == $agent->id ? 'selected' : '' }}>
                                        {{ $agent->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('assigned_to') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <!-- Notes -->
                        <div class="col-md-6 form-group">
                            <label for="notes">Notes</label>
                            <textarea name="notes" class="form-control" rows="3">{{ old('notes', $lead->notes ?? '') }}</textarea>
                            @error('notes') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <button type="submit" class="btn btn-success">
                        {{ isset($lead) ? 'Update Lead' : 'Add Lead' }}
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

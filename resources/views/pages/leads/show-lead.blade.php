@extends('layouts.master')

@section('title', 'View Lead')

@section('content-header', 'Lead Details')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <dl class="row">
                    <dt class="col-sm-4">Name : </dt>
                    <dd class="col-sm-8">{{ $lead->name }}</dd>

                    <dt class="col-sm-4">Email : </dt>
                    <dd class="col-sm-8">{{ $lead->email }}</dd>

                    <dt class="col-sm-4">Phone : </dt>
                    <dd class="col-sm-8">{{ $lead->phone ?? 'N/A' }}</dd>

                    <dt class="col-sm-4">Status : </dt>
                    <dd class="col-sm-8">{{ ucfirst($lead->status) }}</dd>

                    <dt class="col-sm-4">Assigned To : </dt>
                    <dd class="col-sm-8">{{ $lead->user->name ?? 'Unassigned' }}</dd>

                    <dt class="col-sm-4">Notes : </dt>
                    <dd class="col-sm-8">{{ $lead->notes ?? 'N/A' }}</dd>
                </dl>
            </div>
            <div class="card-footer">
                <a href="{{ route('leads.index') }}" class="btn btn-secondary">Back</a>
            </div>
        </div>
    </div>
</div>
@endsection

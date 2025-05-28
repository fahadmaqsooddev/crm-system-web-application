@extends('layouts.master')
@section('title','CRM System')

@section('content')

<div class="row">
    <div class="col-lg-4 col-6">
        <a href="{{ route('leads.index') }}">
            <div class="small-box bg-primary">
                <div class="inner">
                    <h3 id="completed-tasks-count">{{ $leads }}</h3>
                    <p>Leads</p>
                </div>
                <div class="icon">
                    <i class="fas fa-check-circle"></i>
                </div>
            </div>
        </a>
    </div>
</div>

@endsection

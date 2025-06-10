@php
$configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Dashboard')
f
@section('content')
<div class="row g6 mb6">
    <div class="col-lg-6">
        <div class="card h-100">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                <h5 class="mb-1">Mentorship Submissions</h5>
                <div class="dropdown">
                    <button class="btn btn-text-secondary rounded-pill text-muted border-0 p-1 waves-effect waves-light" type="button" id="salesOverview" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="ri-more-2-line ri-20px"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="salesOverview" style="">
                    <a class="dropdown-item waves-effect" href="javascript:void(0);">Refresh</a>
                    <a class="dropdown-item waves-effect" href="javascript:void(0);">Share</a>
                    <a class="dropdown-item waves-effect" href="javascript:void(0);">Update</a>
                    </div>
                </div>
                </div>
                <div class="d-flex align-items-center card-subtitle">
                <div class="me-2">Total {{ number_format($totalApplications) }} Applications</div>
                <div class="d-flex align-items-center text-success">
                    <p class="mb-0 fw-medium">+{{ $percentChange }}%</p>
                    <i class="ri-arrow-up-s-line ri-20px"></i>
                </div>
                </div>
            </div>
            <div class="card-body d-flex justify-content-between flex-wrap gap-4">
                <div class="d-flex align-items-center gap-3">
                <div class="avatar">
                    <div class="avatar-initial bg-label-primary rounded">
                    <i class="ri-user-star-line ri-24px"></i>
                    </div>
                </div>
                <div class="card-info">
                    <h5 class="mb-0">{{ number_format($newApplications) }}</h5>
                    <p class="mb-0">New Application</p>
                </div>
                </div>
                <div class="d-flex align-items-center gap-3">
                <div class="avatar">
                    <div class="avatar-initial bg-label-warning rounded">
                    <i class="ri-pie-chart-2-line ri-24px"></i>
                    </div>
                </div>
                <div class="card-info">
                    <h5 class="mb-0">{{ number_format($awaitingApproval) }}</h5>
                    <p class="mb-0">Awaiting Approval</p>
                </div>
                </div>
                <div class="d-flex align-items-center gap-3">
                <div class="avatar">
                    <div class="avatar-initial bg-label-info rounded">
                    <i class="ri-arrow-left-right-line ri-24px"></i>
                    </div>
                </div>
                <div class="card-info">
                    <h5 class="mb-0">{{ number_format($newRegistrations) }}</h5>
                    <p class="mb-0">New Registrations</p>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
